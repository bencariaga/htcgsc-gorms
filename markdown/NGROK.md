# Local Tunneling with Ngrok

This document explains how to use **Ngrok** to expose your local HTCGSC-GORMS development environment (XAMPP) to the internet. This is essential for testing external integrations like Google Forms (via Apps Script) and TextBee webhooks.

## 1. Why Use Ngrok?

Services like Google Forms and TextBee need a public URL to send data back to your application. Since your local XAMPP server (`http://localhost` or `http://htcgsc-gorms.local`) is not accessible from the public internet, Ngrok creates a secure tunnel that provides a public HTTPS URL.

## 2. Installation

1. Download Ngrok from [ngrok.com](https://ngrok.com/download).
2. Unzip and install the executable.
3. Sign up for a free account to get your **Authtoken**.
4. Authenticate your agent:

    ```bash
    ngrok config add-authtoken <your-authtoken>
    ```

## 3. Usage

### 3.1. Starting the Tunnel

If you are using the default XAMPP port 80:

```bash
ngrok http 80
```

If you have configured a Virtual Host (e.g., `htcgsc-gorms.local`):

```bash
ngrok http --host-header=rewrite htcgsc-gorms.local:80
```

### 3.2. Updating External Services

Once Ngrok is running, it will provide a URL like `https://a1b2-c3d4.ngrok-free.dev`.

#### Google Apps Script

Update the `url` variable in your `htcgsc-gorms.gs` file:

```javascript
const url = "https://a1b2-c3d4.ngrok-free.dev/api/google-forms";
```

#### TextBee Webhooks

If you are testing SMS delivery receipts or incoming messages, update your webhook URL in the [TextBee Dashboard](https://textbee.dev/dashboard) to point to your Ngrok URL.

## 4. Apache Configuration Tips

To ensure Laravel generates correct URLs when accessed via Ngrok, you might need to add the Ngrok domain to your `TRUSTED_PROXIES` or update your `APP_URL` in `.env`:

```env
APP_URL=https://a1b2-c3d4.ngrok-free.dev
```

Also, ensure your Apache Virtual Host includes the Ngrok alias as mentioned in [XAMPP.md](XAMPP.md):

```apache
<VirtualHost *:80>
    ServerName htcgsc-gorms.local
    ServerAlias a1b2-c3d4.ngrok-free.dev
    ...
</VirtualHost>
```

## 5. Security Warning

> [!CAUTION]
> Ngrok exposes your local machine to the internet. Always turn off the tunnel when you are finished testing. Avoid exposing sensitive data or keeping the tunnel open for long periods on unprotected networks.
