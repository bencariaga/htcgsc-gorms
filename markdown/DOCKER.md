# Docker Containerization Guide

This document provides instructions for containerizing the HTCGSC-GORMS system using Docker and Docker Compose. This is ideal for ensuring consistent environments across development and production.

## 1. Prerequisites

Before starting, ensure you have the following installed:

- **Docker Desktop**: [Download here](https://www.docker.com/products/docker-desktop/)
- **Docker Compose**: Usually included with Docker Desktop.

## 2. Docker Architecture

The project uses a multi-container setup:

1. **htcgsc-gorms**: The main application container (PHP 8.4-FPM + Nginx + Node.js).
2. **db**: The database container running PostgreSQL 17.

## 3. Getting Started

### 3.1. Environment Configuration

Ensure your `.env` file is configured to connect to the Docker database container.

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=htcgsc_gorms
DB_USERNAME=sail
DB_PASSWORD=password
```

### 3.2. Building and Running

To build the image and start the containers, run:

```bash
docker compose up -d --build
```

The system will be accessible at [http://localhost:8080](http://localhost:8080).

### 3.3. Initializing the System

Once the containers are running, you need to run the migrations and set up the system:

```bash
# Run migrations
docker compose exec htcgsc-gorms php artisan migrate

# Seed the database (optional)
docker compose exec htcgsc-gorms php artisan db:seed

# Generate App Key (if not set)
docker compose exec htcgsc-gorms php artisan key:generate
```

## 4. Common Commands

| Action                  | Command                               |
| ----------------------- | ------------------------------------- |
| Start Containers        | `docker compose up -d`                |
| Stop Containers         | `docker compose stop`                 |
| View Logs               | `docker compose logs -f`              |
| Enter Application Shell | `docker compose exec htcgsc-gorms sh` |
| Rebuild without Cache   | `docker compose build --no-cache`     |

## 5. Production Considerations

The provided `Dockerfile` is optimized for production by:

- Using a lightweight **Alpine Linux** base.
- Bundling **Nginx** and **PHP-FPM** in a single image for simplicity.
- Pre-installing system dependencies for **Browsershot** (Chromium) and **ImageMagick**.
- Optimizing **Composer** and **NPM** dependencies.

Refer to [RENDER.md](RENDER.md) for instructions on how this Docker configuration is utilized in the cloud.
