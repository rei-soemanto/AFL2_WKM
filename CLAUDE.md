# CLAUDE.md — WKM Portal (afl2_wkm)

## Project Overview

**PT. Wraksa Kencana Mukti (WKM)** company portal built with Laravel 12. Visitors can browse
products, services, and project portfolio. Authenticated non-admin users can save items to an
interest list. A separate management panel (external URL) handles admin CRUD.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 (PHP 8.2+) |
| Auth | Laravel UI (Bootstrap scaffolding) |
| Frontend CSS | Bootstrap 5.3 + Tailwind CSS 4 (via Vite) |
| Icons | Bootstrap Icons 1.13 |
| Frontend JS | Vanilla JS, jQuery 3.7, Siema carousel, EmailJS |
| Build tool | Vite 7 + laravel-vite-plugin |
| Database | MySQL (production) / SQLite (local / testing) |
| Mail | Log driver (local) |
| HTTP client | Axios |

---

## Local Development

```bash
# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed roles
php artisan migrate --seed

# Start dev servers (both PHP and Vite)
npm run dev          # Vite hot-reload
php artisan serve    # OR use Laravel Herd
```

> Using **Laravel Herd** on Windows: the site is served at `http://afl2-wkm.test` automatically.

### Storage symlink (run once)

```bash
php artisan storage:link
```

---

## Directory Structure

```
app/
  Http/
    Controllers/
      PageController.php      # Public pages: products, services, projects, interests
      UserController.php      # Auth user profile CRUD
      HomeController.php      # Authenticated dashboard redirect
    Middleware/
      CheckAdminRole.php      # Blocks non-admin access to admin routes
  Models/
    User.php                  # HasMany interests; BelongsTo UserRole
    UserRole.php              # Roles: admin, user (role_id FK on users table)
    Product.php               # BelongsTo ProductBrand, ProductCategory, User(last_update_by)
    ProductBrand.php
    ProductCategory.php
    Service.php               # BelongsTo ServiceCategory, User(last_update_by)
    ServiceCategory.php
    Project.php               # BelongsToMany ProjectCategory; HasMany ProjectImage
    ProjectCategory.php
    ProjectImage.php          # upload_order column controls display order
database/
  migrations/                 # Chronological schema history
resources/
  views/
    layout/
      mainlayout.blade.php    # Root HTML shell; jQuery, Siema, EmailJS, global JS
      navigation.blade.php    # Top navbar with auth dropdown
      footer.blade.php
    login.blade.php           # Combined login + register tabs (extends mainlayout)
    about.blade.php           # Home / About page with contact form
    product.blade.php         # Product listing grouped by brand
    product_detail.blade.php  # Single product with interest button
    service.blade.php         # Service listing grouped by category
    service_detail.blade.php  # Single service with interest button
    project.blade.php         # Project portfolio grid
    project_detail.blade.php  # Single project with image carousel
    user_interest.blade.php   # Authenticated user's saved products/services
    users/manage.blade.php    # Profile view and edit form
    errors/                   # Custom 401, 402, 403, 404, 419, 429, 500, 503 pages
  scss/app.scss               # Compiled via Vite
  js/
    app.js                    # Entry point (imports bootstrap.js + navmenu.js)
    bootstrap.js              # Axios setup with CSRF header
    navmenu.js                # Mobile menu toggle + height animation
routes/
  web.php                     # All application routes
```

---

## Database Schema

### Key column naming convention

The `last_update_by` column (nullable FK → `users.id`) tracks who last modified a record.
It is present on `products`, `services`, and `projects` tables.

> Note: the column is `last_update_by` (no trailing 'd'). All three models reflect this in
> their `$fillable` arrays and `lastUpdatedBy()` relationship definitions.

### User Roles

Roles are seeded into `user_roles` and referenced by `users.role_id`:

| id | name |
|---|---|
| 1 | Admin |
| 2 | Manager |
| 3 | Employee |
| 4 | user (default for registrations) |

`users.role_id` defaults to `3` in the migration (adjust seeder if needed).

### Pivot tables

| Table | Joins |
|---|---|
| `interested_products` | `user_id` ↔ `product_id` |
| `interested_services` | `user_id` ↔ `service_id` |
| `project_category_assignments` | `project_id` ↔ `category_id` |

