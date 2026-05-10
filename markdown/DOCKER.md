# Containerization Guide with Docker

This document provides comprehensive instructions for containerizing the **HTCGSC-GORMS** system using Docker and Docker Compose. Utilizing Docker ensures a consistent, isolated, and reproducible environment across development and production.

---

## 1. Architecture Overview

The system employs a multi-container architecture defined in `compose.yaml`:

1. **`htcgsc-gorms` (Application)**:
    - **Base Image**: `php:8.4-fpm-alpine`.
    - **Components**: Bundles **PHP 8.4-FPM**, **Nginx**, and **Node.js** into a single lightweight image.
    - **Features**: Pre-configured with **Chromium** (for Browsershot/PDF generation), **ImageMagick**, and necessary PHP extensions (`pdo_pgsql`, `intl`, `gd`, etc.).
    - **Port**: Maps host port `8080` to container port `80`.

2. **`db` (Database)**:
    - **Image**: `postgres:17-alpine`.
    - **Purpose**: High-performance relational database storage.
    - **Port**: Maps host port `5432` to container port `5432`.

---

## 2. Prerequisites

Ensure you have the following installed on your host system:

- **Docker Desktop**: [Download and Install](https://www.docker.com/products/docker-desktop/)
- **Docker Compose**: Included with Docker Desktop (Verify with `docker compose version`).
- **Basic Knowledge**: Familiarity with [Docker Concepts](https://docs.docker.com/get-started/).

---

## 3. Configuration & Environment

### 3.1. .dockerignore

The project uses a `.dockerignore` file to prevent unnecessary files (like `node_modules`, `vendor`, and local `.env` files) from being copied into the container, keeping the image lean and secure.

### 3.2. Environment Variables

Docker Compose uses environment variables defined in the `services` section of `compose.yaml`. These settings will override any values in a local `.env` file for those specific keys.

**Default Docker Credentials:**

```env
DB_CONNECTION=pgsql
DB_HOST= 
DB_PORT=5432
DB_DATABASE=htcgsc_gorms
DB_USERNAME=htcgsc_gorms_user
DB_PASSWORD= 
```

---

## 4. Getting Started

### 4.1. Build and Run

To build the application image and start the services in detached mode:

```bash
docker compose up -d --build
```

The system will be accessible at: **[http://localhost:8080](http://localhost:8080)**.

### 4.2. First-Time System Initialization

Once the containers are healthy, you must initialize the Laravel environment. We provide a custom setup script for this:

```bash
# Run the complete automated setup
docker compose exec htcgsc-gorms composer setup
```

**What this script does:**

1. Copies `.env.example` to `.env`.
2. Generates the `APP_KEY`.
3. Runs database migrations (PostgreSQL).
4. Seeds the database with initial data.
5. Creates the symbolic link for storage (`public/storage`).

---

## 5. Common Management Commands

| Action                | Command                                               |
| :-------------------- | :---------------------------------------------------- |
| **Start Services**    | `docker compose up -d`                                |
| **Stop Services**     | `docker compose stop`                                 |
| **Remove Containers** | `docker compose down`                                 |
| **View Live Logs**    | `docker compose logs -f`                              |
| **Enter App Shell**   | `docker compose exec htcgsc-gorms sh`                 |
| **Database Shell**    | `docker compose exec db psql -U sail -d htcgsc_gorms` |

---

## 6. System Dependencies

- **Browsershot & Chromium**: The Dockerfile installs `chromium` and sets `PUPPETEER_EXECUTABLE_PATH`. This allows the system to generate PDFs and screenshots out-of-the-box.
- **ImageMagick**: Used for advanced image processing and QR code handling.
- **Composer & NPM**: The build process automatically optimizes PHP and Node.js dependencies for production.

---

## 7. Development vs. Production

- **`compose.yaml`**: Standard configuration for local development and testing.
- **`compose.debug.yaml`**: Can be used for specific debugging scenarios.
- **`render.yaml`**: Used for automated production deployment to [Render](https://render.com/). Open [RENDER.md](RENDER.md) for details.

---

## 8. References

- [Official Docker Getting Started Guide](https://docs.docker.com/get-started/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
