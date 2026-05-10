# Context and Guidelines Related to HTCGSC-GORMS for AI Chatbots and Agents

Think of this document as a `README.md` dedicated specifically for AI chatbots and agents. It provides the architectural context, development commands, and coding standards you need to interact smoothly and effectively with the HTCGSC-GORMS repository.

## About the System

**HTCGSC-GORMS** (Holy Trinity College of General Santos City – Guidance Office Records Management System) is a web application designed for the school's Guidance and Testing Center (GTC). It is a records management system that is used to store, manage, and retrieve records of students who have undergone GTC's services. The system is also used to generate reports and statistics on the usage of the GTC's services.

- **Tech Stack:** TALL Stack (Tailwind CSS v4+, Alpine.js, Laravel 13+, Livewire 3+)
- **Languages:** HTML, CSS, JavaScript, PHP 8.4+
- **Databases:** MySQL (local development) / PostgreSQL (production)

## 1. Development Environment Tips

- The frontend assets are bundled using **Vite**. Use `npm run dev` while iterating on the frontend to enable hot-reload (HMR). Do not use `npm run build` unless explicitly required for production testing, as it disables HMR.
- Backend logic uses **Composer** and **Artisan**.
- If setting up the project from scratch, use `composer run setup` to automatically generate the `.env`, generate the app key, run the uniquely ordered migrations, seed the database, and link storage.
- The application relies heavily on specialized Laravel packages (such as `staudenmeir/laravel-adjacency-list`, `livewire/livewire`). Always check `composer.json` before assuming a specific feature implementation.

## 2. File Organization and Navigation

Instead of guessing or blindly searching for project structures, consult these dedicated maps:

- **[DIRECTORIES.md](./DIRECTORIES.md):** Deep dives into the non-standard folder structures (like the heavily utilized `app/` and `resources/` directories).
- **[FILE_DIRECTORY_MAP.md](./FILE_DIRECTORY_MAP.md):** A comprehensive visual tree of the entire project structure.
- **[DATABASE_SCHEMA.md](./DATABASE_SCHEMA.md):** Detailed breakdown of all tables, columns, constraints, and views.
- **[LARAVEL_BEST_PRACTICES.md](./LARAVEL_BEST_PRACTICES.md):** The core architectural rules (such as early returns, skinny controllers, Atomic Design UI) you MUST follow.
- **[vibe-coding-prompts/](./vibe-coding-prompts/):** A dedicated directory containing specialized prompts for generating or refactoring code within this system.

## 3. Coding Conventions

- **Skinny Controllers:** Move business logic out of controllers and into dedicated `app/Actions/`, `app/Services/`, or `app/Data/` classes. Controllers should only receive requests and return responses.
- **Atomic Design:** Blade views (`resources/views/components/`) are structured using Atomic Design (Atoms, Molecules, Organisms, Templates, Pages). Stick to this hierarchy.
- **Eloquent Optimization:** Eager load database relationships using `with()` to prevent N+1 query problems. Lazy loading is strictly prevented in development mode.
- **Styling:** Use Tailwind CSS utility classes directly in Blade templates. Avoid creating custom CSS unless necessary.

## 4. Testing Instructions

- The project uses a split testing suite: **Vitest / Playwright** for the frontend and **Pest** for the backend.
- Run `npm test` to execute both the Vitest and Playwright test suites.
- For backend testing, run `./vendor/bin/pest`.
- Always run the relevant test suite before concluding your task to ensure no regressions have been introduced.

## 5. Keep Dependencies in Sync

If you are asked to add or update dependencies:

1. Use `npm install <package>` or `composer require <package>`.
2. Update the appropriate configuration files.
3. Restart the Vite or Laravel development server (if running) so the changes are picked up.

## Useful Commands Recap

| Command              | Purpose                                                      |
| -------------------- | ------------------------------------------------------------ |
| `npm run dev`        | Start the Vite dev server with Hot Module Replacement (HMR). |
| `npm run build`      | **Production build – do not run during standard iteration.** |
| `composer run setup` | Run the complete database migration and seeding pipeline.    |
| `npm test`           | Run the JavaScript (Vitest) and E2E (Playwright) tests.      |
| `./vendor/bin/pest`  | Run the PHP test suite.                                      |

---

Following these practices ensures that your workflow remains fast, dependable, and aligned with the established architecture. When in doubt, consult the documentation files listed in section 2.
