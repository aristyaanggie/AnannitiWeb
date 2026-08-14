# Sprint 14.14 — Portfolio Management (Admin CMS)

**Date**: 2026-07-16
**Status**: ✅ COMPLETE

## Objective

Membangun CRUD lengkap untuk Portfolio sehingga owner dapat mengelola Gallery tanpa menyentuh kode.

## Files Created/Modified

| File | Action |
|------|--------|
| `app/Services/PortfolioService.php` | Created |
| `app/Http/Requests/StorePortfolioRequest.php` | Created |
| `app/Http/Requests/UpdatePortfolioRequest.php` | Created |
| `app/Http/Controllers/Admin/AdminPortfolioController.php` | Created |
| `resources/views/admin/portfolio/index.blade.php` | Created |
| `resources/views/admin/portfolio/form.blade.php` | Created |
| `resources/views/layouts/admin.blade.php` | Updated (sidebar) |
| `routes/web.php` | Updated (6 routes) |

## Routes

| Method | URI | Name |
|--------|-----|------|
| GET | `/admin/portfolio` | `admin.portfolio.index` |
| GET | `/admin/portfolio/create` | `admin.portfolio.create` |
| POST | `/admin/portfolio` | `admin.portfolio.store` |
| GET | `/admin/portfolio/{portfolio}/edit` | `admin.portfolio.edit` |
| PUT | `/admin/portfolio/{portfolio}` | `admin.portfolio.update` |
| DELETE | `/admin/portfolio/{portfolio}` | `admin.portfolio.destroy` |

## Features

### Index Page
- Summary cards: Total, Featured, Hidden, Newest
- Search box (UI only)
- Desktop table + mobile cards
- Delete confirmation

### Form
- Section 1: Title, Slug (auto), Artist, Category, Tattoo Style, Description
- Section 2: Image upload with preview
- Section 3: Featured (Yes/No), Published (Published/Draft)

### Image Handling
- Upload to `storage/app/public/portfolio/`
- Preview on upload
- Replace old image on update
- Delete file on portfolio delete
- Validation: jpg, jpeg, png, webp, max 5MB

### Validation
- Title: required, max 150
- Artist: required, exists
- Category: required, exists
- Image: nullable, image, mimes, max 5120

## Validation

```
✓ php artisan route:list — 29 routes registered
✓ php artisan optimize — Cached successfully
✓ Build successful (2.42s)
✓ CSS: 106.77 kB
✓ JS: 92.32 kB
✓ Errors: 0
✓ Warnings: 0
```
