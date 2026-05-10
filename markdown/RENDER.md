# System Deployment to Production with Render

This document provides instructions for deploying **HTCGSC-GORMS** to the cloud using [Render](https://render.com/).

---

## 1. Overview

HTCGSC-GORMS is configured for seamless deployment as a **Dockerized Web Service** paired with a **Managed PostgreSQL Database**. The infrastructure is managed via the `render.yaml` blueprint file, ensuring a "Infrastructure as Code" (IaC) approach.

---

## 2. Deployment Steps

### 2.1. Prepare your GitHub Repository

Ensure your latest code is pushed to your GitHub repository. The deployment relies on these key files:

- **`Dockerfile`**: The blueprint for the application container (PHP 8.4-FPM + Nginx).
- **`render.yaml`**: The orchestration file for Render services.
- **`docker/nginx.conf`**: The web server configuration.
- **`composer.json`**: Contains the production build scripts.

### 2.2. Create a Blueprint Instance on Render

1. Log in to your [Render Dashboard](https://dashboard.render.com/).
2. Click **"New"** and select **"Blueprint"**.
3. Connect your GitHub account and select the `htcgsc-gorms` repository.
4. Render will automatically parse the `render.yaml` file.
5. **Service Name**: Use the default or provide a custom identifier.
6. Click **"Apply"**.

---

## 3. Environment Configuration

The `render.yaml` file handles the basic environment setup, including linking the web service to the database. However, you must manually provide sensitive secrets in the Render Dashboard (under **Environment Groups** or **Web Service > Environment**):

| Key               | Value Example               | Rationale                              |
| :---------------- | :-------------------------- | :------------------------------------- |
| `APP_KEY`         | `base64:...`                | Encryption and session security.       |
| `APP_DEBUG`       | `false`                     | Disable debugging in production.       |
| `CHROME_PATH`     | `/usr/bin/chromium-browser` | Required for Browsershot.              |
| `CRON_KEY`        | `your_secure_key`           | Authenticates external cron triggers.  |
| `MAIL_PASSWORD`   | `your_password`             | SMTP authentication for notifications. |
| `TEXTBEE_API_KEY` | `your_api_key`              | SMS gateway authentication.            |

> [!IMPORTANT]
> Render automatically injects `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` based on the database defined in your blueprint. **Do not hardcode these.**

---

## 4. Post-Deployment Tasks

Once the service is active, perform these final steps:

1. **Initialize Database**: Access the **"Shell"** tab in your Render service and run:

    ```bash
    php artisan migrate --force
    ```

    *(Note: Avoid `db:seed` in production unless starting from a clean slate.)*

2. **Storage Link**: Ensure the storage link is created (if not already handled by build scripts):

    ```bash
    php artisan storage:link
    ```

3. **Configure External Cron**: Point your external cron service (e.g., Cron-Job.org) to your Render URL: `https://your-app.onrender.com/api/scheduler/run?key=YOUR_CRON_KEY`.

4. **Update Google Apps Script**: Update the `url` constant in your Google Apps Script to point to your new production domain.

---

## 5. Troubleshooting

- **ImageMagick/Chromium Errors**: If PDF or QR code generation fails, ensure the `Dockerfile` successfully installed `chromium` and `imagemagick`. Check the build logs for `pecl install imagick` failures.
- **Connection Refused**: Verify that `DB_CONNECTION` is set to `pgsql` and that the database is in the same Render region as the web service.
- **Port Mapping**: Ensure the `Dockerfile` exposes port `80`, as Render expects web services to listen on standard ports unless configured otherwise.

---

## 6. References

- [Render Docker Deployment Documentation](https://render.com/docs/docker)
- [Render PostgreSQL Documentation](https://render.com/docs/databases)
- [Laravel Production Checklist](https://laravel.com/docs/deployment#production-checklist)
