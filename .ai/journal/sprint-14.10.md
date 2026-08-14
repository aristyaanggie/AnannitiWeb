# Sprint 14.10 — Product CRUD Backend (Store & Update)

**Date**: 2026-07-16
**Status**: ✅ COMPLETE

## Objective

Mengimplementasikan backend Create Product dan Update Product.

## Files Created/Modified

| File | Action |
|------|--------|
| `app/Http/Requests/StoreProductRequest.php` | Created |
| `app/Http/Requests/UpdateProductRequest.php` | Created |
| `app/Services/ProductService.php` | Updated (slug generation, store/update logic) |
| `app/Http/Controllers/Admin/AdminProductController.php` | Updated (store, update methods) |
| `resources/views/admin/products/form.blade.php` | Updated (validation errors, flash messages) |
| `resources/views/admin/products/index.blade.php` | Updated (flash message) |
| `routes/web.php` | Updated (store, update routes) |

## Routes

| Method | URI | Name |
|--------|-----|------|
| POST | `/admin/products` | `admin.products.store` |
| PUT | `/admin/products/{product}` | `admin.products.update` |

## Validation Rules

| Field | Rules |
|-------|-------|
| name | required, max:255 |
| slug | required, unique (ignore self on update) |
| category_id | required, exists:categories |
| badge_id | nullable, exists:product_badges |
| price | required, numeric, min:0 |
| stock_quantity | required, integer, min:0 |
| minimum_stock | required, integer, min:0 |
| description | required |
| is_visible | required, in:0,1 |
| meta_title | nullable, max:255 |
| meta_description | nullable, max:500 |

## Slug Generation

- Auto-generated from product name via `Str::slug()`
- Unique check with counter: `rotary-machine`, `rotary-machine-2`, `rotary-machine-3`
- Ignores self on update

## Flash Messages

- Create: "Product created successfully."
- Update: "Product updated successfully."

## Validation

```
✓ php artisan route:list — 16 routes registered
✓ php artisan optimize — Cached successfully
✓ Build successful (2.54s)
✓ CSS: 105.88 kB
✓ JS: 92.32 kB
✓ Errors: 0
✓ Warnings: 0
```
