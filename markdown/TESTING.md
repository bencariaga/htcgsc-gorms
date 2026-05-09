# Testing Guide

This document describes the testing architecture and how to run automated tests for the HTCGSC-GORMS system.

## 1. Running Tests

To run the full suite of logic and browser tests (via Pest and Playwright), ensure your environment is running, then use:

```powershell
npm run test
```

*(This triggers both `npm run test:vitest` and `npm run test:playwright` as defined in `package.json`)*

## 2. Test Types

### Feature/Browser Tests

These tests use Laravel Dusk and Playwright to imitate user browser interactions. They validate end-to-end workflows like CRUD operations and UI behavior.

* **Location:** `tests/Feature/Browser/`
* **Technology:** Laravel Dusk (PHP) and Playwright (JavaScript)

### Feature/Logic Tests

These tests use Pest to validate backend logic, models, and authentication without necessarily launching a browser.

* **Location:** `tests/Feature/Logic/`
* **Technology:** Pest PHP

## 3. Test Directory Map

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
