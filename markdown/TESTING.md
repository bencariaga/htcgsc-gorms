# Testing Guide

This document describes the testing architecture and how to run automated tests for the HTCGSC-GORMS system.

## 1. Running Tests

To run the full suite of logic and browser tests, ensure the environment is running, then use:

```powershell
npm run test

```

Specific test types can be targeted directly:

* **Logic Tests (Pest):** `php artisan test` or `vendor/bin/pest`
* **Browser Tests (Playwright):** `npx playwright test`

## 2. Test Types and Best Practices

Adopting the Laravel Daily philosophy, the focus is on practical CRUD testing and ensuring the "Happy Path" (success) and "Sad Path" (validation/failure) are covered.

### Feature/Logic Tests

These tests validate backend logic and models using Pest.

* **CRUD Operations:** Test that records are correctly saved, updated, and deleted in the database.
* **Authentication:** Verify users can log in and that protected routes redirect guests.
* **Validation:** Ensure Form Requests catch invalid data and return the correct error messages.

### Browser Tests

These tests use Pest 4 and Playwright to imitate real user interactions within the browser.

* **End-to-End Workflows:** Testing the full cycle of an appointment from creation to completion.
* **UI Feedback:** Asserting that the correct success toast notifications or validation errors appear on the screen.

## 3. Key Testing Rules

* **Use Factories:** Do not hard-code IDs; write factory classes and always use them to generate fresh dummy data.
* **Clean State:** Use the `RefreshDatabase` trait to ensure every test starts with a clean slate.
* **No Extra Comments:** Tests should be self-documenting through clear description strings in Pest.
* **Flattened Logic:** Keep tests concise by using Pest hooks (`beforeEach`) to refactor repeating code.
