# Sprint 14.6 — Admin Authentication Foundation

**Date**: 2026-07-16
**Status**: ✅ COMPLETE

## Objective

Membangun sistem autentikasi Admin sebagai fondasi seluruh Back Office.

## Files Created

| File | Description |
|------|-------------|
| `app/Http/Middleware/AdminMiddleware.php` | Admin role check middleware |
| `app/Http/Controllers/Admin/AdminAuthController.php` | Login/logout controller |
| `resources/views/layouts/admin.blade.php` | Admin layout |
| `resources/views/auth/login.blade.php` | Login page |
| `resources/views/admin/home.blade.php` | Admin home page |

## Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | /admin/login | admin.login | Login page |
| POST | /admin/login | admin.login.submit | Process login |
| POST | /admin/logout | admin.logout | Process logout |
| GET | /admin | admin.home | Admin home (protected) |

## Middleware

- `auth` — Laravel authentication
- `admin` — Custom role check (admin only)

## Features

- Session-based authentication
- CSRF protection
- Session regeneration on login
- Remember me functionality
- Role-based access control
- 403 for unauthorized users

## Admin Account

- Email: admin@anannititattoo.com
- Password: password
- Role: admin

## Validation

```
✓ php artisan migrate:fresh --seed — Success
✓ php artisan route:list — 11 routes registered
✓ Build successful (2.22s)
✓ CSS: 102.01 kB
✓ JS: 92.32 kB
✓ Errors: 0
✓ Warnings: 0
```
