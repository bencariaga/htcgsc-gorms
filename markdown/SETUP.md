# HTCGSC-GORMS Setup Guide

This document provides step-by-step instructions for setting up the Holy Trinity College of General Santos City – Guidance Office Records Management System (HTCGSC-GORMS) on your local development environment.

## 1. Prerequisites

Before installing the system, ensure your local machine has the following software installed:

* **PHP:** 8.4 or higher
* **Laravel:** 13 or higher
* **Node.js:** 20.0 or higher
* **Composer:** 2.0 or higher
* **XAMPP:** Hosting for local development
* **GitHub:** Do pull requests, or branch out from `main` by forking or cloning, in your preference.
* **Visual Studio Code:** Recommended code editor, one used by the first developer of this project.

## 2. Environment Setup

### 1. Clone the Repository

Clone the project to your local web server directory (`htdocs` in XAMPP) and navigate into the project folder.

```powershell
cd C:\xampp\htdocs
git clone https://github.com/bencariaga/htcgsc-gorms.git htcgsc-gorms
cd htcgsc-gorms 
```

### 2. Install Dependencies

Install the required PHP and Node.js packages using Composer and NPM.

**Install PHP Packages:**

```powershell
composer install
```

**Install Node.js Packages:**

```powershell
npm install
```

## 3. Database Configuration

You must configure your `.env` file for your local database environment. By default, the setup will duplicate `.env.example` into `.env`.

Update your `.env` to match your local database settings (e.g., MySQL via XAMPP):

```ini
APP_NAME=HTCGSC-GORMS
APP_ENV=local
APP_KEY=
APP_PREVIOUS_KEYS=
APP_MAINTENANCE_STORE=file
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
APP_TIMEZONE=Asia/Manila
APP_MAINTENANCE_DRIVER=file

COMPOSER_PROCESS_TIMEOUT=600
DEBUGBAR_ENABLED=true

QUERY_DETECTOR_ENABLED=true
QUERY_DETECTOR_THRESHOLD=1
QUERY_DETECTOR_LOG_CHANNEL=daily

LOG_CHANNEL=daily
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
LOG_VIEWER_CACHE_DRIVER=file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CHROME_PATH=
NODE_BINARY=
NPM_BINARY=

GOOGLE_FORM_ID=
GOOGLE_FORM_ID_EDIT=

CRON_KEY=
HOLIDAY_CLIENT_API_KEY=

TEXTBEE_BASE_URL="https://api.textbee.dev/api/v1"
TEXTBEE_DEVICE_ID=
TEXTBEE_API_KEY=
```

### Environment Variables Explanation

Here is a detailed breakdown of the important environment variables you need to configure and how to obtain their values:

#### Application Settings

* **`APP_KEY`**: This is a 32-character string used for encryption. You do not need to set this manually; running `php artisan key:generate` will automatically populate it.
* **`APP_URL`**: The base URL of your application. If you serve via `php artisan serve`, use `http://127.0.0.1:8000`. If you use XAMPP, this should match your local domain or `http://localhost/htcgsc-gorms/public`.

#### Database Connection (`DB_*`)

* **`DB_DATABASE`**: The name of the MySQL database you created for this project (e.g., `htcgsc_gorms`).
* **`DB_USERNAME` / `DB_PASSWORD`**: Your MySQL database credentials. If using XAMPP default, the username is usually `root` with a blank password.

*(Alternatively, you can change `DB_CONNECTION=sqlite` and remove the other `DB_*` variables. The system will automatically create a `database/database.sqlite` file).*

For a detailed look at the tables and relationships created by the migrations, see the [Database Schema](SCHEMA.md).

#### Mail & SMTP (`MAIL_*`)

The system uses email notifications via Gmail.

* **`MAIL_USERNAME`**: Your full Gmail address (e.g., `your.email@gmail.com`).
* **`MAIL_PASSWORD`**: Your **Google App Password**. You *cannot* use your regular Gmail password.
  1. Go to your Google Account Settings > Security.
  2. Enable 2-Step Verification.
  3. Search for "App Passwords" and create a new one for "Mail" or "Custom (HTCGSC-GORMS)".
  4. Paste the generated 16-character password here without spaces.
* **`MAIL_FROM_ADDRESS`**: Same as your `MAIL_USERNAME`.

