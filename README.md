# Agroproteinka Website

Laravel 6 CMS-based website for **agroproteinka.hr**, built on the [gtcrais/laravel-app-bootstrap](https://github.com/gtcrais/laravel-app-bootstrap) package.

## Tech Stack

- **PHP** ^7.2 / **Laravel** ^6.0
- **MySQL** database
- **Intervention/Image** for image processing
- **GuzzleHttp** for external API calls

## Features

- CMS-managed pages with dynamic page sections
- News / blog with slug-based routing
- Order submission form
- Social feed API endpoints (Facebook Graph API, LinkedIn API) with 10-minute caching

## Setup

1. Clone the repository and install dependencies:
   ```bash
   composer install
   ```

2. Copy `.env.example` to `.env` and configure:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Set the following `.env` variables:

   | Variable | Description |
   |---|---|
   | `DB_*` | MySQL connection details |
   | `FACEBOOK_PAGE_ID` | Facebook Page ID |
   | `FACEBOOK_APP_ID` | Facebook App ID |
   | `FACEBOOK_APP_SECRET` | Facebook App Secret |
   | `FACEBOOK_ACCESS_TOKEN` | Facebook Page Access Token |
   | `LINKEDIN_ACCESS_TOKEN` | LinkedIn Access Token |
   | `LINKEDIN_REFRESH_TOKEN` | LinkedIn Refresh Token |
   | `LINKEDIN_CLIENT_ID` | LinkedIn Client ID |
   | `LINKEDIN_CLIENT_SECRET` | LinkedIn Client Secret |
   | `LINKEDIN_ORG_ID` | LinkedIn Organization ID |

4. Run migrations and link storage:
   ```bash
   php artisan migrate
   php artisan storage:link
   ```
   Or use the built-in route: `GET /system/link-storage` (requires `superadmin` role).

5. Serve locally:
   ```bash
   php artisan serve
   ```

## API Endpoints

| Method | Route | Description |
|---|---|---|
| `GET` | `/api/social-feed/facebook` | Facebook feed (cached 10 min) |
| `GET` | `/api/social-feed/linkedin` | LinkedIn feed (cached 10 min) |
| `POST` | `/submit-order` | Submit an order |
| `GET` | `/novosti/{slug}` | Single news item |
