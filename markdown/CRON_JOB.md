# Cron Job Guide

Before everything else, make sure to have an account in [https://cron-job.org/](https://cron-job.org/) and have a website or a localhost URL of the system.

## 1. Overview

The system relies on the Laravel Scheduler to perform recurring actions:

* **Appointment Reminders**: Runs every minute to check for upcoming appointments and sends notifications at specific intervals before the exact appointment time (24 hours, 12 hours, 6 hours, 3 hours, 1 hour, and the exact appointment time).
* **Missed Appointment Marker**: Runs hourly to update missed appointment status as "Missed", but not "Done" or "Cancelled".

## 2. Getting the Cron Key

### 2.1. Environmental Variable File

In [https://console.cron-job.org/settings](https://console.cron-job.org/settings), click "**CREATE API KEY**" button to generate your cron key. After this, ensure the `.env` file contains the secure key:

```env
CRON_KEY=
```

### 2.2. Apply to Configuration Folder (`config/`), Application Folder (`app/`), and Route Folder (`routes/`)

Add this in `config/services.php`:

```php
'cron_key' => env('CRON_KEY')
```

Add this somewhere in `app/` (like `app/Http/Controllers/SchedulerController.php`):

```php
config('services.cron_key')
```

Add this in `routes/api.php`:

```php
use App\Http\Controllers\SchedulerController;

Route::get('/system/run-scheduled-tasks', SchedulerController::class);
```

## 3. External Trigger Setup

For hosting environments like Render or XAMPP, use [https://cron-job.org/](https://cron-job.org/) to trigger the scheduler.

### 3.1. Configure Your Account Timezone

Ensure the account matches the local time of the system (Asia/Manila, which is UTC+8) to avoid notification offsets:

1. Go to **Console Settings**.
2. Locate the **Profile** section.
3. Set **Default Timezone** to **Asia/Manila**.
4. Click **Save**.

### 3.2. Create the Cron Job

1. Navigate to the **Cronjobs** tab and click **Create Cronjob**.
2. **Title**: `HTCGSC-GORMS Scheduler`.
3. **URL**: `http://127.0.0.1:8000/api/system/run-scheduled-tasks?key=`.

Note: Replace `http://127.0.0.1:8000` with the live production domain when deployed.

1. **Execution Schedule**: Select **Every 1 minute**.
2. Click **Create**.

## 4. Troubleshooting

* **Check Logs**: View output in `storage/logs/laravel.log`.
* **Manual Test**: Visit the URL defined in Section 3.2 in a browser to verify the key and connection.

**Verification**: Check the **Audit Logs** (`http://127.0.0.1:8000/audit-logs`) or `storage/logs/` to see if tasks are executing.
