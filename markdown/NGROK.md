# Guide for Local Tunneling with Ngrok

This document explains how to use **Ngrok** to expose your local HTCGSC-GORMS development environment (XAMPP) to the internet. This is essential for testing external integrations like Google Forms (via Apps Script) and TextBee webhooks during development.

---

Hey! It's great to see you're moving toward the Microsoft Store method. It’s definitely the cleaner way to handle things on Windows because it manages the updates for you, so you don't have to manually swap out `.exe` files every time there’s a patch.

I've updated the guide to reflect the Store installation and integrated your specific static domain into the commands. Here is the revised version:

---

## 1. Setup

1. **Login/Signup:** Visit [https://ngrok.com/](https://ngrok.com/).
2. **Download:** Go to [http://dashboard.ngrok.com/get-started/setup/windows](http://dashboard.ngrok.com/get-started/setup/windows).
3. **Install:** Open the **Microsoft Store** on your Windows machine, search for **ngrok**, and click **Install**.
4. **Authenticate:** Once installed, run the following command to add your authtoken to the configuration file:

```powershell
ngrok config add-authtoken <your-authtoken>
```

---

## 2. Starting the Tunnel

For Laravel applications, it is important to ensure the host headers are handled correctly so that your assets and routes load without issues.

### **Option A: Quick Start**

If you just want to get the default localhost up and running:

```powershell
ngrok http 80
```

### **Option B: Using Virtual Host (XAMPP)**

If you are using a custom local domain like `htcgsc-gorms.local`, you’ll need to rewrite the headers:

```powershell
ngrok http --host-header=rewrite htcgsc-gorms.local:80
```

### **Option C: Using Your Static Domain**

Since you have a dedicated dev domain, use this command to map your local project to it:

```powershell
ngrok http --url=subovate-amatively-suzanne.ngrok-free.dev 80
```

---

## 3. Configure Apache Virtual Hosts

Once Windows knows where the domain points, Apache needs to know which folder to serve when it hears that domain name.

* Go to the XAMPP's Apache configuration folder named `C:\xampp\apache\conf\extra\`.
* In there, open `httpd-vhosts.conf`.
* Ensure the generic localhost is defined first so the dashboard remains accessible, then append the specific project block:

```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/htcgsc-gorms/public"
    ServerName htcgsc-gorms.local
    ServerAlias your-ngrok-id.ngrok-free.dev

    <Directory "C:/xampp/htdocs/htcgsc-gorms/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Make sure to run this command in your terminal:

```powershell
php artisan serve
```

---

## 4. Integration to the HTCGSC-GORMS

In HTCGSC-GORMS, we have specific logic to handle Ngrok tunnels automatically.

### **The AppSettingsServiceProvider**

We have configured `app/Providers/AppSettingsServiceProvider.php` to detect when the application is being accessed via Ngrok. When it detects a `.ngrok-free.dev` host, it automatically forces the URL scheme to **HTTPS**.

```php
$host = request()->header('Host');
$isNgrok = str($host)->contains('ngrok-free.dev');

if ($isNgrok) {
    URL::forceScheme('https');
}
```

> [!NOTE]
> This ensures that all generated links (like those in emails or SMS) use the public Ngrok URL instead of your local `htcgsc-gorms.local`.

---

## 5. Updating External Services

Once Ngrok is running, it will provide a URL like `https://a1b2-c3d4.ngrok-free.dev`.

### **Google Apps Script**

Open your `htcgsc-gorms.gs` file and update the `url` variable. We have a commented-out line ready for this:

```javascript
const url = "https://your-ngrok-id.ngrok-free.dev/api/google-forms"; // for Ngrok
```

---

## 6. Security and Best Practices

> [!CAUTION]
> Ngrok exposes your local machine to the internet. Always turn off the tunnel when you are finished testing.

* **Static Domains:** If you have a free Ngrok account, your URL changes every time you restart the tunnel. Consider claiming a free static domain on Ngrok to avoid updating URLs constantly.
* **Trusted Proxies:** Laravel 11 and above now handles trusted proxies automatically, but if you face issues with IP detection, ensure your environment is configured to trust the Ngrok headers.

---

## 7. Troubleshooting

* **404 Not Found:** Ensure XAMPP (Apache) is running before starting the Ngrok tunnel.
* **Invalid Host Header:** Double-check that the `--host-header` matches your Apache `ServerName`.
* **Too Many Requests:** Ngrok free tier has rate limits. If you hit them, wait a few minutes or upgrade.
