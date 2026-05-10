# Laravel Best Practices

This guide outlines the core architectural principles, performance optimization strategies, and coding standards adopted for this project. These practices ensure the codebase remains maintainable, secure, and efficient, aligning with the TALL stack (Tailwind, Alpine.js, Laravel, Livewire) architecture, while integrating heavily adopted community-driven Laravel best practices.

## Contents

- [Architecture and Code Organization](#architecture-and-code-organization)
- [Database and Eloquent Performance](#database-and-eloquent-performance)
- [Frontend: Livewire, Alpine, and Blade](#frontend-livewire-alpine-and-blade)
- [Security and Routing](#security-and-routing)
- [Code Formatting](#code-formatting)
- [Naming Conventions](#naming-conventions)
- [Syntax and Readability](#syntax-and-readability)

---

## Architecture and Code Organization

### Single Responsibility and Flat Code

A class should have only one responsibility. Keep your logic simple and flat by using **Early Returns** (Guard Clauses) instead of deeply nested `if/else` statements.
Handle errors and invalid states at the top of the function.

Bad:

```php
public function update(Request $request): string
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'events' => 'required|array:date,type'
    ]);

    foreach ($request->events as $event) {
        $date = $this->carbon->parse($event['date'])->toString();
        $this->logger->log('Update event ' . $date);
    }

    $this->event->updateGeneralEvent($request->validated());

    return back();
}
```

Good:

```php
public function update(UpdateRequest $request): string
{
    $this->logService->logEvents($request->events);
    $this->event->updateGeneralEvent($request->validated());

    return back();
}
```

### Methods should do just one thing

A function should do just one thing and do it well.

Bad:

```php
public function getFullNameAttribute(): string
{
    if (auth()->user() && auth()->user()->hasRole('client') && auth()->user()->isVerified()) {
        return 'Mr. ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    } else {
        return $this->first_name[0] . '. ' . $this->last_name;
    }
}
```

Good:

```php
public function getFullNameAttribute(): string
{
    return $this->isVerifiedClient() ? $this->getFullNameLong() : $this->getFullNameShort();
}

public function isVerifiedClient(): bool
{
    return auth()->user() && auth()->user()->hasRole('client') && auth()->user()->isVerified();
}

public function getFullNameLong(): string
{
    return 'Mr. ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
}

public function getFullNameShort(): string
{
    return $this->first_name[0] . '. ' . $this->last_name;
}
```

### Skinny Controllers with Dedicated Actions, Services, and Jobs

Controllers should only receive a request and return a response. Move all business logic out of controllers.

- **Actions:** Use for a single, specific task (like `CreateUserAction`, `CancelAppointment`).
- **Services:** Group related methods (like `OTPService`, `ReportService`).
- **Jobs:** Heavy lifting that can be queued.

Bad:

```php
public function store(Request $request)
{
    if ($request->hasFile('image')) {
        $request->file('image')->move(public_path('images') . 'temp');
    }
}
```

Good:

```php
public function store(Request $request)
{
    $this->articleService->handleUploadedImage($request->file('image'));
}
```

### Models: Keep Them Focused (Fat Models, Skinny Controllers)

Put all DB related logic into Eloquent models. Keep them "fat" enough to handle relationships, accessors, and local scopes. Do not dump general business logic into them.

Bad:

```php
public function index()
{
    $clients = Client::verified()->with(['orders' => function ($q) {
        $q->where('created_at', '>', Carbon::today()->subWeek());
    }])->get();

    return view('index', ['clients' => $clients]);
}
```

Good:

```php
public function index()
{
    return view('index', ['clients' => $this->client->getWithNewOrders()]);
}

class Client extends Model
{
    public function getWithNewOrders(): Collection
    {
        return $this->verified()->with(['orders' => function ($q) {
            $q->where('created_at', '>', Carbon::today()->subWeek());
        }])->get();
    }
}
```

### Validation in Form Requests

Never put `$request->validate()` inside controller logic. Move validation to dedicated Request classes and always use `$request->validated()` when saving to the database to prevent mass assignment vulnerabilities.

Bad:

```php
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);
}
```

Good:

```php
public function store(PostRequest $request)
{
    
}

class PostRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
    }
}
```

### Don't repeat yourself (DRY)

Reuse code when you can. SRP is helping you to avoid duplication. Also, reuse Blade templates, use Eloquent scopes etc.

Bad:

```php
public function getActive()
{
    return $this->where('verified', 1)->whereNotNull('deleted_at')->get();
}

public function getArticles()
{
    return $this->whereHas('user', function ($q) {
        $q->where('verified', 1)->whereNotNull('deleted_at');
    })->get();
}
```

Good:

```php
public function scopeActive($q)
{
    return $q->where('verified', true)->whereNotNull('deleted_at');
}

public function getActive(): Collection
{
    return $this->active()->get();
}

public function getArticles(): Collection
{
    return $this->whereHas('user', function ($q) {
        $q->active();
    })->get();
}
```

### Use Enums, Traits, and Value Objects

- **Enums:** Avoid "magic strings". Use native PHP 8.1 Enums for fixed sets of values (like `AccountStatus`, `AppointmentStatus`).
- **Traits:** Share reusable logic across unrelated classes.
- **Value Objects:** Encapsulate simple values that have logic (like specific format conversions).

### Use IoC / Service container instead of new Class

`new Class` syntax creates tight coupling between classes and complicates testing. Use IoC container or facades instead.

Bad:

```php
$user = new User;
$user->create($request->validated());
```

Good:

```php
public function __construct(protected User $user) {}

// ...

$this->user->create($request->validated());
```

---

## Database and Eloquent Performance

### Prefer to use Eloquent over using Query Builder and raw SQL queries

Eloquent allows you to write readable and maintainable code. Eloquent also has great built-in tools like soft deletes, events, scopes etc. Prefer collections over arrays.

Bad:

```sql
SELECT *
FROM `articles`
WHERE EXISTS (SELECT * FROM `users` WHERE `articles`.`user_id` = `users`.`id` AND `users`.`deleted_at` IS NULL)
AND `verified` = '1'
AND `active` = '1'
ORDER BY `created_at` DESC
```

Good:

```php
Article::has('user')->verified()->latest()->get();
```

### Prevent Lazy Loading (The N+1 Problem)

Do not execute queries in Blade templates. N+1 queries are the biggest performance killer. Eager load relationships using `with()`. Ensure lazy loading is globally prevented in non-production environments to catch these issues early:

```php
// In AppServiceProvider boot()
Model::preventLazyLoading(! app()->isProduction());
```

Bad (for 100 users, 101 DB queries will be executed):

```blade
@foreach (User::all() as $user)
    {{ $user->profile->name }}
@endforeach
```

Good (for 100 users, 2 DB queries will be executed):

```php
$users = User::with('profile')->get();

@foreach ($users as $user)
    {{ $user->profile->name }}
@endforeach
```

### Mass assignment

Bad:

```php
$article = new Article;
$article->title = $request->title;
$article->content = $request->content;
$article->save();
```

Good:

```php
Article::create($request->validated());
```

### Chunk data for data-heavy tasks

Bad:

```php
$users = $this->get();

foreach ($users as $user) {
    // ...
}
```

Good:

```php
$this->chunk(500, function ($users) {
    foreach ($users as $user) {
        // ...
    }
});
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

### Do not put JS and CSS in Blade templates and do not put any HTML in PHP classes

Bad:

```javascript
let article = `{{ json_encode($article) }}`;
```

Better:

```php
<input id="article" type="hidden" value='@json($article)'>

<!-- Or -->

<button class="js-fav-article" data-article='@json($article)'>{{ $article->name }}<button>
```

In a Javascript file:

```javascript
let article = $('#article').val();
```

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

Never put any logic in routes files. Do not define middleware inside controller constructors. Define all middleware explicitly in `web.php` using route groups (`Route::middleware(['auth', 'role:admin'])->group(...)`) to maintain a single source of truth for access control.

### Security Tooling and Audits

- Regularly run `composer audit` to scan for known vulnerabilities in dependencies.
- Never hardcode secrets; use the `.env` file and retrieve them via `config()`.
- Rely on Blade's `{{ $variable }}` syntax to automatically prevent XSS attacks. Avoid `{!! !!}` unless strictly necessary for pre-sanitized HTML.

### Do not get data from the `.env` file directly

Pass the data to config files instead and then use the `config()` helper function to use the data in an application.

Bad:

```php
$apiKey = env('API_KEY');
```

Good:

```php
// config/api.php
'key' => env('API_KEY'),

// Use the data
$apiKey = config('api.key');
```

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

---

## Naming Conventions

Follow [PSR standards](https://www.php-fig.org/psr/psr-12/). Also, follow naming conventions accepted by the Laravel community:

| What                             | How                                        | Good                                    | Bad                                                             |
| -------------------------------- | ------------------------------------------ | --------------------------------------- | --------------------------------------------------------------- |
| Controller                       | singular                                   | ArticleController                       | ~~ArticlesController~~                                          |
| Route                            | plural                                     | articles/1                              | ~~article/1~~                                                   |
| Route name                       | snake_case with dot notation               | users.show_active                       | ~~users.show-active, show-active-users~~                        |
| Model                            | singular                                   | User                                    | ~~Users~~                                                       |
| hasOne or belongsTo relationship | singular                                   | articleComment                          | ~~articleComments, article_comment~~                            |
| All other relationships          | plural                                     | articleComments                         | ~~articleComment, article_comments~~                            |
| Table                            | plural                                     | article_comments                        | ~~article_comment, articleComments~~                            |
| Pivot table                      | singular model names in alphabetical order | article_user                            | ~~user_article, articles_users~~                                |
| Table column                     | snake_case without model name              | meta_title                              | ~~MetaTitle; article_meta_title~~                               |
| Model property                   | snake_case                                 | $model->created_at                      | ~~$model->createdAt~~                                           |
| Foreign key                      | singular model name with _id suffix        | article_id                              | ~~ArticleId, id_article, articles_id~~                          |
| Primary key                      | -                                          | id                                      | ~~custom_id~~                                                   |
| Migration                        | -                                          | 2017_01_01_000000_create_articles_table | ~~2017_01_01_000000_articles~~                                  |
| Method                           | camelCase                                  | getAll                                  | ~~get_all~~                                                     |
| Method in resource controller    | table                                      | store                                   | ~~saveArticle~~                                                 |
| Method in test class             | camelCase                                  | testGuestCannotSeeArticle               | ~~test_guest_cannot_see_article~~                               |
| Variable                         | camelCase                                  | $articlesWithAuthor                     | ~~$articles_with_author~~                                       |
| Collection                       | descriptive, plural                        | $activeUsers = User::active()->get()    | ~~$active, $data~~                                              |
| Object                           | descriptive, singular                      | $activeUser = User::active()->first()   | ~~$users, $obj~~                                                |
| Config and language files index  | snake_case                                 | articles_enabled                        | ~~ArticlesEnabled; articles-enabled~~                           |
| View                             | kebab-case                                 | show-filtered.blade.php                 | ~~showFiltered.blade.php, show_filtered.blade.php~~             |
| Config                           | snake_case                                 | google_calendar.php                     | ~~googleCalendar.php, google-calendar.php~~                     |
| Contract (interface)             | adjective or noun                          | AuthenticationInterface                 | ~~Authenticatable, IAuthentication~~                            |
| Trait                            | adjective                                  | Notifiable                              | ~~NotificationTrait~~                                           |
| Trait (PSR)                      | adjective                                  | NotifiableTrait                         | ~~Notification~~                                                |
| Enum                             | singular                                   | UserType                                | ~~UserTypes~~, ~~UserTypeEnum~~                                 |
| FormRequest                      | singular                                   | UpdateUserRequest                       | ~~UpdateUserFormRequest~~, ~~UserFormRequest~~, ~~UserRequest~~ |
| Seeder                           | singular                                   | UserSeeder                              | ~~UsersSeeder~~                                                 |

---

## Syntax and Readability

### Convention over configuration

As long as you follow certain conventions, you do not need to add additional configuration.

Bad:

```php
class Customer extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'Customer';
    protected $primaryKey = 'customer_id';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_customer', 'customer_id', 'role_id');
    }
}
```

Good:

```php
class Customer extends Model
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
```

### Use config and language files, constants instead of text in the code

Bad:

```php
public function isNormal(): bool
{
    return $article->type === 'normal';
}

return back()->with('message', 'Your article has been added!');
```

Good:

```php
public function isNormal()
{
    return $article->type === Article::TYPE_NORMAL;
}

return back()->with('message', __('app.article_added'));
```

### Store dates in the standard format. Use accessors and mutators to modify date format

It's recommended to pass Carbon objects between classes instead of date strings. Rendering should be done in the display layer (templates).

Bad:

```php
{{ Carbon::createFromFormat('Y-d-m H-i', $object->ordered_at)->toDateString() }}
```

Good:

```php
// Model
protected $casts = [
    'ordered_at' => 'datetime',
];

// Blade view
{{ $object->ordered_at->toDateString() }}
```

### Prefer descriptive method and variable names over comments

Bad:

```php
// Determine if there are any joins
if (count((array) $builder->getQuery()->joins) > 0)
```

Good:

```php
if ($this->hasJoins())
```

### Do not use DocBlocks

DocBlocks reduce readability. Use a descriptive method name and modern PHP features like return type hints instead.

Bad:

```php
/**
 * @return bool
 */
public function checkString($string)
```

Good:

```php
public function isValidAsciiString(string $string): bool
```

### Use shorter and more readable syntax where possible

| Common syntax                                                          | Shorter and more readable syntax                                       |
| ---------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| `Session::get('cart')`                                                 | `session('cart')`                                                      |
| `$request->session()->get('cart')`                                     | `session('cart')`                                                      |
| `Session::put('cart', $data)`                                          | `session(['cart' => $data])`                                           |
| `$request->input('name')`, `Request::get('name')`                      | `$request->name`, `request('name')`                                    |
| `return Redirect::back()`                                              | `return back()`                                                        |
| `is_null($object->relation) ? null : $object->relation->id`            | `optional($object->relation)->id` (in PHP 8: `$object->relation?->id`) |
| `return view('index')->with('title', $title)->with('client', $client)` | `return view('index', compact('title', 'client'))`                     |
| `$request->has('value') ? $request->value : 'default';`                | `$request->get('value', 'default')`                                    |
| `Carbon::now()`, `Carbon::today()`                                     | `now()`, `today()`                                                     |
| `App::make('Class')`                                                   | `app('Class')`                                                         |
| `->where('column', '=', 1)`                                            | `->where('column', 1)`                                                 |
| `->orderBy('created_at', 'desc')`                                      | `->latest()`                                                           |
| `->orderBy('age', 'desc')`                                             | `->latest('age')`                                                      |
| `->orderBy('created_at', 'asc')`                                       | `->oldest()`                                                           |
| `->select('id', 'name')->get()`                                        | `->get(['id', 'name'])`                                                |
| `->first()->name`                                                      | `->value('name')`                                                      |

### Use standard Laravel tools accepted by community

Prefer to use built-in Laravel functionality and community packages instead of using 3rd party packages and tools. Any developer who will work with your app in the future will need to learn new tools.

### Other good practices

- Avoid using patterns and tools that are alien to Laravel and similar frameworks.
- Minimize usage of vanilla PHP in Blade templates.
- Use in-memory DB for testing.
- Do not override standard framework features.
- Use modern PHP syntax where possible, but don't forget about readability.
- Avoid using View Composers and similar tools unless you really know what you're doing.
