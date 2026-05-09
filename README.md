# HTCGSC-GORMS

<p align="center">
    <img src="public/images/HTCGSC-GORMS-logo.png" width="180" alt="GORMS Logo">
    <br>
    <b>Holy Trinity College of General Santos City</b><br>
    Guidance Office Records Management System
</p>

<p align="center"><b>Project Name</b> (<b>Abbreviation</b>): HTCGSC-GORMS</p>

<p align="center"><b>POWERED BY:</b></p>

<p align="center">
    <img src="https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML">
    <img src="https://img.shields.io/badge/CSS-663399?style=for-the-badge&logo=css&logoColor=white" alt="CSS">
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <br>
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black" alt="Alpine.js">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Livewire-4e1fe0?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
    <br>
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
    <img src="https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white" alt="Apache">
    <img src="https://img.shields.io/badge/NGINX-009639?style=for-the-badge&logo=nginx&logoColor=white" alt="NGINX">
    <br>
    <img src="https://img.shields.io/badge/phpMyAdmin-6C78AF?style=for-the-badge&logo=phpmyadmin&logoColor=white" alt="phpMyAdmin">
    <img src="https://img.shields.io/badge/TablePlus-2DA44E?style=for-the-badge&logo=databricks&logoColor=white" alt="TablePlus">
    <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
    <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
    <br>
    <img src="https://img.shields.io/badge/Render-76EAD7?style=for-the-badge&logo=render&logoColor=black" alt="Render">
    <img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white" alt="Postman">
    <img src="https://img.shields.io/badge/Cron--Job-444444?style=for-the-badge&logo=clockify&logoColor=white" alt="cron-job">
    <img src="https://img.shields.io/badge/Font_Awesome-339AF0?style=for-the-badge&logo=font-awesome&logoColor=white" alt="Font Awesome">
    <br>
    <img src="https://img.shields.io/badge/Google_Apps_Script-4285F4?style=for-the-badge&logo=google&logoColor=white" alt="Google Apps Script">
    <img src="https://img.shields.io/badge/Google_Forms-7248B9?style=for-the-badge&logo=google-forms&logoColor=white" alt="Google Forms">
    <img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Gmail">
    <img src="https://img.shields.io/badge/TextBee-FFC400?style=for-the-badge&logo=googlemessages&logoColor=black" alt="TextBee">
</p>

## Table of Contents

