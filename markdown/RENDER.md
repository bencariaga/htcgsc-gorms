# Deployment Guide

This document outlines the production deployment process for HTCGSC-GORMS.

## 1. Production Hosting

The system is designed to be hosted on **Render** for cloud environments.

## 2. Production Environment

* **Database:** PostgreSQL 16+ is recommended for production.
* **Web Server:** NGINX 1.30+.
* **Runtime:** PHP 8.4+ and Node.js 20+.

## 3. Deployment Steps

1. Push your changes to the `main` branch on GitHub.
2. Connect your GitHub repository to Render.
3. Configure the **Build Command**:

   ```bash
   composer install --no-dev --optimize-autoloader
   npm install && npm run build
   ```

4. Configure the **Start Command**:

   ```bash
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

   *(Note: For production, using a proper web server like NGINX/Apache is preferred over `php artisan serve`)*

## 4. Environment Variables

Ensure all keys from `.env.example` are populated in your production environment settings (Render Dashboard).
