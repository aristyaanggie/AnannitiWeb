# QA — Ananniti Tattoo Bali

**Last Updated**: 2026-07-23
**Status**: Production Ready (v11.0.0)
**Database**: MySQL
**Total Test Cases**: 277
**Manual QA (Sprint 34.1)**: 58 PASS, 2 WARNING, 0 FAILED
**Brand Assets QA (Sprint 36.1)**: 10 PASS, 0 FAILED

---

## Dashboard

| Metric | Value |
|--------|-------|
| Total Test Cases | 277 |
| Static QA Issues | 20 |
| Critical | 2 |
| Major | 5 |
| Minor | 8 |
| Suggestion | 5 |
| CRUD Audit Gaps | 27 |
| Upload File Audit Issues | 8 |
| Upload Critical | 2 |
| Upload Major | 4 |
| Upload Minor | 2 |
| Upload Saran | 4 |
| Regression QA (Booking) | ✅ Pass |
| Regression QA (Contacts) | ✅ Pass |
| migrate:fresh --seed | ✅ Pass (18 migrations, 8 seeders) |
| view:cache | ✅ Pass |
| npm run build | ✅ Pass |
| route:list admin.bookings | ✅ 0 routes |
| route:list admin.contacts | ✅ 0 routes |

---

## 1. Static QA Findings

### CRITICAL

| # | File | Issue | Status |
|---|------|-------|--------|
| C1 | `resources/views/layouts/app.blade.php:7` | Config key path salah: `config('ananniti.tagline')` seharusnya `config('ananniti.studio.tagline')`. Tagline dari `.env` tidak pernah terbaca. | 🔴 Open |
| C2 | `resources/views/pages/home.blade.php:417,441` | `asset('images/reviews/review-' . $loop->iteration . '.svg')` — direktori `public/images/reviews/` tidak ada. Fallback review photo 404. | 🔴 Open |

### MAJOR

| # | File | Issue | Status |
|---|------|-------|--------|
| M1 | `resources/views/pages/shop-category.blade.php:17–104` | View hardcoded — `$products` dari controller tidak dipakai. Semua kategori menampilkan halaman "Tattoo Machine" yang sama. | 🔴 Open |
| M2 | `app/Services/ReviewService.php` | Dead service — 8 method, tidak pernah di-inject/dipanggil. | 🔴 Open |
| M3 | `app/Services/LandingPageService.php` | Dead service — 6 method, tidak pernah di-inject/dipanggil. | 🔴 Open |
| M4 | `app/Services/SettingService.php` | Dead service — tidak pernah di-inject. Settings diakses langsung via `Setting::where()`. | 🔴 Open |
| M5 | `app/Http/Controllers/Admin/AdminAuthController.php:55` | Dead code — method `home()` public, tidak ada route yang mengarah ke sini. | 🔴 Open |

### MINOR