---

## Role Checking Pattern

**Do not** access `Auth::user()->role` — there is no such column. Always go through the
relationship:

```php
// Correct
Auth::user()->userRole?->name !== 'admin'

// Wrong (returns null always → breaks checks)
Auth::user()->role !== 'admin'
```

The same pattern applies in Blade views:

```blade
@if(Auth::user()->userRole?->name !== 'admin')
```

The `CheckAdminRole` middleware uses the same pattern.

---

## Admin vs Regular User Behaviour

| Action | Guest | Regular User | Admin/Staff |
|---|---|---|---|
| Browse products / services / projects | ✓ | ✓ | ✓ |
| View product / service detail | ✓ | ✓ | ✓ |
| Add item to interest list | — | ✓ | — (hidden) |
| View own interest list | — | ✓ | — |
| Edit own profile | — | ✓ | ✓ |
| Access management panel | — | — | Redirected to external URL |

Admin/Staff users are identified when `userRole->name` is in `['Admin', 'Manager', 'Employee']`
(see `navigation.blade.php`). The interest-list buttons are hidden for them because admins
manage products from the external panel, not from the public portal.

---

## Routes Reference

```
GET  /                              → about page (public)
POST /check-email                   → JSON: check email availability (public)

GET  /product                       → product listing
GET  /product/{id}                  → product detail
GET  /service                       → service listing
GET  /service/{id}                  → service detail
GET  /project                       → project listing
GET  /project/{id}                  → project detail

GET  /user_interest                 → user interest list      [auth]
POST /product/{id}/add-interest     → add product interest    [auth]
POST /service/{id}/add-interest     → add service interest    [auth]
DELETE /user_interest/product/{id}  → remove product interest [auth]
DELETE /user_interest/service/{id}  → remove service interest [auth]

GET    /users                       → profile view            [auth]
GET    /users/edit                  → profile edit form       [auth]
PATCH  /users                       → update profile          [auth]
DELETE /users                       → delete account          [auth]

GET  /home                          → dashboard               [auth]
GET  /storage-link                  → run storage:link artisan command
```

Auth routes (login, register, password reset) are registered via `Auth::routes()`.

---

## Frontend Notes

### EmailJS contact form

The about page contains a `#contactForm`. `mainlayout.blade.php` initialises EmailJS with
service ID `wkmukti` and template `template_6uyoxto`. These credentials must be configured
in your EmailJS dashboard.

### Show-More pagination (products)

Products render all items server-side with `d-none` on items beyond the first 10 per brand.
The "Show More" button reveals 10 more per click. No AJAX — purely CSS class toggling.

### Email availability check (registration)

`mainlayout.blade.php` attaches a `blur` handler to `#reg_email` (the register-tab email
field in `login.blade.php`) that calls `POST /check-email` and toggles Bootstrap
`is-valid`/`is-invalid` classes. The handler is guarded with a null check so it does not
throw on pages without `#reg_email`.

### Image carousel (project detail)

Uses the **Siema** library loaded from unpkg CDN. Project images are ordered by
`upload_order` before being passed to the view.

---

## Coding Style Guide

- **PHP**: follow PSR-12. No trailing commas after last array item in single-line arrays.
- **Blade**: use `{{ }}` for escaped output, `{!! !!}` only when the value has already been
  sanitised (e.g. `nl2br(e($text))`).
- **Role checks**: always use `->userRole?->name` — never `->role`.
- **Column naming**: FK audit-trail column is `last_update_by` (no 'd') across all tables.
- **JS in layout**: guard any `getElementById` calls that only exist on certain pages with a
  null check before calling methods on the element.
- **Fillable arrays**: every column written via mass-assignment must appear in `$fillable`.
- **Route names**: `resource.action` pattern — e.g. `product.detail`, `interest.product.store`.
- **Redirects after mutations**: always redirect after POST/PATCH/DELETE (PRG pattern).

---

## Common Commands

```bash
# Run all migrations fresh with seeders
php artisan migrate:fresh --seed

# Clear all caches
php artisan optimize:clear

# Generate storage symlink
php artisan storage:link

# Run tests
php artisan test
# or
./vendor/bin/pest

# Code style (Laravel Pint)
./vendor/bin/pint

# Build assets for production
npm run build
```
