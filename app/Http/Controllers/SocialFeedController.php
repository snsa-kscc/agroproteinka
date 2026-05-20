<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SocialFeedController extends Controller
{
    /**
     * Get Facebook feed data
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFacebookFeed()
    {
        return Cache::remember('facebook_feed', 600, function () {
            $pageId = env('FACEBOOK_PAGE_ID');
            $accessToken = env('FACEBOOK_ACCESS_TOKEN');
            
            if (!$pageId || !$accessToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Facebook credentials not found in .env file'
                ], 500);
            }
            
            $apiUrl = "https://graph.facebook.com/v22.0/{$pageId}/feed";
            $params = [
                'fields' => 'id,message,created_time,full_picture,attachments{type,url,media},permalink_url',
                'limit' => 10,
                'access_token' => $accessToken,
            ];
            
            try {
                // Create a new Guzzle client
                $client = new Client([
                    'timeout' => 10,
                    'connect_timeout' => 5,
                    'http_errors' => false
                ]);
                
                try {
                    // Make the request
                    $response = $client->get($apiUrl, [
                        'query' => $params
                    ]);
                    
                    // Get status code
                    $statusCode = $response->getStatusCode();
                    
                    // Check if request was successful
                    if ($statusCode !== 200) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Facebook API request failed with status: ' . $statusCode
                        ], $statusCode);
                    }
                    
                    // Parse the response body
                    $facebookData = json_decode($response->getBody(), true);
                    
                } catch (RequestException $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error connecting to Facebook API: ' . $e->getMessage()
                    ], 500);
                }
                
                // Process and filter data
                $filteredPosts = collect($facebookData['data'] ?? [])
                    ->filter(function ($post) {
                        // Skip posts that are cover photo or profile media updates
                        if (isset($post['attachments']['data'][0]['type'])) {
                            $type = $post['attachments']['data'][0]['type'];
                            if ($type === 'cover_photo' || $type === 'profile_media') {
                                return false;
                            }
                        }
                        // Allow posts with either a message OR an image
                        return !empty($post['message']) || !empty($post['full_picture']);
                    })
                    ->map(function ($post) {
                        return [
                            'id' => $post['id'],
                            'content' => $post['message'] ?? '',
                            'image_url' => $post['full_picture'] ?? '',
                            'posted_at' => $post['created_time'] ?? '',
                            'formatted_date' => $this->formatDate($post['created_time'] ?? ''),
                            'permalink_url' => $post['permalink_url'] ?? '',
                        ];
                    })
                    ->values()
                    ->toArray();
                
                return response()->json([
                    'status' => 'success',
                    'data' => $filteredPosts
                ]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error processing Facebook feed: ' . $e->getMessage()
                ], 500);
            }
        });
    }

    /**
     * Format date to readable format
     * 
     * @param string $dateString
     * @return string
     */
    private function formatDate($dateString)
    {
        if (empty($dateString)) {
            return '';
        }
        
        $date = new \DateTime($dateString);
        return strtoupper($date->format('d.m.Y.'));
    }

    /**
     * Get LinkedIn feed data
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLinkedInFeed()
    {
        return Cache::remember('linkedin_feed', 86400, function () {
            $orgId = env('LINKEDIN_ORG_ID');
            $accessToken = env('LINKEDIN_ACCESS_TOKEN');
            
            if (!$orgId || !$accessToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'LinkedIn credentials not found in .env file'
                ], 500);
            }
            
            $apiUrl = "https://api.linkedin.com/rest/posts";
            $params = [
                'author' => "urn:li:organization:{$orgId}",
                'q' => 'author',
                'count' => 9,
                'sortBy' => 'LAST_MODIFIED'
            ];
            
            try {
                // Create a new Guzzle client
                $client = new Client([
                    'timeout' => 10,
                    'connect_timeout' => 5,
                    'http_errors' => false
                ]);
                
                try {
                    // Make the request to get posts
                    $response = $client->get($apiUrl, [
                        'query' => $params,
                        'headers' => [
                            'X-Restli-Protocol-Version' => '2.0.0',
                            'LinkedIn-Version' => '202503',
                            'X-RestLi-Method' => 'FINDER',
                            'Authorization' => "Bearer {$accessToken}"
                        ]
                    ]);
                    
                    // Get status code
                    $statusCode = $response->getStatusCode();
                    
                    // Check if request was successful
                    if ($statusCode !== 200) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'LinkedIn API request failed with status: ' . $statusCode
                        ], $statusCode);
                    }
                    
                    // Parse the response body
                    $linkedInData = json_decode($response->getBody(), true);
                    
                } catch (RequestException $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error connecting to LinkedIn API: ' . $e->getMessage()
                    ], 500);
                }
                
                // Process and filter data
                $filteredPosts = collect($linkedInData['elements'] ?? [])
                    ->filter(function ($post) {
                        // Check if post has commentary
                        // if (empty($post['commentary'])) {
                        //     return false;
                        // }
                        
                        // Case 1: Simple post with just commentary (no content object)
                        if (!isset($post['content'])) {
                            return true;
                        }
                        
                        // Case 2: Post with image
                        if (isset($post['content']['media']['id']) && 
                            strpos($post['content']['media']['id'], 'urn:li:image:') === 0) {
                            return true;
                        }
                        
                        // Case 3: Post with video
                        if (isset($post['content']['media']['id']) && 
                            strpos($post['content']['media']['id'], 'urn:li:video:') === 0) {
                            return true;
                        }
                        
                        // Case 4: Post with multi-image (use first image)
                        if (isset($post['content']['multiImage']['images'][0]['id']) && 
                            strpos($post['content']['multiImage']['images'][0]['id'], 'urn:li:image:') === 0) {
                            return true;
                        }
                        
                        // Exclude all other types
                        return false;
                    })
                    ->map(function ($post) use ($client, $accessToken) {
                        $imageUrl = '';
                        $mediaId = null;
                        
                        // Get media ID based on post type
                        if (isset($post['content'])) {
                            if (isset($post['content']['media']['id'])) {
                                $mediaId = $post['content']['media']['id'];
                            } elseif (isset($post['content']['multiImage']['images'][0]['id'])) {
                                $mediaId = $post['content']['multiImage']['images'][0]['id'];
                            }
                        }
                        
                        // Fetch media URL if we have a media ID
                        if ($mediaId) {
                            try {
                                if (strpos($mediaId, 'urn:li:image:') === 0) {
                                    // It's an image
                                    $mediaResponse = $client->get("https://api.linkedin.com/rest/images/{$mediaId}", [
                                        'headers' => [
                                            'Authorization' => "Bearer {$accessToken}",
                                            'LinkedIn-Version' => '202503'
                                        ]
                                    ]);
                                    
                                    if ($mediaResponse->getStatusCode() === 200) {
                                        $mediaData = json_decode($mediaResponse->getBody(), true);
                                        $remoteUrl = $mediaData['downloadUrl'] ?? '';
                                        
                                        // Download and store the image locally
                                        if ($remoteUrl) {
                                            $imageUrl = $this->downloadAndStoreLinkedInMedia($remoteUrl, $mediaId, 'image');
                                        }
                                    }
                                } elseif (strpos($mediaId, 'urn:li:video:') === 0) {
                                    // It's a video, get thumbnail
                                    $mediaResponse = $client->get("https://api.linkedin.com/rest/videos/{$mediaId}", [
                                        'headers' => [
                                            'Authorization' => "Bearer {$accessToken}",
                                            'LinkedIn-Version' => '202503'
                                        ]
                                    ]);
                                    
                                    if ($mediaResponse->getStatusCode() === 200) {
                                        $mediaData = json_decode($mediaResponse->getBody(), true);
                                        $remoteUrl = $mediaData['thumbnail'] ?? '';
                                        
                                        // Download and store the thumbnail locally
                                        if ($remoteUrl) {
                                            $imageUrl = $this->downloadAndStoreLinkedInMedia($remoteUrl, $mediaId, 'video-thumbnail');
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                // If media fetch fails, continue without image
                            }
                        }
                        
                        // Create permalink URL from post ID
                        $permalink = '';
                        if (isset($post['id'])) {
                            $permalink = 'https://www.linkedin.com/feed/update/' . $post['id'];
                        }
                        
                        return [
                            'id' => $post['id'] ?? '',
                            'content' => $post['commentary'] ?? '',
                            'image_url' => $imageUrl,
                            'posted_at' => isset($post['createdAt']) ? date('Y-m-d H:i:s', $post['createdAt'] / 1000) : '',
                            'formatted_date' => isset($post['createdAt']) ? $this->formatDate(date('c', $post['createdAt'] / 1000)) : '',
                            'permalink_url' => $permalink,
                        ];
                    })
                    ->values()
                    ->toArray();
                
                return response()->json([
                    'status' => 'success',
                    'data' => $filteredPosts
                ]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error processing LinkedIn feed: ' . $e->getMessage()
                ], 500);
            }
        });
    }
    
    /**
     * Download and store LinkedIn media locally
     * 
     * @param string $remoteUrl
     * @param string $mediaId
     * @param string $type
     * @return string Local URL to the stored media
     */
    private function downloadAndStoreLinkedInMedia($remoteUrl, $mediaId, $type)
    {
        try {
            // Create directory if it doesn't exist
            $mediaDir = public_path('img/linkedin-media');
            if (!file_exists($mediaDir)) {
                mkdir($mediaDir, 0755, true);
            }
            
            // Generate a filename based on the media ID
            $filename = md5($mediaId) . '.jpg';
            $localPath = $mediaDir . '/' . $filename;
            
            // Download the file
            $client = new Client([
                'timeout' => 10,
                'connect_timeout' => 5
            ]);
            
            $response = $client->get($remoteUrl, ['sink' => $localPath]);
            
            if ($response->getStatusCode() === 200) {
                // Return the public URL
                return '/img/linkedin-media/' . $filename;
            }
        } catch (\Exception $e) {
            // Log the error but continue
            \Log::error('Failed to download LinkedIn media: ' . $e->getMessage());
        }
        
        return '';
    }
} 