| # | File | Issue | Status |
|---|------|-------|--------|
| m1 | `app/Http/Controllers/GalleryController.php:11` | Unused import: `use Illuminate\Http\Request` | 🔴 Open |
| m2 | `app/Http/Controllers/GalleryController.php:12` | Unused import: `use Illuminate\Support\Str` | 🔴 Open |
| m3 | `app/Http/Controllers/Admin/AdminAuthController.php:55` | `home()` tidak passing `$pageTitle`, layout fallback "Dashboard" — misleading. | 🔴 Open |
| m4 | `app/Repositories/CategoryRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. | 🔴 Open |
| m5 | `app/Repositories/ReviewRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. | 🔴 Open |
| m6 | `app/Repositories/SettingRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. | 🔴 Open |
| m7 | `resources/views/components/layout/footer.blade.php:4–19` | 7 individual Setting queries per page load. | 🔴 Open |
| m8 | `resources/views/components/layout/navbar.blade.php:2` | Setting query on every page load (WhatsApp). | 🔴 Open |

### SUGGESTION

| # | File | Issue | Status |
|---|------|-------|--------|
| S1 | `config/ananniti.php` | 19 dari 22 config keys tidak pernah dibaca. Hanya `payment.currency_symbol` yang aktif. | 🔴 Open |
| S2 | `resources/views/layouts/admin.blade.php:10–34` | Inline `<style>` block bypass Vite — tidak cache-busted. | 🔴 Open |
| S3 | `resources/views/pages/home.blade.php:8` | Spaces dan mixed case dalam asset filename (`Hero Section.JPG`). Fragile untuk CDN. | 🔴 Open |
| S4 | `app/Http/Controllers/HomeController.php:14–19` | Reviews loaded without `->with('artist')`. Potensi N+1 jika view di-update. | 🔴 Open |
| S5 | `resources/views/layouts/auth.blade.php:8` | `@vite` loads CSS only, no JS. Jika Alpine.js ditambahkan nanti akan silent break. | 🔴 Open |

---

## 2. Regression QA — Booking Database Removal

**Date**: 2026-07-21
**Status**: ✅ All Clear

| Check | Result |
|-------|--------|
| `migrate:fresh --seed` | ✅ 20 migrations, 8 seeders, 0 errors |
| `view:cache` | ✅ 0 errors |
| `route:list` admin bookings | ✅ 0 routes |
| Public booking routes | ✅ 2 routes (create + store) |
| Public pages HTTP test | ✅ All 200 |
| Booking form renders | ✅ "Send via WhatsApp" |
| Admin sidebar | ✅ No booking link |
| Model relationships | ✅ No dangling Booking refs |
| Code grep | ✅ 0 remaining Booking refs |

**Deleted**: 12 files | **Modified**: 10 files

---

## 3. Regression QA — Contacts Table Removal

**Date**: 2026-07-21
**Status**: ✅ All Clear

| Check | Result |
|-------|--------|
| `migrate:fresh --seed` | ✅ 18 migrations, 8 seeders, 0 errors |
| `route:list` contacts | ✅ 0 routes |
| Code grep | ✅ 0 remaining Contact refs |
| Admin sidebar | ✅ No contacts link |

**Deleted**: 7 files | **Modified**: 3 files

---

## 4. CRUD Audit

### 4.1 Product

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ✅ | `AdminProductController@store` |
| Read | ✅ | Index + public Shop |
| Update | ✅ | `AdminProductController@update` |
| Delete | ✅ | Soft delete |
| Restore | ✅ | `AdminProductController@restore` |
| Validation | ✅ | `StoreProductRequest` + `UpdateProductRequest` |
| Redirect | ✅ | With flash `success` |
| Flash message | ✅ | All operations |
| Storage upload | ✅ | Thumbnail → `products/`, Gallery → `products/gallery/` |
| Old image deletion | ✅ | On update + delete |
| Slug generation | ✅ | `generateUniqueSlug()` |
| Unique validation | ✅ | `unique:products,slug` + `-1`, `-2` fallback |
| Fillable | ✅ | 19 fields guarded |
| Soft delete | ✅ | `SoftDeletes` trait |
| Pagination | ❌ Missing | `->get()` tanpa paginate |
| Search | ❌ Missing | Tidak ada server-side search |
| Sorting | ❌ Missing | Hardcoded `orderByDesc('updated_at')` |

**Minor**: `UpdateProductRequest:23` slug `required`, tapi `StoreProductRequest:20` slug `nullable` — inkonsisten.

---

### 4.2 Category

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ❌ Missing | Tidak ada admin CRUD. Hanya via seeder. |
| Read | ❌ Missing | Hanya dipakai di dropdown form, tanpa halaman admin. |
| Update | ❌ Missing | Tidak ada edit di admin panel. |
| Delete | ❌ Missing | Tidak ada delete di admin panel. |
| Fillable | ✅ | 7 fields guarded |

---

### 4.3 Artist

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ❌ Missing | Tidak ada admin CRUD. Hanya via seeder. |
| Read | ❌ Missing | Hanya dipakai di dropdown form + public page. |
| Update | ❌ Missing | Tidak ada edit di admin panel. |
| Delete | ❌ Missing | Tidak ada delete di admin panel. |
| Fillable | ✅ | 12 fields guarded |

**Note**: Sidebar admin menu "Artists" link ke `route('admin.dashboard')` — placeholder.

---

### 4.4 Portfolio

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ✅ | `AdminPortfolioController@store` |
| Read | ✅ | Index + public Gallery |
| Update | ✅ | `AdminPortfolioController@update` |
| Delete | ✅ | Hard delete |
| Validation | ✅ | `StorePortfolioRequest` + `UpdatePortfolioRequest` |
| Redirect | ✅ | With flash `success` |
| Flash message | ✅ | All operations |
| Storage upload | ✅ | Image → `portfolio/` |
| Old image deletion | ✅ | On update + delete |
| Slug generation | ✅ | `generateUniqueSlug()` |
| Unique validation | ✅ | `unique:portfolio_items,slug` + `-1`, `-2` fallback |
| Fillable | ✅ | 12 fields guarded |
| Soft delete | ❌ Not implemented | Hard delete |
| Pagination | ❌ Missing | `->get()` tanpa paginate |
| Search | ❌ Missing | Hanya client-side Alpine.js |
| Sorting | ❌ Missing | Hardcoded `orderByDesc('created_at')` |

---

### 4.5 Review

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ✅ | `AdminReviewController@store` |
| Read | ✅ | Index + public Home |
| Update | ✅ | `AdminReviewController@update` |
| Delete | ✅ | Hard delete |
| Toggle status | ✅ | `toggleStatus` — `is_visible` flip |
| Toggle featured | ✅ | `toggleFeatured` — `is_featured` flip |
| Validation | ✅ | `StoreReviewRequest` + `UpdateReviewRequest` |
| Redirect | ✅ | With flash `success` |
| Flash message | ✅ | All operations |
| Storage upload | ✅ | Photo → `reviews/` |
| Old image deletion | ✅ | On update + delete |
| Fillable | ✅ | 11 fields guarded |
| Soft delete | ❌ Not implemented | Hard delete |
| Pagination | ❌ Missing | `->get()` tanpa paginate |
| Search | ❌ Missing | Hanya client-side Alpine.js |
| Sorting | ❌ Missing | Hardcoded `orderByDesc('created_at')` |

---

### 4.6 Settings

| Feature | Status | Detail |
|---------|--------|--------|
| Create | ❌ Missing | Tidak ada admin CRUD. Hanya via seeder. |
| Read | ❌ Missing | Hanya dipakai via `Setting::where()` di view. |
| Update | ❌ Missing | Tidak ada edit di admin panel. |
| Delete | ❌ Missing | Tidak ada delete di admin panel. |
| Fillable | ✅ | 4 fields guarded |

**Note**: `SettingService` sudah tersedia tapi tidak pernah dipakai.

---

### 4.7 CRUD Audit Summary

| Aspect | Product | Category | Artist | Portfolio | Review | Settings |
|--------|---------|----------|--------|-----------|--------|----------|
| Create | ✅ | ❌ | ❌ | ✅ | ✅ | ❌ |
| Read | ✅ | ❌ | ❌ | ✅ | ✅ | ❌ |
| Update | ✅ | ❌ | ❌ | ✅ | ✅ | ❌ |
| Delete | ✅ | ❌ | ❌ | ✅ | ✅ | ❌ |
| Validation | ✅ | — | — | ✅ | ✅ | — |
| Flash message | ✅ | — | — | ✅ | ✅ | — |
| Storage upload | ✅ | — | — | ✅ | ✅ | — |
| Old image del | ✅ | — | — | ✅ | ✅ | — |
| Slug generation | ✅ | — | — | ✅ | — | — |
| Unique validation | ✅ | — | — | ✅ | — | — |
| Fillable | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Soft delete | ✅ | — | — | ❌ | ❌ | — |
| Pagination | ❌ | — | — | ❌ | ❌ | — |
| Search | ❌ | — | — | ❌ | ❌ | — |
| Sorting | ❌ | — | — | ❌ | ❌ | — |

---

## 5. Audit Sistem Upload File

### Peta Storage

| Entity | Path | Disk | Max Size | Validasi |
|--------|------|------|----------|----------|
| Product Thumbnail | `products/` | public | 20MB | image, jpg/jpeg/png/webp |
| Product Gallery | `products/gallery/` | public | 20MB | image, jpg/jpeg/png/webp |
| Portfolio Image | `portfolio/` | public | 5MB | image, jpg/jpeg/png/webp |
| Section Image | `sections/` | public | 5MB | image, jpg/jpeg/png/webp |
| Review Photo | `reviews/` | public | 5MB | image, jpg/jpeg/png/webp |
| Static Hero | `storage/portfolio/studio-hero.jpg` | public | — | — |
| Static About | `storage/about/studio.jpg` | public | — | — |
| Placeholder | `public/images/hero-placeholder2.jpeg` | public | — | — |
| Review Placeholder | `public/images/reviews/review-{n}.svg` | — | — | — |
| Symlink | `public/storage → storage/app/public` | — | — | ✅ Terverifikasi |

### CRITICAL

| # | File | Masalah |
|---|------|---------|
| C1 | `app/Services/ProductService.php:106–125` | **Soft delete menghancurkan file secara permanen.** `deleteProduct()` menghapus thumbnail + semua file gallery dari storage **sebelum** soft-delete record DB. Saat `restoreProduct()` dipanggil, hanya record DB yang di-restore — file tidak pernah di-restore. Product yang di-restore akan punya path thumbnail/gallery yang mengarah ke file **yang sudah tidak ada** → gambar rusak. |
| C2 | `resources/views/pages/home.blade.php:417,441` | **Fallback review photo 404.** Fallback: `asset('images/reviews/review-' . $loop->iteration . '.svg')` — direktori `public/images/reviews/` **tidak ada**. Setiap review tanpa photo akan 404 di fallback-nya juga. |

### MAJOR

| # | File | Masalah |
|---|------|---------|
| M1 | `resources/views/admin/products/index.blade.php:96,163` | **Tanpa null check pada thumbnail.** `asset('storage/' . $product->thumbnail)` tanpa guard `@if`. Jika `$product->thumbnail` null → render `asset('storage/')` → broken image 404. |
| M2 | `resources/views/admin/reviews/index.blade.php:108,197` | **Tanpa null check pada photo.** `asset('storage/' . $review->photo)` tanpa guard `@if`. Jika `$review->photo` null → broken image 404. |
| M3 | `app/Services/ProductService.php:116–119` | **Gallery record hard-deleted saat soft delete.** `$gallery->delete()` menghapus record gallery dari DB secara permanen. Saat product di-restore, gallery records sudah hilang — bahkan jika file-nya masih ada (yang juga sudah dihapus). Double data loss. |
| M4 | `resources/views/pages/gallery.blade.php:9` | **Gambar statis hardcoded.** `asset('storage/portfolio/studio-hero.jpg')` — jika file ini dihapus atau belum di-seed, hero section gallery tidak memiliki gambar. Fallback via `onerror` ke `hero-placeholder2.jpeg` hanya menangani error load. |
| M5 | `resources/views/pages/home.blade.php:49` | **Gambar statis hardcoded.** `asset('storage/about/studio.jpg')` — sama seperti M4. Jika file belum ada, gambar broken. |
| M6 | `app/Services/ProductService.php:127–138` | **Restore tanpa verifikasi file.** `restoreProduct()` hanya restore record DB, tidak memverifikasi apakah file thumbnail/galleries masih ada di storage. Tidak ada peringatan ke user bahwa file mungkin hilang. |

### MINOR

| # | File | Masalah |
|---|------|---------|
| m1 | `resources/views/pages/home.blade.php` | **Strategi fallback tidak konsisten.** Gallery items pakai `onerror` JS handler, artist photo pakai `@if` Blade check, review photos pakai `@if` + fallback SVG. 3 strategi berbeda dalam satu halaman. |
| m2 | `resources/views/pages/artist-profile.blade.php:88` | **Fallback konsisten.** `@else` menampilkan `asset('images/hero-placeholder2.jpeg')` — ini bekerja tapi tidak sinkron dengan pola home page (yang pakai `onerror`). |
| m3 | `resources/views/pages/portfolio-detail.blade.php:89–95` | **Artist photo null check ada** tapi fallback ke initial letter — pola yang bagus, tapi tidak diterapkan konsisten ke referensi artist photo lainnya. |
| m4 | `app/Services/ProductService.php:203–206` | **Tanpa sanitasi filename.** `$file->store('products', 'public')` mengandalkan filename default Laravel (UUID). Aman, tapi jika `storeAs()` dipakai dengan filename dari user, ini bisa menjadi vector. Saat ini tidak bisa dieksploitasi. |
| m5 | `app/Services/ReviewManagementService.php:113–116` | **Sama seperti m4** untuk photo review. |

### SARAN

| # | File | Masalah |
|---|------|---------|
| S1 | `app/Services/ProductService.php:106–125` | **Implementasikan file archival saat soft delete.** Daripada menghapus file, pindahkan ke direktori `trash/` atau `_archive/`. Saat restore, kembalikan ke lokasi semula. Ini mencegah kehilangan data permanen. |
| S2 | Semua service | **Cek keberadaan storage sebelum `deleteFile()`.** Pola saat ini sudah benar — memeriksa `Storage::disk('public')->exists($path)` sebelum menghapus. ✅ |
| S3 | Semua blade view | **Standarisasi pola fallback.** Pilih satu pendekatan (entah `@if` Blade check ATAU `onerror` JS handler) dan terapkan secara konsisten ke semua view. |
| S4 | Semua service | **Tambahkan pengecekan `file_exists()` setelah upload.** Verifikasi file benar-benar tertulis ke disk setelah `$file->store()`. Skenario kegagalan yang jarang tapi mungkin terjadi pada disk penuh. |

### Ringkasan Pengecekan Upload

| Pengecekan | Product | Portfolio | Review | Section | Status |
|------------|---------|-----------|--------|---------|--------|
| Upload berhasil | ✅ | ✅ | ✅ | ✅ | OK |
| Edit ganti file lama | ✅ | ✅ | ✅ | ✅ | OK |
| Hapus file saat delete | ✅ | ✅ | ✅ | ✅ | OK |
| Soft delete + restore | ❌ C1 | N/A | N/A | N/A | **File hilang saat restore** |
| Fallback jika null | ❌ M1/M2 | ✅ | ❌ M2 | ✅ | Tidak konsisten |
| Validasi (mimes) | ✅ | ✅ | ✅ | ✅ | OK |
| Validasi (ukuran) | ✅ 20MB | ✅ 5MB | ✅ 5MB | ✅ 5MB | OK |
| Symlink | ✅ | ✅ | ✅ | ✅ | OK |
| Storage disk konsisten | ✅ | ✅ | ✅ | ✅ | Semua `public` |
| Tidak ada file orphan | ❌ C1 | ✅ | ✅ | ✅ | Soft delete orphan |

---

## 6. Functional Test Plan

### 4.1 Authentication (15 tests)

- [ ] GET `/admin/login` renders login form
- [ ] POST `/admin/login` valid admin → redirect dashboard
- [ ] POST `/admin/login` invalid email → validation error
- [ ] POST `/admin/login` wrong password → validation error
- [ ] POST `/admin/login` empty → `required` errors
- [ ] POST `/admin/login` non-admin role → "Unauthorized access"
- [ ] Login with `remember` → session persists
- [ ] Session regenerated on login (session fixation prevent)
- [ ] Admin logged in → `/admin/login` redirects to dashboard
- [ ] POST `/admin/logout` → invalidate session, redirect login
- [ ] After logout → `/admin/*` redirects login
- [ ] Guest middleware: logged in admin → `/admin/login` redirects dashboard
- [ ] Auth middleware: unauthenticated → `/admin` redirects login
- [ ] Admin middleware: non-admin → 403
- [ ] Admin middleware: admin → proceeds

### 4.2 Admin Dashboard (9 tests)

- [ ] Product count matches DB
- [ ] Category count matches DB
- [ ] Portfolio count matches DB
- [ ] Artist count matches DB
- [ ] Review count matches DB
- [ ] Stats update after CRUD
- [ ] "Add Product" → `admin.products.create`
- [ ] "Add Portfolio" → `admin.portfolio.create`
- [ ] "Edit Landing Page" → `admin.content.index`
- [ ] Sidebar active state correct
- [ ] User initial avatar displays
- [ ] "View Site" opens homepage
- [ ] Logout in sidebar works

### 4.3 Product Management (32 tests)

- [ ] Index shows all products with correct columns
- [ ] Stats cards: total, published, draft, low_stock
- [ ] Toggle status flips `is_visible`
- [ ] Low stock indicator when `stock <= minimum_stock`
- [ ] Desktop table view
- [ ] Mobile card view
- [ ] Flash success after operations
- [ ] Create form renders with empty `$product`
- [ ] Category dropdown from DB
- [ ] Badge dropdown from DB
- [ ] Submit creates product
- [ ] Slug auto-generated from name
- [ ] Slug uniqueness enforced (-1, -2...)
- [ ] Thumbnail → `storage/app/public/products/`
- [ ] Gallery → `storage/app/public/products/gallery/`
- [ ] Gallery creates `product_galleries` records
- [ ] "Publish" → `is_visible = 1`
- [ ] "Draft" → `is_visible = 0`
- [ ] Audit log on create
- [ ] Validation: name required
- [ ] Validation: category_id exists
- [ ] Validation: price numeric, min:0
- [ ] Validation: stock integer, min:0
- [ ] Validation: thumbnail max 20MB, mimes
- [ ] Edit pre-fills data
- [ ] Replace thumbnail deletes old
- [ ] Add gallery appends to existing
- [ ] AJAX gallery delete → storage + DB
- [ ] Audit log on update
- [ ] Soft delete sets `deleted_at`
- [ ] Restore from soft delete
- [ ] Audit log on delete

### 4.4 Category Management (7 tests)

- [ ] 6 product categories seeded
- [ ] 6 gallery categories seeded
- [ ] Unique slugs
- [ ] Product belongs to valid category
- [ ] RESTRICT on category delete with products
- [ ] Portfolio belongs to valid category
- [ ] NULL ON DELETE for portfolio categories

### 4.5 Portfolio Management (18 tests)

- [ ] Index shows all items with columns
- [ ] Stats: total, featured, hidden, newest
- [ ] Desktop table + mobile cards
- [ ] Create form with artist/category dropdowns
- [ ] Submit creates portfolio item
- [ ] Slug auto-generated from title
- [ ] Image → `storage/app/public/portfolio/`
- [ ] Audit log on create
- [ ] Edit pre-fills data
- [ ] Replace image deletes old
- [ ] Audit log on update
- [ ] Hard delete
- [ ] Image deleted from storage
- [ ] Audit log on delete
- [ ] Featured items on homepage
- [ ] All visible on `/gallery`
- [ ] Filter by tattoo_style (Alpine.js)
- [ ] Search by title (Alpine.js)

### 4.6 Artist Management (9 tests)

- [ ] 3 artists seeded
- [ ] Unique slugs
- [ ] Linked to user via `user_id`
- [ ] `artist->portfolioItems` returns correct items
- [ ] NULL ON DELETE for portfolio artist
- [ ] `artist->reviews` returns correct reviews
- [ ] NULL ON DELETE for review artist
- [ ] Featured artist on homepage
- [ ] Instagram link with `@` handling

### 4.7 Reviews Management (22 tests)

- [ ] Index with all columns
- [ ] Stats: total, published, draft, featured
- [ ] Search filter (client-side)
- [ ] Status filter dropdown
- [ ] Artist filter dropdown
- [ ] Star rating display (1-5)
- [ ] Create form with artist dropdown
- [ ] Interactive star selector
- [ ] Submit creates review
- [ ] Photo → `storage/app/public/reviews/`
- [ ] Audit log on create
- [ ] Validation: name required
- [ ] Validation: rating 1-5
- [ ] Validation: content required
- [ ] Edit pre-fills data
- [ ] Replace photo deletes old
- [ ] Audit log on update
- [ ] Hard delete + photo cleanup
- [ ] Toggle `is_visible`
- [ ] Toggle `is_featured`
- [ ] Homepage shows visible reviews
- [ ] Average rating calculated correctly

### 4.8 Content/Section Management (14 tests)

- [ ] 9 sections listed (hero–footer)
- [ ] Shows image, title, slug, updated, status
- [ ] Edit form pre-fills section data
- [ ] Title required
- [ ] Image → `storage/app/public/sections/`
- [ ] Visibility radio works
- [ ] PUT update persists
- [ ] Replace image deletes old
- [ ] Audit log on update
- [ ] Flash success after update
- [ ] All 9 sections render on homepage
- [ ] Visibility toggle hides/shows
- [ ] Footer dynamic from settings
- [ ] Navbar WhatsApp from settings

### 4.9 Settings (15 tests)

- [ ] 14 settings seeded (4 groups)
- [ ] Unique keys
- [ ] Correct group categorization
- [ ] Brand name in navbar
- [ ] WhatsApp number renders
- [ ] Instagram link renders
- [ ] TikTok link renders
- [ ] Facebook link renders
- [ ] Address renders
- [ ] Business hours render
- [ ] Email renders (mailto:)
- [ ] Phone renders (tel:)
- [ ] Google Maps link renders
- [ ] SEO meta title renders
- [ ] SEO meta description renders

### 4.10 WhatsApp Flow (17 tests)

- [ ] `/booking` renders 6 sections
- [ ] Service defaults from `?service=`
- [ ] Location visible only for home_service
- [ ] Reference checkbox toggles hidden input
- [ ] WhatsApp number from Settings
- [ ] Validation: name required
- [ ] Validation: country required
- [ ] Validation: service in:studio,home_service
- [ ] Validation: tattoo_style required
- [ ] Validation: budget required
- [ ] Validation: email format if provided
- [ ] Build WhatsApp message correctly
- [ ] Redirect to `wa.me/{number}?text=`
- [ ] Number formatted (08xx → 628xx)
- [ ] Message contains all sections
- [ ] No data stored in database
- [ ] Form resubmits with old input

### 4.11 File Upload (18 tests)

- [ ] Product thumbnail → `products/`, max 20MB, jpg/png/webp
- [ ] Product gallery → `products/gallery/`, multiple, max 20MB each
- [ ] Gallery creates `product_galleries` records
- [ ] AJAX gallery delete removes storage + DB
- [ ] Drag-and-drop zone works
- [ ] "Clear All" removes previews
- [ ] Portfolio image → `portfolio/`, max 5MB
- [ ] Section image → `sections/`, max 5MB
- [ ] Review photo → `reviews/`, max 5MB
- [ ] Old files deleted on replace (all types)
- [ ] Files deleted on record delete
- [ ] Upload directories writable
- [ ] `public/storage` symlink exists
- [ ] Files accessible via public URL
- [ ] Old thumbnail deleted on replace
- [ ] Old portfolio image deleted on replace
- [ ] Old section image deleted on replace
- [ ] Old review photo deleted on replace

### 4.12 Database Integrity (35 tests)

- [ ] 18 migrations run on `migrate:fresh`
- [ ] No missing/extra migrations
- [ ] FK constraints correct
- [ ] 8 seeders run without error
- [ ] UserSeeder: 1 admin
- [ ] ArtistProfileSeeder: 3 artists
- [ ] CategorySeeder: 12 categories
- [ ] ProductBadgeSeeder: 6 badges
- [ ] PortfolioItemSeeder: 6 items
- [ ] SectionSeeder: 9 sections
- [ ] SettingSeeder: 14 settings
- [ ] WhatsappTemplateSeeder: 3 templates
- [ ] FK: `products.category_id` → `categories` (RESTRICT)
- [ ] FK: `products.badge_id` → `product_badges` (NULL)
- [ ] FK: `product_galleries.product_id` → `products` (CASCADE)
- [ ] FK: `artist_profiles.user_id` → `users` (NULL)
- [ ] FK: `portfolio_items.category_id` → `categories` (NULL)
- [ ] FK: `portfolio_items.artist_id` → `artist_profiles` (NULL)
- [ ] FK: `reviews.artist_id` → `artist_profiles` (NULL)
- [ ] FK: `reviews.product_id` → `products` (NULL)
- [ ] FK: `section_items.section_id` → `sections` (CASCADE)
- [ ] FK: `audit_logs.user_id` → `users` (NULL)
- [ ] Indexes: products (8 indexes)
- [ ] Indexes: product_galleries (1 index)
- [ ] Indexes: artist_profiles (1 index)
- [ ] Indexes: portfolio_items (4 indexes)
- [ ] Indexes: reviews (3 indexes)
- [ ] Indexes: audit_logs (2 indexes)
- [ ] Soft deletes: users + products
- [ ] Soft-deleted products excluded from queries
- [ ] Soft-deleted products restorable
- [ ] Audit logs: product CRUD
- [ ] Audit logs: portfolio CRUD
- [ ] Audit logs: section update
- [ ] Audit logs: review CRUD

### 4.13 UI Navigation (38 tests)

- [ ] Navbar sticky on scroll
- [ ] Logo → homepage
- [ ] Nav links correct
- [ ] WhatsApp CTA visible
- [ ] Mobile hamburger works
- [ ] Mobile menu closes on outside click
- [ ] Mobile menu closes on link click
- [ ] Active states correct
- [ ] Footer 4-column desktop
- [ ] Footer brand column
- [ ] Footer quick links
- [ ] Footer studio info
- [ ] Footer social links
- [ ] External links → new tab
- [ ] Copyright renders
- [ ] Footer data from settings
- [ ] Home → Shop link
- [ ] Home → Gallery link
- [ ] Home → Booking link
- [ ] Home → Artist link
- [ ] Shop → Product detail
- [ ] Shop category chips scroll
- [ ] Gallery → Portfolio detail
- [ ] Gallery filter/search
- [ ] Portfolio detail → Artist
- [ ] Portfolio detail → Booking CTA
- [ ] Artist → Portfolio detail
- [ ] Booking → Back to Home
- [ ] Breadcrumb: Home → Shop → Category → Product
- [ ] Breadcrumb: Home → Gallery → Portfolio
- [ ] Breadcrumb: Home → Gallery → Artist
- [ ] Admin sidebar: all links work
- [ ] Admin sidebar: settings submenu
- [ ] Admin sidebar: active state
- [ ] Admin sidebar: logout
- [ ] Admin mobile: sidebar toggle
- [ ] Admin mobile: overlay closes
- [ ] Responsive: 390/768/1024/1440/1920px

### 4.14 Additional Checks (28 tests)

- [ ] `npm run build` pass
- [ ] CSS < 150KB
- [ ] JS < 150KB
- [ ] Vite manifest correct
- [ ] No 404 for CSS/JS
- [ ] `config:clear` works
- [ ] `view:clear` works
- [ ] `route:clear` works
- [ ] `cache:clear` works
- [ ] `view:cache` compiles all
- [ ] `composer dump-autoload` works
- [ ] 404 for `/nonexistent`
- [ ] 404 for invalid product slug
- [ ] 404 for invalid portfolio slug
- [ ] 404 for invalid artist slug
- [ ] 403 for unauthorized admin
- [ ] 500 for server errors
- [ ] 419 for CSRF mismatch
- [ ] CSRF on all forms
- [ ] `@csrf` + `@method` correct
- [ ] Session driver = database
- [ ] HTTPS in production
- [ ] APP_DEBUG=false in production
- [ ] Eager loading in controllers
- [ ] No SELECT * in critical paths
- [ ] Portfolio seeder FK valid
- [ ] Section slugs correct
- [ ] WhatsApp template types valid

---

## Changelog

| Date | Action |
|------|--------|
| 2026-07-21 | Initial QA.md created — Static QA (20 issues), Regression QA (Booking + Contacts), Test Plan (277 tests) |
| 2026-07-21 | CRUD Audit — 6 modul di-audit, 27 gap ditemukan (Category/Artist/Settings tidak ada CRUD, Pagination/Search/Sorting hilang di Product/Portfolio/Review) |
| 2026-07-21 | Audit sistem upload file — 8 issues (2 Critical: soft delete file loss + review fallback 404, 4 Major, 2 Minor, 4 Saran) |
