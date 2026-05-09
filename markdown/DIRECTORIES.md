# Directory Structure Guide

This document provides a detailed explanation of the project's architecture and the purpose of specific directories.

## 1. Architecture Overview

The system follows a structured approach combining:

- **Laravel Core Conventions:** Standard Laravel 13+ folder structure.
- **SOLID Principles:** Single-responsibility actions and decoupled services.
- **Atomic Design:** Frontend component organization (Atoms, Molecules, Organisms).

## 2. Core Directories

### Backend (`app/`)

The core logic of the application:

- **`Actions/`**: Single-responsibility classes handling specific business tasks (e.g., `CreateStudent.php`).
- **`Console/`**: Custom Artisan commands (e.g., `Setup.php`).
- **`Data/`**: Data Transfer Objects (DTOs) for strongly typed data handling via `spatie/laravel-data`.
- **`Http/Controllers/`**: Standard controllers managing HTTP requests.
- **`Livewire/`**: Livewire component classes for reactive UI.
- **`Models/`**: Eloquent ORM models representing database tables.
- **`Services/`**: Reusable business logic shared across the system.
- **`Traits/`**: Shared functionality used across multiple classes.

### Database (`database/`)

Handles database structuring and initial data:

- **`migrations/`**: Table definitions in `system/` and `laravel/` folders.
- **`factories/`**: Fake data generators for testing.
- **`seeders/`**: Initial data population (e.g., `UserSeeder`).
- **`special_scripts/`**: Utility scripts like `nuke_database.php`.

### Frontend Assets & Resources

- **`public/`**: Compiled assets (CSS, JS, images). This is the web server's document root.

- **`resources/`**: Uncompiled assets and Blade templates.
  - **`views/`**: Structured via Atomic Design:
    - `atoms/`: Basic elements (buttons, inputs).
    - `molecules/`: Groups of atoms (form fields).
    - `organisms/`: Complex components (sidebars, tables).
    - `templates/`: Layout wrappers.
    - `pages/`: Full page views.

### Configuration & Bootstrap

- **`config/`**: System configuration files loaded from `.env`.

- **`bootstrap/`**: Framework initialization and middleware setup.

### Storage & Routes

- **`routes/`**: URL definitions (`web.php`, `api.php`, `console.php`).

- **`storage/`**: Framework files (logs, cache, sessions) and user uploads. Link to public via `php artisan storage:link`.

## 3. Detailed Directory Map

### Backend Map

```text
app/
├─ Actions/
├─ Console/
├─ Contracts/
├─ Data/
├─ Enums/
├─ Exceptions/
├─ Exports/
├─ Http/
├─ Livewire/
├─ Models/
├─ Observers/
├─ Policies/
├─ Providers/
├─ Rules/
├─ Sanitizers/
├─ Services/
├─ Support/
└─ Traits/
```

### Full File System Map

Refer to the **[README.md](../README.md)** for the complete visual map of every file in the project.
