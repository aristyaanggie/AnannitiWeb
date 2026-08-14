# Sprint 39 — Landing Page Tattoo Supply CMS

**Date**: 2026-07-24
**Status**: ✅ COMPLETE

## Objective

Memindahkan section "Professional Equipment" (Tattoo Supply) pada Landing Page dari hardcoded data ke CMS yang dapat dikelola melalui Admin.

## Implementation

### Database
- **New Table**: `tattoo_supplies` — title, subtitle, image, link, display_order, is_visible
- **Migration**: `2026_07_25_000001_create_tattoo_supplies_table.php`

### Model
- `TattooSupply` — Simple Eloquent model

### Controller
- `AdminTattooSupplyController` — Full CRUD (index, create, store, edit, update, destroy)
- Image storage: `tattoo-supplies/` di public disk

### Form Requests
- `StoreTattooSupplyRequest` — title required, image required, subtitle/link nullable
- `UpdateTattooSupplyRequest` — title required, image nullable (keep existing)

### Admin Views
- `admin/tattoo-supplies/index.blade.php` — Table (desktop) + Cards (mobile)
- `admin/tattoo-supplies/form.blade.php` — Create/Edit form dengan image preview

### Routes (6 new)
```
GET    /admin/tattoo-supplies          → index
GET    /admin/tattoo-supplies/create   → create
POST   /admin/tattoo-supplies          → store
GET    /admin/tattoo-supplies/{id}/edit → edit
PUT    /admin/tattoo-supplies/{id}     → update
DELETE /admin/tattoo-supplies/{id}     → destroy
```

### Seeder
- `TattooSupplySeeder` — 6 items (sama dengan hardcoded data sebelumnya)

### Landing Page Update
- `HomeController` — Load TattooSupply dari database
- `home.blade.php` — Shop section sekarang loop dari `$tattooSupplies`
- Layout IDENTIK — hanya source data berubah

### Sidebar
- Admin sidebar ditambah link "Tattoo Supply" di bawah Brand Assets

## Data Migration
6 item dari hardcoded data dipindahkan ke database:
1. Tattoo Machine (order: 1)
2. Tattoo Ink (order: 2)
3. Tattoo Needle (order: 3)
4. Kit Set (order: 4)
5. Furniture (order: 5)
6. View All (order: 6)

## Files Created
- `database/migrations/2026_07_25_000001_create_tattoo_supplies_table.php`
- `app/Models/TattooSupply.php`
- `app/Http/Controllers/Admin/AdminTattooSupplyController.php`
- `app/Http/Requests/StoreTattooSupplyRequest.php`
- `app/Http/Requests/UpdateTattooSupplyRequest.php`
- `resources/views/admin/tattoo-supplies/index.blade.php`
- `resources/views/admin/tattoo-supplies/form.blade.php`
- `database/seeders/TattooSupplySeeder.php`

## Files Modified
- `app/Http/Controllers/HomeController.php` — Added TattooSupply query
- `resources/views/pages/home.blade.php` — Dynamic shop section
- `resources/views/layouts/admin.blade.php` — Sidebar link
- `routes/web.php` — 6 new routes + import
- `database/seeders/DatabaseSeeder.php` — Added TattooSupplySeeder

## Build Result
```
✅ Migration ran successfully
✅ Seeder populated 6 items
✅ php artisan optimize:clear — DONE
✅ php artisan optimize — DONE
✅ npm run build — 0 errors, 2.58s
CSS: 112.01 kB (gzip 19.25 kB)
JS: 92.32 kB (gzip 33.89 kB)
```

## Breaking Changes
NONE — Semua perubahan additive.
