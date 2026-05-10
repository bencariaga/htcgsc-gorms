# Production Deployment with Render

This document provides instructions for deploying HTCGSC-GORMS to the cloud using [Render](https://render.com/).

## 1. Overview

HTCGSC-GORMS is configured to be deployed as a **Dockerized Web Service** with a **PostgreSQL Database**. The deployment process is automated using the `render.yaml` blueprint file located in the root directory.

## 2. Deployment Steps

### 2.1. Prepare your GitHub Repository

Ensure your latest code is pushed to your GitHub repository, including:

- `Dockerfile`
- `compose.yaml`
- `render.yaml`
- `docker/nginx.conf`

### 2.2. Create a Blueprint Instance on Render

1. Log in to your [Render Dashboard](https://dashboard.render.com/).
2. Click **"New"** and select **"Blueprint"**.
3. Connect your GitHub account and select the `htcgsc-gorms` repository.
4. Render will automatically detect the `render.yaml` file.
5. **Service Name**: Use the default or provide a new name.
6. Click **"Apply"**.

### 2.3. Environment Variables

While `render.yaml` handles the infrastructure, you must manually add sensitive secrets in the Render Dashboard under **Environment Groups** or the specific **Web Service settings**:

| Key                 | Value Example                   |
| ------------------- | ------------------------------- |
| `APP_KEY`           | `base64:your_generated_app_key` |
| `CRON_KEY`          | `your_secure_cron_key`          |
| `MAIL_PASSWORD`     | `your_google_app_password`      |
| `TEXTBEE_API_KEY`   | `your_textbee_api_key`          |
| `TEXTBEE_DEVICE_ID` | `your_textbee_device_id`        |

> [!NOTE]
> Database variables (`DB_HOST`, `DB_PASSWORD`, etc.) are automatically injected by Render based on the linked PostgreSQL database defined in `render.yaml`.

## 3. Infrastructure as Code (render.yaml)

The `render.yaml` file defines the following:

- **Web Service**:
  - Runtime: Docker
  - Plan: Free (can be upgraded)
  - Region: Singapore
  - Health Check Path: `/`
- **Database**:
  - Engine: PostgreSQL
  - Plan: Free

## 4. Post-Deployment Tasks

Once the service is live:

1. **Run Migrations**: Render automatically runs migrations if specified in the build command, but you can also run them via the Render "Shell" tab:

    ```bash
    php artisan migrate --force
    ```

2. **Verify Scheduler**: Ensure your external cron (see [CRON_JOB.md](CRON_JOB.md)) is pointing to your new Render URL.
3. **Update Apps Script**: Update your Google Apps Script `url` to point to the production Render API endpoint.

## 5. Troubleshooting

- **Build Failures**: Check the "Events" and "Logs" tab in Render to see if Docker failed to build or if there are permission issues.
- **Database Connection**: Ensure `DB_CONNECTION` is set to `pgsql` and the credentials match those provided by Render's internal database settings.
- **Chromium Issues**: The `Dockerfile` includes dependencies for Chromium. If PDFs or screenshots fail to generate, verify the `CHROME_PATH` environment variable is set to `/usr/bin/chromium-browser`.
