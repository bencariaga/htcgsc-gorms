# Laravel Best Practices

This guide outlines the core architectural principles, performance optimization strategies, and coding standards adopted for this project. These practices ensure the codebase remains maintainable, secure, and efficient, aligning with the TALL stack (Tailwind, Alpine.js, Laravel, Livewire) architecture.

## Contents

- [Architecture and Code Organization](#architecture-and-code-organization)
- [Database and Eloquent Performance](#database-and-eloquent-performance)
- [Frontend: Livewire, Alpine, and Blade](#frontend-livewire-alpine-and-blade)
- [Security and Routing](#security-and-routing)
- [Code Formatting](#code-formatting)

---

## Architecture and Code Organization

### Single Responsibility and Flat Code

Keep your logic simple and flat by using **Early Returns** (Guard Clauses) instead of deeply nested `if/else` statements.
Handle errors and invalid states at the top of the function.

```php
// Bad: Deeply nested
public function process() {
    if ($condition) {
        if ($anotherCondition) {
            return $success;
        }
    }
}

// Good: Early returns
public function process() {
    if (!$condition) {
        throw new Exception('...');
    }
    
    if (!$anotherCondition) {
        throw new Exception('...');
    }
    
    return $success;
}
```

### Skinny Controllers with Dedicated Actions, Services, and Jobs

Controllers should only receive a request and return a response. Move all business logic out of controllers:

- **Actions:** Use for a single, specific task (like `CreateUserAction`, `CancelAppointment`).
- **Services:** Group related methods (like `OTPService`, `ReportService`).
- **Jobs:** Heavy lifting that can be queued.

### Models: Keep Them Focused

Models are database blueprints. Keep them "fat" enough to handle relationships, accessors, and local scopes, but do not dump business logic into them.

### Validation in Form Requests

Never put `$request->validate()` inside controller logic. Move validation to dedicated Request classes and always use `$request->validated()` when saving to the database to prevent mass assignment vulnerabilities.

### Use Enums, Traits, and Value Objects

- **Enums:** Avoid "magic strings". Use native PHP 8.1 Enums for fixed sets of values (like `AccountStatus`, `AppointmentStatus`).
- **Traits:** Share reusable logic across unrelated classes.
- **Value Objects:** Encapsulate simple values that have logic (like specific format conversions).

---

## Database and Eloquent Performance

### Prevent Lazy Loading (The N+1 Problem)

N+1 queries are the biggest performance killer. Eager load relationships using `with()`. Ensure lazy loading is globally prevented in non-production environments to catch these issues early:

```php
// In AppServiceProvider boot()
Model::preventLazyLoading(! app()->isProduction());
```

### `with()` vs. `withCount()`

- Use `with('relation')` when you need to display the related model's data.
- Use `withCount('relation')` when you only need the total number. Never use `$model->relation->count()` in a loop, as it loads every record into memory.

### Database-Level Filtering

Filter data in the database, not in a PHP collection. Use Eloquent's `when()` method to cleanly conditionally apply queries without messy `if/else` blocks.

```php
// Good: Let the DB handle it conditionally
$query->when($request->type, function($q) use ($request) {
    $q->where('type', $request->type);
});
```

### Database Transactions

When performing multiple related `save()` or `update()` operations, wrap them in `DB::transaction()`. For critical monetary or state-changing operations, use `$query->lockForUpdate()` to prevent race conditions.

---

## Frontend: Livewire, Alpine, and Blade

### Atomic Design

Stop building "pages" and start building "components". Structure your Blade components following Atomic Design:

- **Atoms:** Smallest elements (Buttons, Inputs, Badges).
- **Molecules:** Small groups (Search Forms, Authentication Inputs).
- **Organisms:** Complex sections (Navbars, Cards, Data Tables).
- **Templates/Pages:** Where the actual content is poured in.

### Livewire Performance Optimizations

- **`wire:navigate`**: Use this for links to make the app feel like a fast SPA by fetching pages in the background.
- **`lazy`**: Load the initial shell of a page and let heavy components load a second later (`<livewire:heavy-chart lazy />`).
- **`wire:model.blur`**: Use `.blur` instead of `.live` to prevent sending a server request on every single keystroke.
- **`#[Computed]`**: Use this attribute on Livewire methods to cache heavy queries so they only run once per request cycle.
- **Form Objects**: Group large amounts of form data into dedicated Livewire Form Objects instead of bloating the main component state.

### Alpine.js for Client-Side State

Do not use Livewire for simple interactivity that doesn't need the database. Use Alpine.js (`x-data`, `x-show`) for modals, dropdowns, and tabs to eliminate server round-trips.

---

## Security and Routing

### Resource Controllers and Route Model Binding

- Use `Route::resource()` to automatically map standard RESTful verbs (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`).
- Rely on **Route Model Binding** (`public function show(User $user)`) to eliminate manual `findOrFail()` calls.

### Clean Route Groups

Do not define middleware inside controller constructors. Define all middleware explicitly in `web.php` using route groups (`Route::middleware(['auth', 'role:admin'])->group(...)`) to maintain a single source of truth for access control.

### Security Tooling and Audits

- Regularly run `composer audit` to scan for known vulnerabilities in dependencies.
- Never hardcode secrets; use the `.env` file and retrieve them via `config()`.
- Rely on Blade's `{{ $variable }}` syntax to automatically prevent XSS attacks. Avoid `{!! !!}` unless strictly necessary for pre-sanitized HTML.

---

## Code Formatting

Ensure all Blade/HTML code is expanded vertically for readability:

1. **Tag Placement:** Place each opening and closing tag on its own line to show clear hierarchy.
2. **Flat Tags:** Keep all attributes and classes for a single tag on the same line (like `<x-button class="btn btn-primary" type="submit">`).
3. **Nesting:** Use consistent indentation to separate parent and child elements.
4. **Logic Blocks:** Visually separate `@if`, `@foreach`, and `@auth` blocks from the markup they wrap.

```blade
@if ($isActive)
    <div class="user-card active">
        <x-user-avatar :user="$user" />
        
        <span class="text-lg">
            {{ $user->name }}
        </span>
    </div>
@endif
```
