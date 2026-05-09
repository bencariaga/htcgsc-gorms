# XAMPP Local Hosting Guide

This document provides information on setting up the local development environment using XAMPP.

## 1. Local Hosting Requirements

The developer specifically uses **XAMPP 8.2.12** for local hosting.

## 2. Directory Configuration

Ensure your project is located within the `htdocs` directory of your XAMPP installation:
`C:\xampp\htdocs\htcgsc-gorms`

## 3. Modified File Directory System

The project may require specific XAMPP configurations. Refer to the [XAMPP Modified File Directory System](https://drive.google.com/file/d/1TfjQnV2D7yhsum7Bd-iNdLJ4mKL9cW9q/view?usp=sharing) linked in the main README.

## 4. Virtual Hosts (Optional)

For a cleaner URL (for example: `http://htcgsc-gorms.local`), you can configure a Virtual Host in Apache.

### 4.1. Update the Windows Hosts File

The `hosts` file acts as a local DNS. It tells the operating system that a specific domain name should point directly back to the local machine ($127.0.0.1$).

* Open **Notepad** (or **VS Code**) as **Administrator**.
* Navigate to: `C:\Windows\System32\drivers\etc\`.
* Open the file named `hosts`.
* Append the domain mapping to the bottom:

```text
127.0.0.1    htcgsc-gorms.local
```

### 4.2. Configure Apache Virtual Hosts

Once Windows knows where the domain points, Apache needs to know which folder to serve when it hears that domain name.

* Navigate to the XAMPP configuration folder: `C:\xampp\apache\conf\extra\`.
* Open `httpd-vhosts.conf`.
* Ensure the generic localhost is defined first so the dashboard remains accessible, then append the specific project block:

```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/htcgsc-gorms/public"
    ServerName htcgsc-gorms.local
    ServerAlias web-tunnel-name.ngrok-free.dev

    <Directory "C:/xampp/htdocs/htcgsc-gorms/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 4.3. Apply Changes

Configuration files are only read when the service starts.

* Open the **XAMPP Control Panel**.
* **Stop** Apache if it is running, then **Start** it again.
* Verify the setup by visiting [http://htcgsc-gorms.local](http://htcgsc-gorms.local) in a web browser.
