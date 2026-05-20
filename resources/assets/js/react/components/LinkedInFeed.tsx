import React, { useEffect, useState } from "react";
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel";

interface LinkedInPost {
  id: string;
  content: string;
  image_url: string;
  posted_at: string;
  formatted_date: string;
  permalink_url: string;
}

interface LinkedInResponse {
  status: string;
  data: LinkedInPost[];
}

const LinkedInFeed: React.FC = () => {
  const [response, setResponse] = useState<LinkedInResponse | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const response = await fetch("/api/social-feed/linkedin");
        if (!response.ok) {
          throw new Error("Failed to fetch LinkedIn posts");
        }
        const data = await response.json();
        setResponse(data);
      } catch (err) {
        setError(err instanceof Error ? err.message : "An error occurred");
      } finally {
        setLoading(false);
      }
    };

    fetchPosts();
  }, []);

  if (loading) {
    return <div className="flex items-center justify-center p-4">Učitavam LinkedIn objave...</div>;
  }
  if (error) {
    return <div className="text-red-500 p-4">{error}</div>;
  }
  if (!response || !response.data) {
    return <div className="bg-green-100 text-green-700 p-4 rounded">Nema dostupnih LinkedIn objava.</div>;
  }
  let posts = Array.isArray(response.data) ? response.data : [];
  posts = posts.slice(0, 6);
  if (posts.length === 0) {
    return <div className="bg-green-100 text-green-700 p-4 rounded">Nema dostupnih LinkedIn objava.</div>;
  }

  return (
    <div className="w-full px-10 2xl:px-2 py-6">
      <Carousel className="w-full">
        <CarouselContent>
          {posts.map((post: LinkedInPost) => (
            <CarouselItem key={post.id} className="basis-full md:basis-1/2 lg:basis-1/3">
              <a
                href={post.permalink_url}
                target="_blank"
                rel="noopener noreferrer"
                className="text-decoration-none block h-full transition-transform hover:scale-[1.02]"
              >
                <div className="bg-white h-full border-l-4 border-cyan-600">
                  <div className="p-4 flex flex-col h-full">
                    <div className="mb-3 h-60 overflow-hidden">
                      <img src={post.image_url || "/img/agroproteinka.webp"} className="w-full h-full object-cover" alt="LinkedIn slika" />
                    </div>
                    <p className="!text-base lg:!text-lg flex-grow text-gray-800">
                      {post.content.length > 300 ? `${post.content.substring(0, 300)}...` : post.content}
                    </p>
                    <div className="flex justify-between items-center mt-4">
                      <small className="text-gray-500">{post.formatted_date}</small>
                    </div>
                  </div>
                </div>
              </a>
            </CarouselItem>
          ))}
        </CarouselContent>
        <CarouselPrevious className="carousel-control left -translate-x-4" />
        <CarouselNext className="carousel-control right translate-x-6" />
      </Carousel>
    </div>
  );
};

export default LinkedInFeed;
