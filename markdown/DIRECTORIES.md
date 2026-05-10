# Directory Structure Guide

This document provides a detailed, comprehensive explanation of every directory in the project. It is designed to help developers—both new and experienced—understand the specific, non-standard patterns and architecture used in this system.

## 1. Architecture Overview

The system follows a highly structured, decoupled architecture built on modern standards:

- **Laravel 13+ Core:** Built on the latest Laravel conventions.
- **SOLID Principles:** Single-responsibility actions and decoupled services.
- **Action-Based Logic:** Business logic is encapsulated in single-responsibility Action classes rather than bloated Controllers.
- **Atomic Design:** UI components are organized into Atoms, Molecules, and Organisms (both in Blade and PHP classes).
- **Type Safety:** Extensive use of Data Transfer Objects (DTOs) and Enums for predictable data flow.
- **Reactive Frontend:** Powered by Livewire and Alpine.js for an experience like in single-page applications (SPA) without leaving the Laravel ecosystem.

---

## 2. Backend Architecture

The backend handles the "brain" and "nervous system" of the application, managing data flow, business rules, and server-side configuration.

### 📂 `app/`

The core logic of the application. It is organized into specialized layers to ensure SOLID principles.
> [!NOTE]
> See the **[Backend Deep Dive](#backend-deep-dive-app)** for a detailed breakdown of its specialized directories.

### 📂 `bootstrap/`

The framework's entry point and initialization hub.

- **`app.php`**: The modern Laravel configuration hub. This is where routing, middleware, and exception handling are registered and configured. It replaces several files from older Laravel versions.
- **`providers.php`**: Lists all active service providers that bootstrap various components of the application.
- **`cache/`**: Contains framework-generated files for performance optimization, such as route and configuration caches.

### 📂 `config/`

The files here serve specific purposes, defining how the various services of the system interact with each other and the server environment. They return simple PHP arrays. When the application boots, Laravel loads these into memory, allowing the user to access them anywhere using the `config()` helper.

- **`app.php`**: The heart of the configuration. This is where the user sets the application name, environment (production vs. local), encryption keys, and most importantly, the timezone and locale.
- **`auth.php`**: This defines the "guards" (how users are authenticated, like sessions or tokens) and "providers" (where the user data lives, usually the database).
- **`browsershot.php`**: Since the user is likely generating PDFs or reports, this file tells the system where to find the Node.js and Headless Chrome binaries needed to render those pages.
- **`cache.php`**: Manages where temporary data is stored to speed up the app. It could be in the file system for local work or Redis for production.
- **`cors.php`**: Crucial for security. It tells the server which domains are allowed to make requests to the application, preventing unauthorized cross-site scripts.
- **`database.php`**: The connection hub. It maps out how the app talks to MySQL, PostgreSQL, or Redis, including the ports, usernames, and passwords.
- **`debugbar.php`**: Settings for that handy toolbar used during development. It controls which tabs (Queries, Logs, Timeline) are visible.
- **`filesystems.php`**: This is where the user defines the "disks" we discussed in the `storage/` breakdown. It maps the logical disk names to physical paths or cloud buckets.
- **`holidays.php`**: A custom-built config for this specific project. It likely stores a list of Philippine holidays, helping the logic determine if a certain date is a school day or a working day.
- **`ide-helper.php`**: A developer-only tool. It generates the metadata files that help VS Code or PHPStorm understand the "magic" behind Laravel's facades.
- **`livewire.php`**: The brain of the TALL stack. It sets the limits for file uploads and defines how components update without a full page refresh.
- **`log-viewer.php`**: Configures the UI for reading those logs we saw in the `storage/logs` folder, making it easy to spot errors in the browser.
- **`logging.php`**: This is where the user defines the "channels." For example, the `google-forms` log channel is registered here to ensure those specific events go into the right file.
- **`mail.php`**: Everything related to sending emails. Whether using an SMTP server or an API like Mailgun, the "from" address and credentials live here.
- **`octane.php`**: For when the app needs to be lightning-fast. It configures high-performance servers like Swoole to keep the app in memory.
- **`profanity.php`**: The gatekeeper for user input. It holds the lists of forbidden words and the logic for how to mask them in the UI.
- **`querydetector.php`**: A "smoke alarm" for performance. It alerts the user during development if they have an N+1 query problem that's slowing down the database.
- **`queue.php`**: Manages background tasks. If the user is sending emails or generating large reports, this file tells Laravel how to handle those tasks in the background.
- **`services.php`**: The "junk drawer" for third-party API keys. Instead of 20 different files, keys for things like Google Maps or Mailgun are centralized here.
- **`session.php`**: Controls how the system remembers users. It sets how long a user stays logged in and whether that "session" is stored in a cookie or the database.

### 📂 `database/`

This directory is the "blueprint" of your system. It defines how data is structured, how it’s generated for testing, and provides the tools to reset everything when you're experimenting.

- **`factories/`**: These are your "blueprints" for fake data. Instead of manually typing out names and emails, you define a pattern here.
- **`migrations/`**: This is version control for your database.
  - **`laravel/`**: This subfolder contains the "plumbing" tables—things Laravel needs to function, like job queues, sessions, and cache management. By moving them here, they don't clutter your main migration list.
  - **`system/`**: This is the heart of the GORMS project. The numbered prefix (e.g., `01_`, `02_`) ensures that tables are created in the correct order to respect Foreign Key constraints (like making sure a `Person` exists before you create a `Student`). It also includes **database views** (like `08_create_all_activities_view.php`), which are great for flattening complex queries for your dashboard.
- **`seeders/`**: While factories make the "what," seeders handle the "how much."
- **`special_scripts/`**: These are the "power tools" for the developer.

---

### 📂 `routes/`

Route definitions are decoupled into specialized files for clarity and maintainability:

- **`web.php`**: Main application routes for browser-based navigation.
- **`auth.php`**: Routes handling login, registration, password resets, and OTP flows.
- **`api.php`**: External-facing API endpoints.
- **`livewire.php`**: Specific routes required for reactive component updates.
- **`console.php`**: Definitions for Artisan commands.
- **`miscellaneous.php`**: Utility or one-off routes.

### 📂 `storage/`

This directory is the dedicated home for all files generated by the framework and those uploaded by the users.

- **`app/`**: This is the main hub for your application's files.
  - **`app/public/`**: This is where you put files that need to be seen by the world—like those `profile-pictures/` you mentioned. Remember, these aren't accessible via a URL until you run `php artisan storage:link`, which creates a "shortcut" from your `public/storage` folder to this directory.
  - **`app/private/`**: A safe spot for files that should *never* be public, like sensitive documents or exported reports. The `livewire-tmp/` folder here is handled by Livewire to store temporary file uploads before they are permanently moved.
  - **`app/browsershot-cache/`**: If you are using Spatie’s Browsershot to generate PDFs or screenshots, this is where it stores temporary data to speed up subsequent requests.
- **`logs/`**: Your application's diary.
  - **`laravel-YYYY-MM-DD.log`**: By default, Laravel writes errors and system events here. In a production environment, I always recommend setting up "daily" logging with only seven (7) logs so you do not end up with one huge log file that may be impossible to open quickly.
  - **`google-forms/`**: It looks like you’ve implemented custom logging channels. This is a great practice—separating logs for Google Forms that makes debugging those specific features much easier without digging through system-wide errors. **FORMAT:** **`google-forms-YYYY-MM-DD.log`**.
- **`framework/`**: The framework's internal engine room.
- **`cache/`**: Stores data to avoid expensive database queries.
- **`sessions/`**: If you aren't using Redis or a database for sessions, Laravel stores the text files for user sessions here.
- **`views/`**: Contains compiled Blade templates. When you change a `.blade.php` file, Laravel "re-compiles" it into plain PHP and stores it here for performance.
- **`debugbar/`**: If you have the `barryvdh/laravel-debugbar` or `fruitcake/laravel-debugbar` package installed, it stores its data here to show you those nice timelines and query counts in the browser.

### 📂 `tests/`

This directory houses your automated testing suite, ensuring that new features don't break existing logic and that the user interface behaves as expected.

- **`Browser/`**: This is where the heavy lifting for End-to-End (E2E) testing happens. Using Playwright, these scripts simulate a real human clicking through the site.
  - **`console/` and `screenshots/`**: These folders store automated artifacts. If a test fails, the system captures a screenshot or a console log so the user can see exactly what went wrong in the headless browser.
  - **`*.spec.js` files**: These scripts (like `users.spec.js`) verify complex frontend flows, such as filling out a multi-step form or interacting with reactive Livewire elements that simple unit tests can't see.
- **`Feature/`**: These tests check larger "slices" of your application, usually hitting an endpoint and verifying the database or the response.
  - **`Browser/` (Pest/Playwright bridge)**: It looks like these PHP files (like `UserCrudTest.php`) act as the orchestrators for your browser tests, ensuring the environment is set up before the JS specs run.
  - **`Logic/`**: This is where the "heavy" backend verification happens. `AuthenticationTest.php` ensures your guards are secure, while `ModelTest.php` checks that your relationships and traits are working correctly.
- **`Unit/`**: The smallest level of testing. These tests check individual methods in isolation without ever touching the database or the internet. They are lightning-fast.
- **Base Configuration Files**:
- **`Pest.php`**: The heart of your testing experience. This is where you configure your expectations, link your base test cases, and keep your test code clean and readable.
- **`TestCase.php` & `DuskTestCase.php**`: The foundational classes that all your tests inherit from. They handle the "booting" of the Laravel application for each test run.

---

## 3. Frontend Architecture

The frontend manages the user experience, styling, and reactive interface elements.

### 📂 `public/`

The only directory exposed to the web server. It contains compiled assets and the main entry point.

- **`index.php`**: The entry point for all requests entering the application.
- **`.htaccess`**: Server configuration for Apache (handling URL rewrites).
- **`css/`**: Production-ready stylesheets, specifically `personal-pages.css` and `authentication-pages.css`.
- **`js/`**: Modularized JavaScript components including:
  - **`theme-init.js`**: Handles theme switching (light and dark modes) and persistence.
  - **`global.js`**: Shared utility functions used across all pages.
  - **`tailwind-config.js`**: Configuration for on-the-fly styling adjustments.
  - **Feature-specific scripts**: Scripts tailored for specific modules like `appointments.js`, `student-profile.js`, and `user-profile.js`.
- **`images/`**: High-quality branding assets, logos, and system-wide static images.
- **`storage/`**: A symbolic link to `storage/app/public`, exposing user uploads to the web.

### 📂 `resources/`

The source code for the frontend, following the Atomic Design pattern.
> [!NOTE]
> See the **[Frontend Deep Dive](#frontend-deep-dive-resources)** for a detailed breakdown of its view components.

---

## Backend Deep Dive (`app/`)

The `app/` folder is organized into specialized layers to ensure modularity and testability.

### 🧩 Business Logic

- **`Actions/`**: Single-responsibility classes handling specific business tasks, divided in modules and further subdivided in sub-modules.
- **`Services/`**: Larger logic blocks that coordinate multiple actions or external integrations.
- **`Sanitizers/`**: Logic for cleaning and normalizing user input before it reaches the database.
- **`Contracts/`**: Interfaces that define the "blueprint" for services and actions.

### 🎨 Presentation Logic

- **`Components/`**: PHP classes for the project's **Atomic Design** system. These mirror the Blade components in `resources/views/components`.
- **`Livewire/`**: Reactive component classes.
- **`Http/`**: Contains standard `Controllers` (for the frontend and API routing), `Middleware` (for inspecting and filtering HTTP requests entering the system), and `Requests` (for data validation in form request submissions).
- **`Exports/`**: Configuration for generating spreadsheet reports.
- **`Mail/`**: Mailable classes for system notifications.

### 📦 Data & State Management

- **`Models/`**: Eloquent ORM classes representing database tables.
- **`Data/`**: **Data Transfer Objects (DTOs)** used to pass strictly typed data between layers.
- **`Enums/`**: Strict typing for database states and UI configurations.
  - **`NonDB/`**: Specialized enums that do not directly use the enums from the database tables but that are used for driving UI styling and messages from the backend.
- **`Observers/`**: Event listeners that hook into Model lifecycle events.
- **`Policies/`**: Authorization logic to determine user permissions.
- **`Rules/`**: Custom validation rules used in Form Requests.

### 🛠️ Infrastructure & Utilities

- **`Support/`**: The project's utility hub. Contains custom algorithms (Levenshtein), log formatters, and specialized libraries.
- **`Traits/`**: Reusable logic snippets shared across the system (`Handles/`, `Has/`, `Sets/`, and `Miscellaneous/`).
- **`Console/`**: Custom Artisan commands for system maintenance and setup.
- **`Exceptions/`**: Custom exception classes and the global `Handler.php`.
- **`Providers/`**: Service providers that bootstrap application components.

---

## Frontend Deep Dive (`resources/`)

The frontend source code is structured for high reusability and clear separation of concerns.

### **`css/` & `js/`**

- **`css/app.css`**: The main entry point for styles, handling Tailwind CSS imports.
- **`js/app.js`**: The primary JavaScript entry point where Alpine.js or other libraries are initialized.

#### **`views/components/` (Atomic Design Architecture)**

This directory follows a hierarchical structure to manage UI complexity:

- **`atoms/`**: The most basic, indivisible elements.
- **`buttons/`**: Contains specialized `action-buttons` for specific entities (like students or users) and `button-groups` for pagination or filtering.
- **`feedback/`**: Components for displaying `validation-error` messages.
- **`forms/`**: Small helpers like `field-icon` and `field-label`.
- **`utility/`**: Functional UI helpers like a `digital-clock`, `spinner` for loading states, and `status-badge` or `status-dot` for visual indicators.

- **`molecules/`**: Combinations of atoms that perform a single task.
- **`data-display/`**: Visual elements like `line-chart` and `qr-code-display`.
- **`forms/`**: Composite form units, including the `profile-photo-editor` and `suffix-dropdown`.
- **`loading-screens/`**: Full-component or full-page placeholders (skeletons) like `ls-list-type`.
- **`modals/`**: Specialized pop-ups for tasks like `reschedule-appointment-modal` or `confirmation-modal`.
- **`toast-notifications/`**: Ephemeral feedback messages like `tn-auth`.

- **`organisms/`**: Complex UI blocks composed of molecules and atoms.
- **`layouts/`**: Core structural parts of the app shell, such as the `header.blade.php`, `footer.blade.php`, and the main `sidebar.blade.php`.
- **`navigation/`**: Reusable navigation logic including `pagination`, `search`, and `sort` blocks.
- **`tables/`**: A robust table system with separate files for `columns` and `rows` tailored for each data type (Audit Logs, Students, etc.), along with `empty-state` handlers.

---

#### **Specialized Component Groups**

- **`google-forms/`**: Templates specifically designed for rendering Google Form data, including dedicated views for `image.blade.php` and `pdf.blade.php` submissions.
- **`reports/`**: Structural templates for generating document-style views, such as `form-submissions.blade.php` or `students.blade.php`.
- **`pages/`**: High-level component wrappers for specific page types, like `list-type.blade.php`.

---

#### **`views/emails/` & `views/errors/**`

- **`emails/`**: A library of user-facing notifications, including `notice-account-activation` and `otp-login` emails.
- **`errors/`**: A comprehensive set of custom error pages covering almost every HTTP status code from `400` to `500`.

---

#### **`views/livewire/`**

These are the template files that correspond to your reactive Livewire components:

- **`authentication/`**: Views for the login and registration flows, including multiple "One-Time Password" (OTP) variations like `one-time-password-eac`.
- **`components/`**: Template files for dynamic UI components like `user-profile-modal`.
- **`pages/`**: The primary views for the application’s main features, such as `appointments.blade.php`, `dashboard.blade.php`, and `audit-logs.blade.php`.

---