#### System Paths

* **`CHROME_PATH`**: Absolute path to your Google Chrome executable (used by Puppeteer/Browsershot to generate PDFs/images). E.g., `"C:\Program Files\Google\Chrome\Application\chrome.exe"`.
* **`NODE_BINARY` / `NPM_BINARY`**: Absolute path to your Node and NPM executables (useful if Laravel has trouble finding them). E.g., `"C:\Program Files\nodejs\node.exe"`.

#### External Integrations

* **`GOOGLE_FORM_ID` / `GOOGLE_FORM_ID_EDIT`**: The unique identifier for your connected Google Form.
  * You can find this in your Google Form URL: `https://docs.google.com/forms/d/[THIS_IS_THE_ID]/edit`.
* **`CRON_KEY`**: A secure, random string you create (e.g., `my_secret_cron_key_123`) to authorize and secure external webhook requests (like from cron-job.org).
* **`HOLIDAY_CLIENT_API_KEY`**: Optional API key if you are integrating the PHP Holiday API to track Philippine holidays.
* **`TEXTBEE_DEVICE_ID` / `TEXTBEE_API_KEY`**: Used for sending SMS notifications.
  1. Go to [TextBee.dev](https://textbee.dev/) and create a free account.
  2. Download the TextBee Android app on your phone and link your device.
  3. Retrieve your `Device ID` and `API Key` from your TextBee web dashboard and paste them here.

## 4. Application Setup

There are multiple methods to configure the application environment, generate keys, and run migrations and seeders. Choose **one** of the methods below.

### Method A: Using the Custom Artisan Command (Recommended)

This command handles everything: clearing cache, wiping existing databases/views, running all system migrations sequentially, seeding data, and linking storage.

```powershell
php artisan setup
```

### Method B: Using the Composer Setup Script

This script uses standard Laravel commands alongside individually targeted migrations for structured system tables.

```powershell
composer setup
```

### Method C: Manual Setup

If you want to run the installation process manually step-by-step:

```powershell
# 1. Create .env file if it doesn't exist
cp .env.example .env

# 2. Generate application key
php artisan key:generate

# 3. Run core Laravel migrations
php artisan migrate:fresh --drop-views --path=database/migrations/laravel

# 4. Run system migrations in sequence
php artisan migrate --path=database/migrations/system/01_create_persons_table.php
php artisan migrate --path=database/migrations/system/02_create_students_table.php
php artisan migrate --path=database/migrations/system/03_create_users_table.php
php artisan migrate --path=database/migrations/system/04_create_referrers_table.php
php artisan migrate --path=database/migrations/system/05_create_referrals_table.php
php artisan migrate --path=database/migrations/system/06_create_appointments_table.php
php artisan migrate --path=database/migrations/system/07_create_reports_table.php
php artisan migrate --path=database/migrations/system/08_create_all_activities_view.php

# 5. Seed the database with fake/initial data
php artisan db:seed

# 6. Create symbolic link for storage
php artisan storage:link
```

> [!NOTE]
> By default, the database seeder will create multiple test users including an Administrator. The default password for seeded user accounts is `12345678`.

## 5. Compiling Frontend Assets

Build the Vite and Tailwind CSS assets using Node:

**For Development (Live Reloading):**

```powershell
npm run dev
```

**For Production (Minified Build):**

```powershell
npm run build
```

## 6. Running the System

You can run the system through your XAMPP Apache Server by navigating to the corresponding `public/` directory URL in your browser, or use Laravel's local development server:

```powershell
php artisan serve
```

Access the system at `http://localhost:8000` (or your mapped XAMPP local domain).

For more information on local hosting via XAMPP, see the [XAMPP Guide](XAMPP.md).

## 7. Running Tests

To run the full suite of logic and browser tests (via Pest and Playwright), ensure your environment is running, then use:

```powershell
npm run test
```

For more details on test types and the test directory structure, see the [Testing Guide](TESTING.md).

## 8. Directory Structure Guide

Understanding the project's architecture is crucial for development. The system follows a structured and organized approach combining Laravel's core conventions, Atomic Design for the frontend, and SOLID principles for the backend.

A detailed explanation of the project's folders and file system map can be found in the [Directory Structure Guide](DIRECTORIES.md).