- [HTCGSC-GORMS](#htcgsc-gorms)
  - [Table of Contents](#table-of-contents)
  - [Before Everything Else](#before-everything-else)
  - [What this Project is About?](#what-this-project-is-about)
  - [Why Create the Project?](#why-create-the-project)
  - [In-Scope / Features](#in-scope--features)
  - [Out-Scope / Limitations](#out-scope--limitations)
  - [Dependencies](#dependencies)
    - [JavaScript / Node.js](#javascript--nodejs)
    - [Laravel / Composer](#laravel--composer)
  - [Visual Studio Code Extensions Used](#visual-studio-code-extensions-used)
  - [Database Schema](#database-schema)
    - [1. `persons` table](#1-persons-table)
    - [2. `students` table](#2-students-table)
    - [3. `users` table](#3-users-table)
    - [4. `referrers` table](#4-referrers-table)
    - [5. `referrals` table](#5-referrals-table)
    - [6. `appointments` table](#6-appointments-table)
    - [7. `reports` table](#7-reports-table)
    - [8. `all_activities` view](#8-all_activities-view)
  - [Project File System Directory Map](#project-file-system-directory-map)
    - [Backend](#backend)
      - [routes](#routes)
      - [config](#config)
      - [database](#database)
      - [storage](#storage)
      - [tests](#tests)
      - [app](#app)
    - [Frontend](#frontend)
      - [Assets](#assets)
      - [Laravel Blade](#laravel-blade)

---

## Before Everything Else

- Make sure to study, install, and integrate each of the following needed to set up the system:
  - [Visual Studio Code](https://code.visualstudio.com/download)
  - [Visual Studio Code Extensions](https://marketplace.visualstudio.com/vscode)
  - [XAMPP](https://www.apachefriends.org/)
  - [XAMPP Directory System](https://drive.google.com/file/d/1xoiNblNZs6JtTmtXEvC-1xrM09of9RSi/view?usp=sharing)
  - [Laravel](https://laravel.com)
  - [Livewire](https://livewire.laravel.com/)
  - [Tailwind CSS](https://tailwindcss.com)
  - [Alpine.js](https://alpinejs.dev/)
  - [Node.js](https://nodejs.org/en/download)
  - [Composer](https://getcomposer.org/download/)
  - [MySQL](https://dev.mysql.com/downloads/)
  - [PostgreSQL](https://www.postgresql.org/download/)
  - [Apache](https://httpd.apache.org/download.cgi)
  - [NGINX](https://nginx.org/en/download.html)
  - [phpMyAdmin](https://www.phpmyadmin.net/downloads/)
  - [TablePlus](https://tableplus.com/download/)
  - [GitHub](https://github.com)
  - [Docker](https://docs.docker.com/get-started/get-docker/)
  - [Render](https://render.com)
  - [Postman](https://www.postman.com/downloads/)
  - [Cron-Job](https://cron-job.org)
  - [Font Awesome](https://fontawesome.com)
  - [Google App Passwords](https://myaccount.google.com/apppasswords)
  - [Google Apps Script](https://script.google.com/home)
  - [Google Forms](https://forms.google.com)
  - [Gmail](https://gmail.com)
  - [TextBee](https://textbee.dev/)

---

## What this Project is About?

**HTCGSC-GORMS (Holy Trinity College of General Santos City – Guidance Office Records Management System)** is a **Laravel-based** computer system designed for monitoring data of the **Guidance and Testing Center (GTC)** of the school and for notifying **GTC employees and HTCGSC students**.

---

## Why Create the Project?

Before the creation of this project, the **Guidance and Testing Center (GTC)** of HTCGSC relied on **human memories**, **logbooks**, and **paper-based documents** for recording student interactions, counseling sessions, and referrals. This process was:

- Prone to **data loss or physical damage**.
- Time-consuming for data **search** and **retrieval**.
- Challenging for tracking every **student's history with the GTC** over time.
- Difficult for **managing appointments** and ensuring **timely communication** with students and referrers.

**HTCGSC-GORMS** digitizes these workflows, ensuring data integrity, rapid information retrieval, and a secure platform for sensitive student information.

---

## In-Scope / Features

- **Student Profiling:** Centralized database for student information and guidance counseling session history.
- **Smart and Automated Appointment Scheduling:** Automated appointment booking and notification with conflict detection and time slot management.
- **Authentication with One-Time Password (OTP) Verification:** Enhanced security for logins before accessing the system.
- **Notifications using SMS and Email:** Automated SMS (via TextBee) and email (via Gmail) alerts for updates.
- **Report Generation:** Automated generation of reports in PDF and Excel based on date ranges.

---

## Out-Scope / Limitations

- **Website Only:** The system is only accessible via web browsers; as of now, there are no plans for native desktop or mobile applications to be made.
- **Local/Cloud Hosting:** The developer uses specifically **XAMPP** for local hosting and **Render** for web hosting.
- **Communication:** One-way SMS notifications; students cannot reply directly to the system's SMS.
- **Network Dependency:** Reliability depends on telecommunication networks and third-party APIs.

---

| Tool Name            | Home Page URL                                                                                                  | Prerequisite Version    | Notes                                                                                                  |
| -------------------- | -------------------------------------------------------------------------------------------------------------- | ----------------------- | ------------------------------------------------------------------------------------------------------ |
| HTML                 | [https://html.spec.whatwg.org/](https://html.spec.whatwg.org/)                                                 | 5.4+                    | Laravel Blade code files (*.blade.php)                                                                 |
| CSS                  | [https://w3.org/TR/CSS/#css](https://w3.org/TR/CSS/#css)                                                       | 3+                      | Vanilla CSS (*.css)                                                                                    |
| JavaScript           | [ECMA-262 - Ecma International](https://ecma-international.org/publications-and-standards/standards/ecma-262/) | ECMAScript 2025         | Vanilla JavaScript (*.js)                                                                              |
| Tailwind CSS         | [https://tailwindcss.com/](https://tailwindcss.com/)                                                           | 4.0+                    | Inline styling in HTML tags of *.blade.php                                                             |
| Alpine.js            | [https://alpinejs.dev/](https://alpinejs.dev/)                                                                 | 3.0+                    | Lightweight client-side interactivity                                                                  |
| PHP                  | [https://www.php.net/](https://www.php.net/)                                                                   | 8.4+                    | Backend language of the system                                                                         |
| Laravel              | [https://laravel.com/](https://laravel.com/)                                                                   | 13.0+                   | PHP web framework of the system                                                                        |
| Livewire             | [https://livewire.laravel.com/](https://livewire.laravel.com/)                                                 | 4.0+                    | Reactive user interface components                                                                     |
| XAMPP                | [https://www.apachefriends.org/](https://www.apachefriends.org/)                                               | 8.2.12                  | Apache + MySQL / MariaDB + phpMyAdmin                                                                  |
| Docker               | [Get Docker - Docker Docs](https://docs.docker.com/get-started/get-docker/)                                    | Latest                  | For virtualization of the system as a container                                                        |
| MySQL                | [https://www.mysql.com/](https://www.mysql.com/)                                                               | 8.0+ / 10.14+ (MariaDB) | Relational database management system for local development environment                                |
| PostgreSQL           | [https://www.postgresql.org/](https://www.postgresql.org/)                                                     | 16+                     | Relational database management system for production environment                                       |
| Node.js              | [https://nodejs.org/en/download/](https://nodejs.org/en/download/)                                             | 20+                     | Runtime environment for asset bundling and JS-based dependencies, such as Vite and Playwright          |
| Composer             | [https://getcomposer.org/download/](https://getcomposer.org/download/)                                         | 2.x                     | Manager for PHP-based dependencies, such as Laravel and Livewire                                       |
| VS Code              | [https://code.visualstudio.com/download/](https://code.visualstudio.com/download/)                             | 1.97+                   | Primary code editor for system development and extensions needed for that development                  |
| Apache               | [https://httpd.apache.org/](https://httpd.apache.org/)                                                         | 2.4.58+                 | Web server for local development environment                                                           |
| NGINX                | [https://nginx.org/](https://nginx.org/)                                                                       | 1.30+                   | Web server for production environment                                                                  |
| phpMyAdmin           | [https://www.phpmyadmin.net/](https://www.phpmyadmin.net/)                                                     | 5.2+                    | DB GUI viewer for local development environment                                                        |
| TablePlus            | [https://tableplus.com/download/](https://tableplus.com/download/)                                             | Latest                  | DB GUI viewer for production environment                                                               |
| GitHub               | [https://github.com/](https://github.com/)                                                                     | N/A                     | Version control and collaboration                                                                      |
| Render               | [https://render.com/](https://render.com/)                                                                     | N/A                     | Deployment and web hosting platform                                                                    |
| Postman              | [https://www.postman.com/downloads/](https://www.postman.com/downloads/)                                       | Latest                  | API testing and development                                                                            |
| Cron-Job             | [https://cron-job.org/](https://cron-job.org/)                                                                 | N/A                     | External task scheduler to enable automated appointment notifications sent from the system to students |
| Font Awesome         | [https://fontawesome.com/](https://fontawesome.com/)                                                           | 7.0+                    | Library for frontend icons                                                                             |
| Google App Passwords | [https://myaccount.google.com/apppasswords/](https://myaccount.google.com/apppasswords/)                       | N/A                     | To set up SMTP connection with an app password for the system                                          |
| Google Apps Script   | [https://script.google.com/](https://script.google.com/)                                                       | N/A                     | To set up connection between Google Forms and the system                                               |
| Google Forms         | [https://forms.google.com/](https://forms.google.com/)                                                         | N/A                     | To set up GForms which will be used to collect and input student data                                  |
| Gmail                | [https://workspace.google.com/products/gmail/](https://workspace.google.com/products/gmail/)                   | N/A                     | To set up SMTP connection with the email address on Gmail                                              |
| TextBee              | [https://textbee.dev/](https://textbee.dev/)                                                                   | 2.7+                    | SMS gateway to enable automated text messaging in the system                                           |

---

## Dependencies

### JavaScript / Node.js

| Package Name                                                                | Installation CLI Command                          | Purpose                                               |
| --------------------------------------------------------------------------- | ------------------------------------------------- | ----------------------------------------------------- |
| [Tailwind CSS](https://github.com/tailwindlabs/tailwindcss)                 | `npm install tailwindcss@4.0.0`                   | Utility-first CSS framework for rapid UI development  |
| [Tailwind CSS Vite Plugin](https://www.npmjs.com/package/@tailwindcss/vite) | `npm install @tailwindcss/vite@4.0.0`             | Vite integration for Tailwind CSS v4                  |
| [Vite](https://github.com/vitejs/vite)                                      | `npm install vite@7.0.7`                          | Next-generation frontend tooling and bundler          |
| [Laravel Vite Plugin](https://github.com/laravel/vite-plugin)               | `npm install laravel-vite-plugin@2.0.0`           | Bridges Laravel with the Vite build tool              |
| [Axios](https://github.com/axios/axios)                                     | `npm install axios@1.11.0`                        | Promise-based HTTP client for the browser and node.js |
| [Font Awesome](https://github.com/FortAwesome/Font-Awesome)                 | `npm install @fortawesome/fontawesome-free@7.2.0` | Scalable vector icons and social logos                |
| [Vitest](https://github.com/vitest-dev/vitest)                              | `npm install vitest@4.1.5`                        | Vite-native unit test framework                       |
| [Puppeteer](https://github.com/puppeteer/puppeteer)                         | `npm install puppeteer@24.40.0`                   | Headless Chrome Node.js API for browser automation    |
| [Playwright](https://github.com/microsoft/playwright)                       | `npm install @playwright/test@1.59.1`             | Cross-browser end-to-end testing                      |

### Laravel / Composer

| Package Name                                                                                                                          | Installation CLI Command                                                              | Purpose                                                                                |
| ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| [Faker](https://github.com/fakerphp/faker)                                                                                            | `composer require fakerphp/faker:^1.23`                                               | Generating dummy data for testing and development                                      |
| [Laravel Debugbar](https://github.com/fruitcake/laravel-debugbar)                                                                     | `composer require fruitcake/laravel-debugbar:^4.2.6`                                  | Performance profiling and debugging                                                    |
| [Guzzle HTTP Client](https://github.com/guzzle/guzzle)                                                                                | `composer require guzzlehttp/guzzle:^7.10`                                            | Sending HTTP requests                                                                  |
| [Laravel Framework](https://github.com/laravel/framework)                                                                             | `composer require laravel/framework:v13.0.0`                                          | Core Laravel application framework                                                     |
| [Laravel Tinker](https://github.com/laravel/tinker)                                                                                   | `composer require laravel/tinker:^3.0`                                                | Interactive shell for Laravel                                                          |
| [Livewire](https://github.com/livewire/livewire)                                                                                      | `composer require livewire/livewire:^3.7.14`                                          | Reactive UI development without page reloads                                           |
| [Maatwebsite Excel](https://github.com/Maatwebsite/Laravel-Excel)                                                                     | `composer require maatwebsite/excel:^3.1.68`                                          | Excel file generation and manipulation                                                 |
| [Log Viewer](https://github.com/opcodesio/log-viewer)                                                                                 | `composer require opcodesio/log-viewer:^3.21`                                         | Web-based log visualization                                                            |
| [PHP Holiday API](https://github.com/san103/php-holiday-api)                                                                          | `composer require san103/php-holiday-api:^1.3`                                        | Philippine holiday data integration                                                    |
| [Belongs to Through](https://github.com/staudenmeir/belongs-to-through)                                                               | `composer require staudenmeir/belongs-to-through:^2.18`                               | Advanced Eloquent "belongs to through" relationships                                   |
| [Eloquent Param Limit Fix](https://github.com/staudenmeir/eloquent-param-limit-fix)                                                   | `composer require staudenmeir/eloquent-param-limit-fix:^1.1.2`                        | Eloquent eager loading fix for parameter limits of SQL-type database management system |
| [Laravel Adjacency List](https://github.com/staudenmeir/laravel-adjacency-list)                                                       | `composer require staudenmeir/laravel-adjacency-list:^1.26.1`                         | Recursive relationship and tree structure support                                      |
| [Eloquent Has Many Deep](https://github.com/staudenmeir/eloquent-has-many-deep)                                                       | `composer require staudenmeir/eloquent-has-many-deep:^1.22`                           | Advanced Eloquent "has many deep" relationships                                        |
| [Laravel CTE](https://github.com/staudenmeir/laravel-cte)                                                                             | `composer require staudenmeir/laravel-cte:^1.13.0`                                    | Common table expression support for complex queries                                    |
| [Laravel Merged Relations](https://github.com/staudenmeir/laravel-merged-relations)                                                   | `composer require staudenmeir/laravel-merged-relations:^1.11`                         | Merging multiple Eloquent relationships into one                                       |
| [Eloquent Param Limit Fix X Laravel Adjacency List](https://github.com/staudenmeir/eloquent-param-limit-fix-x-laravel-adjacency-list) | `composer require staudenmeir/eloquent-param-limit-fix-x-laravel-adjacency-list:^1.4` | Merger of eloquent-param-limit-fix and laravel-adjacency-list                          |
| [Simple QR Code](https://github.com/simplesoftwareio/simple-qrcode)                                                                   | `composer require simplesoftwareio/simple-qrcode:4.2.0`                               | QR code display for the URL of form from Google Forms                                  |
| [Spatie Browsershot](https://github.com/spatie/browsershot)                                                                           | `composer require spatie/browsershot:5.2.3`                                           | Image and PDF generation from HTML, Blade, and CSS (vanilla, old-school)               |
| [Spatie Image](https://github.com/spatie/image)                                                                                       | `composer require spatie/image:3.9.1`                                                 | Image manipulation and processing                                                      |
| [Spatie Laravel Data](https://github.com/spatie/laravel-data)                                                                         | `composer require spatie/laravel-data:4.22.0`                                         | Robust data handling and validation                                                    |
| [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)                                                                  | `composer require barryvdh/laravel-ide-helper:^3.7 --dev`                             | Generating IDE autocomplete files                                                      |
| [Laravel Query Detector](https://github.com/beyondcode/laravel-query-detector)                                                        | `composer require beyondcode/laravel-query-detector:^2.2 --dev`                       | Detecting N+1 database queries during development                                      |
| [Laravel Dusk](https://github.com/laravel/dusk)                                                                                       | `composer require laravel/dusk:^8.6 --dev`                                            | Browser automation and testing                                                         |
| [Laravel Pail](https://github.com/laravel/pail)                                                                                       | `composer require laravel/pail:^1.2.2 --dev`                                          | Real-time log monitoring in the terminal                                               |
| [Laravel Pint](https://github.com/laravel/pint)                                                                                       | `composer require laravel/pint:^1.27 --dev`                                           | PHP code style fixing                                                                  |
| [Laravel Pest](https://github.com/pestphp/pest)                                                                                       | `composer require pestphp/pest:^4.0 --dev`                                            | Modern testing framework                                                               |

---

## Visual Studio Code Extensions Used

| Extension Name                                                                                                                | Extension ID                                  |
| ----------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------- |
| [Better Comments](https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments)                             | `aaron-bond.better-comments`                  |
| [CodeSnap](https://marketplace.visualstudio.com/items?itemName=adpyke.codesnap)                                               | `adpyke.codesnap`                             |
| [Alpine.js IntelliSense](https://marketplace.visualstudio.com/items?itemName=adrianwilczynski.alpine-js-intellisense)         | `adrianwilczynski.alpine-js-intellisense`     |
| [One Dark Theme](https://marketplace.visualstudio.com/items?itemName=akamud.vscode-theme-onedark)                             | `akamud.vscode-theme-onedark`                 |
| [Foldable Use Statements](https://marketplace.visualstudio.com/items?itemName=alex-tf.foldable-use-statements)                | `alex-tf.foldable-use-statements`             |
| [Laravel Extra IntelliSense](https://marketplace.visualstudio.com/items?itemName=amiralizadeh9480.laravel-extra-intellisense) | `amiralizadeh9480.laravel-extra-intellisense` |
| [Google Apps Script IntelliSense](https://marketplace.visualstudio.com/items?itemName=apenara.gas-intellisense)               | `apenara.gas-intellisense`                    |
| [Spell Right](https://marketplace.visualstudio.com/items?itemName=ban.spellright)                                             | `ban.spellright`                              |
| [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)                   | `bmewburn.vscode-intelephense-client`         |
| [Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss)                    | `bradlc.vscode-tailwindcss`                   |
| [Multi-cursor Case Preserve](https://marketplace.visualstudio.com/items?itemName=cardinal90.multi-cursor-case-preserve)       | `cardinal90.multi-cursor-case-preserve`       |
| [npm IntelliSense](https://marketplace.visualstudio.com/items?itemName=christian-kohler.npm-intellisense)                     | `christian-kohler.npm-intellisense`           |
| [Path IntelliSense](https://marketplace.visualstudio.com/items?itemName=christian-kohler.path-intellisense)                   | `christian-kohler.path-intellisense`          |
| [Laravel Livewire](https://marketplace.visualstudio.com/items?itemName=cierra.livewire-vscode)                                | `cierra.livewire-vscode`                      |
| [Laravel Goto View](https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view)                           | `codingyu.laravel-goto-view`                  |
| [DevDB](https://marketplace.visualstudio.com/items?itemName=damms005.devdb)                                                   | `damms005.devdb`                              |
| [markdownlint](https://marketplace.visualstudio.com/items?itemName=davidanson.vscode-markdownlint)                            | `davidanson.vscode-markdownlint`              |
| [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)                                          | `dbaeumer.vscode-eslint`                      |
| [Composer](https://marketplace.visualstudio.com/items?itemName=devsense.composer-php-vscode)                                  | `devsense.composer-php-vscode`                |
| [IntelliPHP](https://marketplace.visualstudio.com/items?itemName=devsense.intelli-php-vscode)                                 | `devsense.intelli-php-vscode`                 |
| [PHP Tools](https://marketplace.visualstudio.com/items?itemName=devsense.phptools-vscode)                                     | `devsense.phptools-vscode`                    |
| [PHP Profiler](https://marketplace.visualstudio.com/items?itemName=devsense.profiler-php-vscode)                              | `devsense.profiler-php-vscode`                |
| [Git History](https://marketplace.visualstudio.com/items?itemName=donjayamanne.githistory)                                    | `donjayamanne.githistory`                     |
| [GitLens — Git supercharged](https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens)                             | `eamodio.gitlens`                             |
| [HTML CSS Support](https://marketplace.visualstudio.com/items?itemName=ecmel.vscode-html-css)                                 | `ecmel.vscode-html-css`                       |
| [EditorConfig for VS Code](https://marketplace.visualstudio.com/items?itemName=editorconfig.editorconfig)                     | `editorconfig.editorconfig`                   |
| [Log File Highlighter](https://marketplace.visualstudio.com/items?itemName=emilast.logfilehighlighter)                        | `emilast.logfilehighlighter`                  |
| [Prettier - Code formatter](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)                       | `esbenp.prettier-vscode`                      |
| [Auto Complete Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-complete-tag)                      | `formulahendry.auto-complete-tag`             |
| [Auto Rename Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-rename-tag)                          | `formulahendry.auto-rename-tag`               |
| [Code Runner](https://marketplace.visualstudio.com/items?itemName=formulahendry.code-runner)                                  | `formulahendry.code-runner`                   |
| [File Tree Extractor](https://marketplace.visualstudio.com/items?itemName=fuzionix.file-tree-extractor)                       | `fuzionix.file-tree-extractor`                |
| [Laravel Create View](https://marketplace.visualstudio.com/items?itemName=glitchbl.laravel-create-view)                       | `glitchbl.laravel-create-view`                |
| [Auto-Open Markdown Preview](https://marketplace.visualstudio.com/items?itemName=hnw.vscode-auto-open-markdown-preview)       | `hnw.vscode-auto-open-markdown-preview`       |
| [Laravel Blade Wrapper](https://marketplace.visualstudio.com/items?itemName=ihunte.laravel-blade-wrapper)                     | `ihunte.laravel-blade-wrapper`                |
| [Path Autocomplete](https://marketplace.visualstudio.com/items?itemName=ionutvmi.path-autocomplete)                           | `ionutvmi.path-autocomplete`                  |
| [DotENV](https://marketplace.visualstudio.com/items?itemName=irongeek.vscode-env)                                             | `irongeek.vscode-env`                         |
| [Font Awesome Auto-complete](https://marketplace.visualstudio.com/items?itemName=janne252.fontawesome-autocomplete)           | `janne252.fontawesome-autocomplete`           |
| [Hungry Delete](https://marketplace.visualstudio.com/items?itemName=jasonlhy.hungry-delete)                                   | `jasonlhy.hungry-delete`                      |
| [Laravel](https://marketplace.visualstudio.com/items?itemName=laravel.vscode-laravel)                                         | `laravel.vscode-laravel`                      |
| [Pretty Formatter](https://marketplace.visualstudio.com/items?itemName=mblode.pretty-formatter)                               | `mblode.pretty-formatter`                     |
| [Rainbow CSV](https://marketplace.visualstudio.com/items?itemName=mechatroner.rainbow-csv)                                    | `mechatroner.rainbow-csv`                     |
| [Git Graph](https://marketplace.visualstudio.com/items?itemName=mhutchie.git-graph)                                           | `mhutchie.git-graph`                          |
| [Dotenv](https://marketplace.visualstudio.com/items?itemName=mikestead.dotenv)                                                | `mikestead.dotenv`                            |
| [Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-containers)                         | `ms-azuretools.vscode-containers`             |
| [Docker](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker)                                     | `ms-azuretools.vscode-docker`                 |
| [Remote - Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)                 | `ms-vscode-remote.remote-containers`          |
| [Notepad++ keymap](https://marketplace.visualstudio.com/items?itemName=ms-vscode.notepadplusplus-keybindings)                 | `ms-vscode.notepadplusplus-keybindings`       |
| [Laravel Goto Components](https://marketplace.visualstudio.com/items?itemName=naoray.laravel-goto-components)                 | `naoray.laravel-goto-components`              |
| [VS HTML to CSS](https://marketplace.visualstudio.com/items?itemName=neptunedesign.vs-html-to-css)                            | `neptunedesign.vs-html-to-css`                |
| [Indent-Rainbow](https://marketplace.visualstudio.com/items?itemName=oderwat.indent-rainbow)                                  | `oderwat.indent-rainbow`                      |
| [Laravel Blade](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade)                                 | `onecentlin.laravel-blade`                    |
| [Laravel Extension Pack](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-extension-pack)               | `onecentlin.laravel-extension-pack`           |
| [Laravel 5 Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel5-snippets)                        | `onecentlin.laravel5-snippets`                |
| [Laravel Pint](https://marketplace.visualstudio.com/items?itemName=open-southeners.laravel-pint)                              | `open-southeners.laravel-pint`                |
| [Laravel Jump Controller](https://marketplace.visualstudio.com/items?itemName=pgl.laravel-jump-controller)                    | `pgl.laravel-jump-controller`                 |
| [Material Icon Theme](https://marketplace.visualstudio.com/items?itemName=pkief.material-icon-theme)                          | `pkief.material-icon-theme`                   |
| [CSS Peek](https://marketplace.visualstudio.com/items?itemName=pranaygp.vscode-css-peek)                                      | `pranaygp.vscode-css-peek`                    |
| [CSS Navigation](https://marketplace.visualstudio.com/items?itemName=pucelle.vscode-css-navigation)                           | `pucelle.vscode-css-navigation`               |
| [Live Server](https://marketplace.visualstudio.com/items?itemName=ritwickdey.liveserver)                                      | `ritwickdey.liveserver`                       |
| [PHP Parameter Hint](https://marketplace.visualstudio.com/items?itemName=robertgr991.php-parameter-hint)                      | `robertgr991.php-parameter-hint`              |
| [Laravel Artisan](https://marketplace.visualstudio.com/items?itemName=ryannaddy.laravel-artisan)                              | `ryannaddy.laravel-artisan`                   |
| [Fira Code](https://marketplace.visualstudio.com/items?itemName=seyyedkhandon.firacode)                                       | `seyyedkhandon.firacode`                      |
| [Laravel Blade formatter](https://marketplace.visualstudio.com/items?itemName=shufo.vscode-blade-formatter)                   | `shufo.vscode-blade-formatter`                |
| [HTML to CSS autocompletion](https://marketplace.visualstudio.com/items?itemName=solnurkarim.html-to-css-autocompletion)      | `solnurkarim.html-to-css-autocompletion`      |
| [Alpine.js syntax highlight](https://marketplace.visualstudio.com/items?itemName=sperovita.alpinejs-syntax-highlight)         | `sperovita.alpinejs-syntax-highlight`         |
| [PHP Refactor Tool](https://marketplace.visualstudio.com/items?itemName=st-pham.php-refactor-tool)                            | `st-pham.php-refactor-tool`                   |
| [Tailwind Fold](https://marketplace.visualstudio.com/items?itemName=stivo.tailwind-fold)                                      | `stivo.tailwind-fold`                         |
| [es6-string-html](https://marketplace.visualstudio.com/items?itemName=tobermory.es6-string-html)                              | `tobermory.es6-string-html`                   |
| [VS Code Counter](https://marketplace.visualstudio.com/items?itemName=uctakeoff.vscode-counter)                               | `uctakeoff.vscode-counter`                    |
| [Error Lens](https://marketplace.visualstudio.com/items?itemName=usernamehw.errorlens)                                        | `usernamehw.errorlens`                        |
| [Highlight Matching Tag](https://marketplace.visualstudio.com/items?itemName=vincaslt.highlight-matching-tag)                 | `vincaslt.highlight-matching-tag`             |
| [PHP TypeHints](https://marketplace.visualstudio.com/items?itemName=vix.php-typehints-vsc)                                    | `vix.php-typehints-vsc`                       |
| [Nginx Configuration](https://marketplace.visualstudio.com/items?itemName=william-voyek.vscode-nginx)                         | `william-voyek.vscode-nginx`                  |
| [HTML Snippets](https://marketplace.visualstudio.com/items?itemName=wscats.html-snippets)                                     | `wscats.html-snippets`                        |
| [Batch Formatter](https://marketplace.visualstudio.com/items?itemName=wwnao.bat-formatter)                                    | `wwnao.bat-formatter`                         |
| [JavaScript (ES6) code snippets](https://marketplace.visualstudio.com/items?itemName=xabikos.javascriptsnippets)              | `xabikos.javascriptsnippets`                  |
| [PHP Debug](https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug)                                             | `xdebug.php-debug`                            |
| [PHP Extension Pack](https://marketplace.visualstudio.com/items?itemName=xdebug.php-pack)                                     | `xdebug.php-pack`                             |
| [Markdown PDF](https://marketplace.visualstudio.com/items?itemName=yzane.markdown-pdf)                                        | `yzane.markdown-pdf`                          |
| [Markdown All in One](https://marketplace.visualstudio.com/items?itemName=yzhang.markdown-all-in-one)                         | `yzhang.markdown-all-in-one`                  |
| [HTML CSS Class Completion](https://marketplace.visualstudio.com/items?itemName=zignd.html-css-class-completion)              | `zignd.html-css-class-completion`             |
| [PHP IntelliSense](https://marketplace.visualstudio.com/items?itemName=zobo.php-intellisense)                                 | `zobo.php-intellisense`                       |

---

## Database Schema

### 1. `persons` table

Core table storing personal information for all system participants.

| Column          | Data Type                          | Nullable | Notes                                                                         |
| :-------------- | :--------------------------------- | :------- | :---------------------------------------------------------------------------- |
| `person_id`     | int(10) UNSIGNED                   | no       | PK, auto-increment                                                            |
| `type`          | enum('Admin','Employee','Student') | no       | person type                                                                   |
| `last_name`     | varchar(20)                        | no       | person's last name                                                            |
| `first_name`    | varchar(20)                        | no       | person's first name                                                           |
| `middle_name`   | varchar(20)                        | yes      | person's middle name                                                          |
| `email_address` | varchar(60)                        | no       | email accounts must end with "**@gmail.com**" or "**@online.htcgsc.edu.ph**"  |
| `phone_number`  | varchar(11)                        | yes      | for SMS notifications; format: "**09XXXXXXXXX**" (example: "**09123456789**") |

### 2. `students` table

Extends the `persons` table specifically for students.

| Column       | Data Type        | Nullable | Notes              |
| :----------- | :--------------- | :------- | :----------------- |
| `student_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `person_id`  | int(10) UNSIGNED | no       | FK to `persons`    |

### 3. `users` table

Manages authentication credentials and account status.

| Column           | Data Type                 | Nullable | Notes                          |
| :--------------- | :------------------------ | :------- | :----------------------------- |
| `user_id`        | int(10) UNSIGNED          | no       | PK, auto-increment             |
| `person_id`      | int(10) UNSIGNED          | no       | FK to `persons`                |
| `account_status` | enum('Inactive','Active') | no       | account is inactive by default |
| `password`       | varchar(255)              | no       | hashed via bcrypt              |

### 4. `referrers` table

Identifies individuals (teachers/staff) who refer students.

| Column        | Data Type        | Nullable | Notes              |
| :------------ | :--------------- | :------- | :----------------- |
| `referrer_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `student_id`  | int(10) UNSIGNED | no       | FK to `students`   |

### 5. `referrals` table

Records the actual referral instance.

| Column        | Data Type        | Nullable | Notes              |
| :------------ | :--------------- | :------- | :----------------- |
| `referral_id` | int(10) UNSIGNED | no       | PK, auto-increment |
| `student_id`  | int(10) UNSIGNED | no       | FK to `students`   |

### 6. `appointments` table

Manages the scheduling of guidance sessions.

| Column               | Data Type                                                                                                                             | Nullable | Notes                 |
| :------------------- | :------------------------------------------------------------------------------------------------------------------------------------ | :------- | :-------------------- |
| `appointment_id`     | int(10) UNSIGNED                                                                                                                      | no       | PK, auto-increment    |
| `referrer_id`        | int(10) UNSIGNED                                                                                                                      | no       | FK to `referrers`     |
| `referral_id`        | int(10) UNSIGNED                                                                                                                      | no       | FK to `referrals`     |
| `appointment_date`   | date                                                                                                                                  | no       | date of appointment   |
| `appointment_time`   | enum('8:30 AM - 9:30 AM', '9:30 AM - 10:30 AM', '10:30 AM - 11:30 AM', '1:30 PM - 2:30 PM', '2:30 PM - 3:30 PM', '3:30 PM - 4:30 PM') | no       | time of appointment   |
| `appointment_status` | enum('Scheduled','Done','Cancelled','Missed')                                                                                         | no       | status of appointment |

### 7. `reports` table

Logs generated system reports.

| Column               | Data Type                                   | Nullable | Notes                            |
| :------------------- | :------------------------------------------ | :------- | :------------------------------- |
| `report_id`          | int(10) UNSIGNED                            | no       | PK, auto-increment               |
| `title`              | varchar(20)                                 | no       | title of the report              |
| `data_category`      | enum('Users','Students','Form Submissions') | no       | data category of the report      |
| `file_output_format` | enum('PDF','Excel')                         | no       | file output format of the report |

### 8. `all_activities` view

Shows all the activities that have been made in the system, combining data from referrals and appointments.

| Column                 | Data Type                                                                                                                             | Nullable | Notes                                  |
| ---------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | -------- | -------------------------------------- |
| `referral_id`          | int(10) UNSIGNED                                                                                                                      | no       | PK in referrals, FK in appointments    |
| `student_id`           | decimal(10,0)                                                                                                                         | yes      | ID of the student involved             |
| `referrer_id`          | decimal(10,0)                                                                                                                         | yes      | ID of the person making the referral   |
| `created_at`           | timestamp                                                                                                                             | yes      | Record creation timestamp              |
| `updated_at`           | timestamp                                                                                                                             | yes      | Record last update timestamp           |
| `appointment_id`       | decimal(10,0)                                                                                                                         | yes      | Unique ID for the appointment          |
| `referral_type`        | enum('Yourself','Someone Else')                                                                                                       | yes      | Type of referral made                  |
| `reason`               | varchar(255)                                                                                                                          | yes      | Reason for the activity                |
| `appointment_date`     | date                                                                                                                                  | yes      | Scheduled date for the appointment     |
| `appointment_time`     | enum('8:30 AM - 9:30 AM', '9:30 AM - 10:30 AM', '10:30 AM - 11:30 AM', '1:30 PM - 2:30 PM', '2:30 PM - 3:30 PM', '3:30 PM - 4:30 PM') | yes      | Time slot for the appointment          |
| `appointment_status`   | enum('Scheduled','Done','Cancelled','Missed')                                                                                         | yes      | Current status of the appointment      |
| `laravel_foreign_key`  | int(10) UNSIGNED                                                                                                                      | yes      | Internal key for Laravel relationships |
| `laravel_model`        | varchar(22)                                                                                                                           | no       | Polymorphic model class name           |
| `laravel_placeholders` | varchar(88)                                                                                                                           | yes      | Metadata for dynamic fields            |
| `laravel_with`         | varchar(0)                                                                                                                            | yes      | Placeholder for eager loading strings  |

---

## Project File System Directory Map

> **_Notes:_**
>
> - The backend file directory map is inspired by the controller code partition principle proposed by Povilas Korop, a Lithuanian Laravel developer, such as the use of "**actions**", "**data transfer objects**", and "**services**" alongside "**models**" and "**controllers**".
> - For more information about this, open and see "**[SOLID Principles in Laravel](https://www.youtube.com/watch?v=ZUMQEkoF1_c)**".

### Backend

#### routes

in "**root/routes/**"

```text
routes/
├─ api.php
├─ auth.php
├─ console.php
├─ livewire.php
├─ miscellaneous.php
└─ web.php
```

---

#### config

in "**root/config/**"

```text
config/
├─ app.php
├─ auth.php
├─ browsershot.php
├─ cache.php
├─ cors.php
├─ database.php
├─ debugbar.php
├─ filesystems.php
├─ holidays.php
├─ ide-helper.php
├─ livewire.php
├─ log-viewer.php
├─ logging.php
├─ mail.php
├─ octane.php
├─ profanity.php
├─ querydetector.php
├─ queue.php
├─ services.php
└─ session.php
```

---

#### database

in "**root/database/**"

```text
database/
├─ factories/
│  ├─ AppointmentFactory.php
│  ├─ PersonFactory.php
│  ├─ ReferralFactory.php
│  ├─ ReferrerFactory.php
│  ├─ StudentFactory.php
│  └─ UserFactory.php
├─ migrations/
│  ├─ laravel/
│  │  ├─ create_cache_locks_table.php
│  │  ├─ create_cache_table.php
│  │  ├─ create_failed_jobs_table.php
│  │  ├─ create_job_batches_table.php
│  │  ├─ create_jobs_table.php
│  │  └─ create_sessions_table.php
│  └─ system/
│     ├─ 01_create_persons_table.php
│     ├─ 02_create_students_table.php
│     ├─ 03_create_users_table.php
│     ├─ 04_create_referrers_table.php
│     ├─ 05_create_referrals_table.php
│     ├─ 06_create_appointments_table.php
│     ├─ 07_create_reports_table.php
│     └─ 08_create_all_activities_view.php
├─ seeders/
│  ├─ AppointmentSeeder.php
│  ├─ DatabaseSeeder.php
│  ├─ ReportSeeder.php
│  ├─ StudentSeeder.php
│  └─ UserSeeder.php
├─ special_scripts/
│  ├─ add_auto_increment.php
│  ├─ empty_database.php
│  ├─ empty_db_except_admin.php
│  ├─ nuke_database.php
│  ├─ nuke_db_if_db_exists.php
│  ├─ randomize_timestamps.php
│  └─ remove_auto_increment.php
├─ .gitignore
└─ testing.sqlite
```

---

#### storage

in "**root/storage/**"

```text
storage/
├─ app/
│  ├─ browsershot-cache/
│  ├─ private/
│  │  ├─ livewire-tmp/
│  │  └─ .gitignore
│  ├─ public/
│  │  ├─ profile-pictures/
│  │  │  └─ *.jpg
│  │  └─ .gitignore
│  └─ .gitignore
├─ debugbar/
├─ framework/
└─ logs/
   ├─ google-forms/
   │  └─ google-forms-YYYY-MM-DD.log
   ├─ .gitignore
   └─ laravel-YYYY-MM-DD.log
```

---

#### tests

in "**root/tests/**"

```text
tests/
├─ Browser/
│  ├─ console/
│  ├─ screenshots/
│  ├─ appointments.spec.js
│  ├─ reports.spec.js
│  ├─ students.spec.js
│  └─ users.spec.js
├─ Feature/
│  ├─ Browser/
│  │  ├─ AppointmentCrudTest.php
│  │  ├─ AuditLogsTest.php
│  │  ├─ DashboardTest.php
│  │  ├─ ReportCrudTest.php
│  │  ├─ StudentCrudTest.php
│  │  ├─ SubmissionsTest.php
│  │  ├─ UserCrudTest.php
│  │  └─ UserProfileTest.php
│  └─ Logic/
│     ├─ AuthenticationTest.php
│     └─ ModelTest.php
├─ Unit/
├─ DuskTestCase.php
├─ Pest.php
├─ TestCase.php
└─ UnitTestCase.php 
```

---

#### app

in "**root/app/**"

```text
app/
├─ Actions/
│  ├─ Appointment/
│  │  ├─ CancelAppointment.php
│  │  ├─ CompleteAppointment.php
│  │  ├─ FilterAppointments.php
│  │  ├─ MarkMissedAppointments.php
│  │  ├─ RescheduleAppointment.php
│  │  ├─ SearchAppointments.php
│  │  └─ UpdateNewDate.php
│  ├─ AuditLog/
│  │  ├─ ClearAuditLogData.php
│  │  ├─ DownloadAuditLog.php
│  │  ├─ FilterAuditLogs.php
│  │  ├─ GetAuditLogs.php
│  │  ├─ GetMarkdownAuditLog.php
│  │  ├─ GetPlainTextAuditLog.php
│  │  ├─ PrepareAuditLogData.php
│  │  ├─ SearchAuditLogs.php
│  │  └─ SortAuditLogs.php
│  ├─ Auth/
│  │  └─ LogoutUser.php
│  ├─ Dashboard/
│  │  ├─ RenderChartStatistics.php
│  │  └─ RenderTextStatistics.php
│  ├─ Data/
│  │  ├─ Statistics/
│  │  │  ├─ RenderAppointmentStatistics.php
│  │  │  ├─ RenderStudentStatistics.php
│  │  │  └─ RenderUserStatistics.php
│  │  ├─ GenerateDatabaseTableRowId.php
│  │  └─ RenderStatisticalData.php
│  ├─ GoogleForms/
│  │  ├─ Generators/
│  │  │  ├─ GenerateImageSubmission.php
│  │  │  ├─ GenerateLogSubmission.php
│  │  │  └─ GeneratePdfSubmission.php
│  │  ├─ DownloadSubmission.php
│  │  ├─ GetLogFiles.php
│  │  ├─ GetOrCreateEntity.php
│  │  ├─ GetSidebarStats.php
│  │  ├─ GetUrls.php
│  │  ├─ ProcessSubmission.php
│  │  └─ RenderSubmission.php
│  ├─ Mail/
│  │  ├─ SendAccountNoticeMail.php
│  │  ├─ SendAppointmentReminderMail.php
│  │  └─ SendOtpMail.php
│  ├─ OTP/
│  │  ├─ FindUserByIdentifier.php
│  │  ├─ GenerateAndSendOTP.php
│  │  └─ ValidateOTP.php
│  ├─ Person/
│  │  └─ UpdatePersonInfo.php
│  ├─ Profile/
│  │  ├─ HandleProfileUpdate.php
│  │  ├─ PrepareProfileUpdatedEvent.php
│  │  ├─ StorePendingProfileUpdate.php
│  │  ├─ UpdateUserProfile.php
│  │  └─ UpdateUserProfilePicture.php
│  ├─ QrCode/
│  │  ├─ DisplayQrCode.php
│  │  ├─ DownloadQrCode.php
│  │  ├─ GenerateQrCode.php
│  │  ├─ GetQrCodeActions.php
│  │  └─ GetQrCodeData.php
│  ├─ Report/
│  │  ├─ DeleteReport.php
│  │  ├─ DownloadReport.php
│  │  ├─ PrepareReportDownloadData.php
│  │  ├─ PrepareReportForm.php
│  │  ├─ RenderReport.php
│  │  └─ SaveReport.php
│  ├─ Student/
│  │  ├─ CreateStudent.php
│  │  ├─ FilterStudents.php
│  │  ├─ SearchStudents.php
│  │  └─ UpdateStudent.php
│  └─ User/
│     ├─ AuthenticateUser.php
│     ├─ DeleteUser.php
│     ├─ FilterUsers.php
│     ├─ RegisterUser.php
│     ├─ ResetUserPassword.php
│     ├─ SearchUsers.php
│     └─ UpdateUserStatus.php
├─ Components/
│  ├─ Atoms/
│  │  ├─ Buttons/
│  │  │  ├─ ActionButtons/
│  │  │  │  ├─ AppointmentGroup.php
│  │  │  │  ├─ AuditLogGroup.php
│  │  │  │  ├─ StudentGroup.php
│  │  │  │  └─ UserGroup.php
│  │  │  ├─ ButtonGroups/
│  │  │  │  ├─ AuditLogButtonGroup.php
│  │  │  │  ├─ FilterButtonGroup.php
│  │  │  │  └─ PageButtonGroup.php
│  │  │  └─ ThemeToggler.php
│  │  ├─ Feedback/
│  │  │  └─ ValidationError.php
│  │  ├─ Forms/
│  │  │  ├─ FieldIcon.php
│  │  │  └─ FieldLabel.php
│  │  ├─ Images/
│  │  │  ├─ SystemLogo.php
│  │  │  └─ UserAvatar.php
│  │  ├─ Inputs/
│  │  │  └─ AuthInput.php
│  │  └─ Utility/
│  │     ├─ DigitalClock.php
│  │     ├─ Spinner.php
│  │     ├─ StatusBadge.php
│  │     └─ StatusDot.php
│  ├─ GoogleForms/
│  │  ├─ Base.php
│  │  └─ InfoSection.php
│  ├─ Layouts/
│  │  ├─ NoticeEmail.php
│  │  ├─ OtpEmail.php
│  │  └─ OtpPage.php
│  ├─ Molecules/
│  │  ├─ Forms/
│  │  │  ├─ AuthForm.php
│  │  │  ├─ FormFooter.php
│  │  │  ├─ FormHeader.php
│  │  │  ├─ GoogleForm.php
│  │  │  ├─ ProfileActionBar.php
│  │  │  ├─ ProfilePhotoEditor.php
│  │  │  ├─ ReportForm.php
│  │  │  ├─ StudentProfileForm.php
│  │  │  ├─ SuffixDropdown.php
│  │  │  └─ UserProfileForm.php
│  │  ├─ LoadingScreens/
│  │  │  ├─ Ls.php
│  │  │  ├─ LsAuth.php
│  │  │  ├─ LsListType.php
│  │  │  ├─ LsLivewire.php
│  │  │  └─ TemplateLs.php
│  │  ├─ Modals/
│  │  │  ├─ AuditLogMessageModal.php
│  │  │  ├─ ConfirmationModal.php
│  │  │  ├─ RescheduleAppointmentModal.php
│  │  │  └─ UserPasswordModal.php
│  │  ├─ Sidebars/
│  │  │  ├─ AuditLogsSidebar.php
│  │  │  ├─ ReportsSidebar.php
│  │  │  ├─ SubmissionsSidebar.php
│  │  │  └─ TemplateSidebar.php
│  │  └─ ToastNotifications/
│  │     ├─ TemplateTn.php
│  │     ├─ Tn.php
│  │     └─ TnAuth.php
│  ├─ Organisms/
│  │  ├─ Layouts/
│  │  │  ├─ Footer.php
│  │  │  ├─ Header.php
│  │  │  └─ Sidebar.php
│  │  ├─ Main/
│  │  │  └─ SubmissionsBody.php
│  │  ├─ Navigation/
│  │  │  ├─ Pagination.php
│  │  │  ├─ PaginationGroup.php
│  │  │  ├─ PaginationResults.php
│  │  │  ├─ RowsPerPage.php
│  │  │  ├─ Search.php
│  │  │  └─ Sort.php
│  │  └─ Tables/
│  │     ├─ Columns/
│  │     │  ├─ Appointment.php
│  │     │  ├─ AuditLog.php
│  │     │  ├─ Student.php
│  │     │  └─ User.php
│  │     ├─ Rows/
│  │     │  ├─ Appointment.php
│  │     │  ├─ AuditLog.php
│  │     │  ├─ Student.php
│  │     │  └─ User.php
│  │     ├─ EmptyState.php
│  │     ├─ InfiniteScrollLoader.php
│  │     ├─ Table.php
│  │     ├─ TableColumn.php
│  │     └─ TableRow.php
│  ├─ Pages/
│  │  └─ ListType.php
│  ├─ Reports/
│  │  └─ Base.php
│  └─ Templates/
│     ├─ AuthenticationPages.php
│     └─ PersonalPages.php
├─ Console/
│  ├─ Commands/
│  │  ├─ BaseCommand.php
│  │  ├─ CleanLivewireTemp.php
│  │  ├─ DebugbarClear.php
│  │  ├─ EnvCheck.php
│  │  ├─ EnvRepair.php
│  │  ├─ GenerateObservers.php
│  │  ├─ IdeHelperRepair.php
│  │  ├─ InternetCheck.php
│  │  ├─ LogsClear.php
│  │  ├─ PestControl.php
│  │  ├─ Setup.php
│  │  ├─ StorageUnlink.php
│  │  ├─ SystemOptimize.php
│  │  ├─ SystemRefresh.php
│  │  ├─ SystemRepair.php
│  │  └─ VendorWarningAndErrorSilence.php
│  └─ Kernel.php
├─ Contracts/
│  ├─ AppointmentServiceContract.php
│  ├─ AuthenticatesUser.php
│  ├─ Colorable.php
│  ├─ CommonModel.php
│  ├─ DeletesUsers.php
│  ├─ HandlesAppointmentEvents.php
│  ├─ HandlesPersonEvents.php
│  ├─ HandlesReferralEvents.php
│  ├─ HandlesReferrerEvents.php
│  ├─ HandlesReportEvents.php
│  ├─ HandlesStudentEvents.php
│  ├─ HandlesUserEvents.php
│  ├─ Nameable.php
│  ├─ RegistersUser.php
│  ├─ ResetsUserPassword.php
│  ├─ SearchsAppointments.php
│  ├─ SearchsStudents.php
│  ├─ SearchsUsers.php
│  └─ UpdatesUserStatus.php
├─ Data/
│  ├─ AppointmentData.php
│  ├─ AppointmentRescheduleData.php
│  ├─ AuthenticateUserData.php
│  ├─ PasswordResetData.php
│  ├─ PersonData.php
│  ├─ ReferralData.php
│  ├─ ReferrerData.php
│  ├─ ReportData.php
│  ├─ StudentData.php
│  ├─ UserData.php
│  ├─ UserRegistrationData.php
│  └─ UserStatusData.php
├─ Enums/
│  ├─ NonDB/
│  │  ├─ AuditLogsStyling.php
│  │  ├─ AuthenticationStyling.php
│  │  ├─ DashboardStyling.php
│  │  ├─ EmailAndPageOTP.php
│  │  ├─ EmailNotice.php
│  │  ├─ Exceptions.php
│  │  ├─ GoogleFormsStyling.php
│  │  ├─ ListTypeModals.php
│  │  ├─ NonDBEnums.php
│  │  ├─ PageButtonStyling.php
│  │  ├─ PaginationStyling.php
│  │  ├─ PhilippineHolidays.php
│  │  ├─ ProfileFormStyling.php
│  │  ├─ QrCodeStyling.php
│  │  ├─ ReportDownloadDataStyling.php
│  │  ├─ ReportFormStyling.php
│  │  └─ SubmissionsStyling.php
│  ├─ AccountStatus.php
│  ├─ AppointmentStatus.php
│  ├─ AppointmentTime.php
│  ├─ DataCategory.php
│  ├─ Enums.php
│  ├─ FileOutputFormat.php
│  ├─ PersonSuffix.php
│  ├─ PersonType.php
│  └─ ReferralType.php
├─ Exceptions/
│  ├─ FalsePositiveException.php
│  ├─ Handler.php
│  ├─ NoInternetConnectionException.php
│  └─ NullException.php
├─ Exports/
│  ├─ Components/
│  │  ├─ Arrays.php
│  │  ├─ Headings.php
│  │  ├─ Styles.php
│  │  └─ Title.php
│  ├─ Report/
│  │  └─ Format.php
│  └─ ReportTypes/
│     ├─ FormSubmissions.php
│     ├─ Students.php
│     └─ Users.php
├─ Http/
│  ├─ Controllers/
│  │  ├─ Controller.php
│  │  ├─ GoogleFormController.php
│  │  ├─ SchedulerController.php
│  │  ├─ StudentProfileController.php
│  │  ├─ SystemController.php
│  │  └─ UserProfileController.php
│  ├─ Middleware/
│  │  ├─ CheckSystemConfiguration.php
│  │  ├─ RedirectIfAuthenticated.php
│  │  └─ UpdateLastActivity.php
│  └─ Requests/
│     ├─ GoogleFormRequest.php
│     ├─ SendOneTimePassword.php
│     ├─ UpdateAppointmentTime.php
│     ├─ UpdateStudentProfile.php
│     ├─ UpdateUserPassword.php
│     └─ UpdateUserProfile.php
├─ Livewire/
│  ├─ Authentication/
│  │  ├─ CreateAccount.php
│  │  ├─ ForgotPassword.php
│  │  ├─ Login.php
│  │  ├─ OneTimePasswordEAC.php
│  │  ├─ OneTimePasswordLogin.php
│  │  └─ OneTimePasswordPNC.php
│  ├─ Bases/
│  │  ├─ BaseListType.php
│  │  └─ BaseOTPType.php
│  ├─ Components/
│  │  ├─ StudentProfileModal.php
│  │  └─ UserProfileModal.php
│  ├─ Forms/
│  │  ├─ LoginForm.php
│  │  ├─ PasswordChangeForm.php
│  │  ├─ RegisterForm.php
│  │  ├─ StudentProfileForm.php
│  │  └─ UserProfileForm.php
│  └─ Pages/
│     ├─ Appointments.php
│     ├─ AuditLogs.php
│     ├─ Dashboard.php
│     ├─ QrCode.php
│     ├─ Reports.php
│     ├─ Students.php
│     ├─ Submissions.php
│     ├─ UserProfile.php
│     └─ Users.php
├─ Mail/
│  ├─ BaseMailable.php
│  ├─ NoticeAccountActivation.php
│  ├─ NoticeAccountDeactivation.php
│  ├─ NoticeAccountDeletion.php
│  ├─ NoticeReferralAppointment.php
│  ├─ OTPEmailAddressChange.php
│  └─ OTPLogin.php
├─ Models/
│  ├─ Appointment.php
│  ├─ Person.php
│  ├─ Referral.php
│  ├─ Referrer.php
│  ├─ Report.php
│  ├─ Student.php
│  └─ User.php
├─ Observers/
│  ├─ AppointmentObserver.php
│  ├─ PersonObserver.php
│  ├─ ReferralObserver.php
│  ├─ ReferrerObserver.php
│  ├─ ReportObserver.php
│  ├─ StudentObserver.php
│  └─ UserObserver.php
├─ Policies/
│  └─ UserPolicy.php
├─ Providers/
│  ├─ AppServiceProvider.php
│  ├─ AppSettingsServiceProvider.php
│  ├─ DatabaseServiceProvider.php
│  ├─ LoggingServiceProvider.php
│  ├─ MailServiceProvider.php
│  ├─ ObserverServiceProvider.php
│  ├─ RouteServiceProvider.php
│  └─ ViewServiceProvider.php
├─ Rules/
│  ├─ AppointmentScheduler.php
│  ├─ DuplicateContactDetails.php
│  ├─ EmailAddressFormat.php
│  ├─ InternetConnection.php
│  ├─ MatchesCurrentFullName.php
│  ├─ OneTimePassword.php
│  ├─ PhoneNumberFormat.php
│  ├─ UserAuthentication.php
│  └─ UserPassword.php
├─ Sanitizers/
│  ├─ AppointmentScheduler.php
│  ├─ DateRangeLimiter.php
│  ├─ DuplicateContactDetails.php
│  ├─ EmailAddressFormat.php
│  ├─ FuzzyNameMatch.php
│  ├─ FuzzyProfanityWordMatch.php
│  ├─ LanguageSanitizer.php
│  ├─ MatchesCurrentFullName.php
│  ├─ NameSanitizer.php
│  ├─ PhoneNumberFormat.php
│  └─ ReferralTypeIntegrity.php
├─ Services/
│  ├─ ListType/
│  │  ├─ AppointmentService.php
│  │  ├─ AuditLogService.php
│  │  ├─ DataFilteringService.php
│  │  ├─ StudentService.php
│  │  └─ UserService.php
│  └─ Miscellaneous/
│     ├─ DashboardService.php
│     ├─ GoogleFormService.php
│     ├─ MailService.php
│     ├─ OTPService.php
│     ├─ ProfileService.php
│     ├─ QrCodeService.php
│     ├─ ReportService.php
│     ├─ SanitizationService.php
│     └─ TextBeeService.php
├─ Support/
│  ├─ EagerLimit/
│  │  ├─ src/
│  │  │  ├─ Grammars/
│  │  │  │  ├─ Traits/
│  │  │  │  │  ├─ CompilesGroupLimit.php
│  │  │  │  │  ├─ CompilesMySqlGroupLimit.php
│  │  │  │  │  ├─ CompilesPostgresGroupLimit.php
│  │  │  │  │  ├─ CompilesSQLiteGroupLimit.php
│  │  │  │  │  └─ CompilesSqlServerGroupLimit.php
│  │  │  │  ├─ MySqlGrammar.php
│  │  │  │  ├─ PostgresGrammar.php
│  │  │  │  ├─ SQLiteGrammar.php
│  │  │  │  └─ SqlServerGrammar.php
│  │  │  ├─ Relations/
│  │  │  │  ├─ BelongsOrMorphToMany.php
│  │  │  │  ├─ BelongsToMany.php
│  │  │  │  ├─ HasLimit.php
│  │  │  │  ├─ HasMany.php
│  │  │  │  ├─ HasManyThrough.php
│  │  │  │  ├─ HasOne.php
│  │  │  │  ├─ HasOneOrManyThrough.php
│  │  │  │  ├─ HasOneThrough.php
│  │  │  │  ├─ MorphMany.php
│  │  │  │  ├─ MorphOne.php
│  │  │  │  └─ MorphToMany.php
│  │  │  ├─ Traits/
│  │  │  │  ├─ BuildsGroupLimitQueries.php
│  │  │  │  └─ HasEagerLimitRelationships.php
│  │  │  ├─ Builder.php
│  │  │  └─ HasEagerLimit.php
│  │  ├─ composer.json
│  │  ├─ LICENSE
│  │  └─ README.md
│  ├─ Formatters/
│  │  ├─ ExceptionLogFormatter.php
│  │  ├─ StandardLogFormatter.php
│  │  └─ StringLogFormatter.php
│  ├─ AppKeyChecker.php
│  ├─ BinaryFinder.php
│  ├─ HolidayClientCustom.php
│  ├─ Json.php
│  ├─ LevenshteinAlgorithm.php
│  ├─ Log.php
│  ├─ LogToMarkdownConverter.php
│  ├─ MarkdownToHtmlConverter.php
│  ├─ Regex.php
│  ├─ ScunthorpeProblemSolver.php
│  ├─ TimeZoneConverter.php
│  └─ VerticalFormatter.php
└─ Traits/
   ├─ Handles/
   │  ├─ HandlesAppointmentActions.php
   │  ├─ HandlesAuditLogActions.php
   │  ├─ HandlesBrowsershot.php
   │  ├─ HandlesOTP.php
   │  ├─ HandlesPostActionNotifications.php
   │  ├─ HandlesStatistics.php
   │  ├─ HandlesStudentActions.php
   │  └─ HandlesUserActions.php
   ├─ Has/
   │  ├─ HasAppInformation.php
   │  ├─ HasFormattedId.php
   │  ├─ HasNameAttributes.php
   │  ├─ HasProfanityList.php
   │  └─ HasValues.php
   ├─ Miscellaneous/
   │  ├─ BaseCommandTrait.php
   │  ├─ IsCommonModel.php
   │  ├─ ManagesTransactions.php
   │  ├─ ProvidesMessages.php
   │  ├─ RendersQRCode.php
   │  └─ Searchable.php
   └─ Sets/
      ├─ SetsDefaultStatus.php
      └─ SetsHighPriority.php
```

---

### Frontend

> **_Notes:_**
>
> - The frontend file directory map is inspired by the principle of Atomic Design by Brad Frost, an American web designer, such as the use of "**atoms**", "**molecules**", "**organisms**", "**templates**", and "**pages**".
> - For more information about this, open and see "**[Atomic Design](https://atomicdesign.bradfrost.com/table-of-contents/)**".

---

#### Assets

in "**root/public/**"

```text
public/
├─ css/
│  ├─ authentication-pages.css
│  └─ personal-pages.css
├─ images/
│  ├─ google-forms.png
│  ├─ HTCGSC-campus.png
│  ├─ HTCGSC-GORMS-logo-white.png
│  └─ HTCGSC-GORMS-logo.png
├─ js/
│  ├─ appointments.js
│  ├─ audit-logs.js
│  ├─ global.js
│  ├─ list-type.js
│  ├─ otp-page.js
│  ├─ qr-code.js
│  ├─ reports.js
│  ├─ session-flash.js
│  ├─ student-profile.js
│  ├─ submissions.js
│  ├─ tailwind-config.js
│  ├─ theme-init.js
│  └─ user-profile.js
├─ .htaccess
├─ index.php
└─ robots.txt
```

---

#### Laravel Blade

in "**root/resources/**"

```text
resources/
├─ css/
│  └─ app.css
├─ js/
│  └─ app.js
└─ views/
   ├─ components/
   │  ├─ atoms/
   │  │  ├─ buttons/
   │  │  │  ├─ action-buttons/
   │  │  │  │  ├─ appointment-group.blade.php
   │  │  │  │  ├─ audit-log-group.blade.php
   │  │  │  │  ├─ student-group.blade.php
   │  │  │  │  └─ user-group.blade.php
   │  │  │  ├─ button-groups/
   │  │  │  │  ├─ audit-log-button-group.blade.php
   │  │  │  │  ├─ filter-button-group.blade.php
   │  │  │  │  └─ page-button-group.blade.php
   │  │  │  └─ theme-toggler.blade.php
   │  │  ├─ feedback/
   │  │  │  └─ validation-error.blade.php
   │  │  ├─ forms/
   │  │  │  ├─ field-icon.blade.php
   │  │  │  └─ field-label.blade.php
   │  │  ├─ images/
   │  │  │  ├─ system-logo.blade.php
   │  │  │  └─ user-avatar.blade.php
   │  │  ├─ inputs/
   │  │  │  └─ auth-input.blade.php
   │  │  └─ utility/
   │  │     ├─ digital-clock.blade.php
   │  │     ├─ spinner.blade.php
   │  │     ├─ status-badge.blade.php
   │  │     └─ status-dot.blade.php
   │  ├─ google-forms/
   │  │  ├─ base.blade.php
   │  │  ├─ image.blade.php
   │  │  ├─ info-section.blade.php
   │  │  └─ pdf.blade.php
   │  ├─ layouts/
   │  │  ├─ notice-email.blade.php
   │  │  ├─ otp-email.blade.php
   │  │  └─ otp-page.blade.php
   │  ├─ molecules/
   │  │  ├─ data-display/
   │  │  │  ├─ line-chart.blade.php
   │  │  │  ├─ qr-code-display.blade.php
   │  │  │  └─ statistics-card.blade.php
   │  │  ├─ forms/
   │  │  │  ├─ auth-form.blade.php
   │  │  │  ├─ form-footer.blade.php
   │  │  │  ├─ form-header.blade.php
   │  │  │  ├─ google-form.blade.php
   │  │  │  ├─ profile-action-bar.blade.php
   │  │  │  ├─ profile-photo-editor.blade.php
   │  │  │  ├─ report-form.blade.php
   │  │  │  ├─ student-profile-form.blade.php
   │  │  │  ├─ suffix-dropdown.blade.php
   │  │  │  └─ user-profile-form.blade.php
   │  │  ├─ loading-screens/
   │  │  │  ├─ ls-auth.blade.php
   │  │  │  ├─ ls-list-type.blade.php
   │  │  │  ├─ ls-livewire.blade.php
   │  │  │  ├─ ls.blade.php
   │  │  │  └─ template-ls.blade.php
   │  │  ├─ modals/
   │  │  │  ├─ audit-log-message-modal.blade.php
   │  │  │  ├─ confirmation-modal.blade.php
   │  │  │  ├─ reschedule-appointment-modal.blade.php
   │  │  │  └─ user-password-modal.blade.php
   │  │  ├─ navigation/
   │  │  │  └─ qr-code-actions.blade.php
   │  │  ├─ sidebars/
   │  │  │  ├─ audit-logs-sidebar.blade.php
   │  │  │  ├─ reports-sidebar.blade.php
   │  │  │  ├─ submissions-sidebar.blade.php
   │  │  │  └─ template-sidebar.blade.php
   │  │  └─ toast-notifications/
   │  │     ├─ template-tn.blade.php
   │  │     ├─ tn-auth.blade.php
   │  │     └─ tn.blade.php
   │  ├─ organisms/
   │  │  ├─ layouts/
   │  │  │  ├─ footer.blade.php
   │  │  │  ├─ header.blade.php
   │  │  │  └─ sidebar.blade.php
   │  │  ├─ main/
   │  │  │  └─ submissions-body.blade.php
   │  │  ├─ navigation/
   │  │  │  ├─ pagination-group.blade.php
   │  │  │  ├─ pagination-results.blade.php
   │  │  │  ├─ pagination.blade.php
   │  │  │  ├─ rows-per-page.blade.php
   │  │  │  ├─ search.blade.php
   │  │  │  └─ sort.blade.php
   │  │  └─ tables/
   │  │     ├─ columns/
   │  │     │  ├─ appointment.blade.php
   │  │     │  ├─ audit-log.blade.php
   │  │     │  ├─ student.blade.php
   │  │     │  └─ user.blade.php
   │  │     ├─ rows/
   │  │     │  ├─ appointment.blade.php
   │  │     │  ├─ audit-log.blade.php
   │  │     │  ├─ student.blade.php
   │  │     │  └─ user.blade.php
   │  │     ├─ empty-state.blade.php
   │  │     ├─ infinite-scroll-loader.blade.php
   │  │     ├─ table-column.blade.php
   │  │     ├─ table-row.blade.php
   │  │     └─ table.blade.php
   │  ├─ pages/
   │  │  └─ list-type.blade.php
   │  └─ reports/
   │     ├─ base.blade.php
   │     ├─ form-submissions.blade.php
   │     ├─ students.blade.php
   │     └─ users.blade.php
   ├─ emails/
   │  ├─ notice-account-activation.blade.php
   │  ├─ notice-account-deactivation.blade.php
   │  ├─ notice-account-deletion.blade.php
   │  ├─ notice-referral-appointment.blade.php
   │  ├─ otp-email-address-change.blade.php
   │  └─ otp-login.blade.php
   ├─ errors/
   │  ├─ 400.blade.php
   │  ├─ 401.blade.php
   │  ├─ 403.blade.php
   │  ├─ 404.blade.php
   │  ├─ 405.blade.php
   │  ├─ 406.blade.php
   │  ├─ 407.blade.php
   │  ├─ 408.blade.php
   │  ├─ 409.blade.php
   │  ├─ 410.blade.php
   │  ├─ 411.blade.php
   │  ├─ 412.blade.php
   │  ├─ 413.blade.php
   │  ├─ 414.blade.php
   │  ├─ 415.blade.php
   │  ├─ 416.blade.php
   │  ├─ 417.blade.php
   │  ├─ 419.blade.php
   │  ├─ 421.blade.php
   │  ├─ 422.blade.php
   │  ├─ 423.blade.php
   │  ├─ 425.blade.php
   │  ├─ 426.blade.php
   │  ├─ 428.blade.php
   │  ├─ 429.blade.php
   │  ├─ 431.blade.php
   │  ├─ 500.blade.php
   │  ├─ 501.blade.php
   │  ├─ 502.blade.php
   │  ├─ 503.blade.php
   │  ├─ 504.blade.php
   │  └─ errors.blade.php
   ├─ layouts/
   │  ├─ authentication-pages.blade.php
   │  └─ personal-pages.blade.php
   └─ livewire/
      ├─ authentication/
      │  ├─ create-account.blade.php
      │  ├─ forgot-password.blade.php
      │  ├─ login.blade.php
      │  ├─ one-time-password-eac.blade.php
      │  ├─ one-time-password-login.blade.php
      │  └─ one-time-password-pnc.blade.php
      ├─ components/
      │  ├─ student-profile-modal.blade.php
      │  └─ user-profile-modal.blade.php
      └─ pages/
         ├─ appointments.blade.php
         ├─ audit-logs.blade.php
         ├─ dashboard.blade.php
         ├─ qr-code.blade.php
         ├─ reports.blade.php
         ├─ students.blade.php
         ├─ submissions.blade.php
         ├─ user-profile.blade.php
         └─ users.blade.php
```

---

<p align="center">
    <b>Thank you for understanding and reaching the end of the description!</b>
    <br>
    Developed with ❤️ by <b>Benhur L. Cariaga</b>
</p>
