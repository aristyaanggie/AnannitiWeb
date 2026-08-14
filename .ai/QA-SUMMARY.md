# QA Summary — Ananniti Tattoo Bali

**Tanggal**: 2026-07-21
**Status**: Pre-Production QA
**Total Temuan**: 36 (dari Static QA + CRUD Audit + Upload Audit)

---

## Ringkasan Temuan

| Kategori | Critical | Major | Minor | Saran | Total |
|----------|----------|-------|-------|-------|-------|
| Static QA | 2 | 5 | 8 | 5 | 20 |
| CRUD Audit | — | — | — | — | 27 gap |
| Upload Audit | 2 | 4 | 2 | 4 | 12 |
| **Total** | **4** | **9** | **10** | **9** | **32 issues + 27 gap** |

---

## Semua Temuan FAIL (Perlu Perbaikan)

### CRITICAL (4 issues)

| # | Kategori | File | Masalah | Dampak |
|---|----------|------|---------|--------|
| **SC1** | Static QA | `resources/views/layouts/app.blade.php:7` | Config key `config('ananniti.tagline')` salah — seharusnya `config('ananniti.studio.tagline')`. Tagline dari `.env` tidak pernah terbaca. | Meta tag tagline selalu fallback ke default hardcoded. SEO terdampak. |
| **SC2** | Static QA | `resources/views/pages/home.blade.php:417,441` | Fallback review photo ke `public/images/reviews/review-{n}.svg` — direktori **tidak ada**. | Setiap review tanpa photo → 404 di fallback-nya juga. Broken image. |
| **UC1** | Upload | `app/Services/ProductService.php:106–125` | Soft delete menghapus file thumbnail + gallery dari storage. Saat restore, hanya DB yang di-restore — file hilang permanen. | Product yang di-restore punya gambar broken. |
| **UC2** | Upload | `resources/views/pages/home.blade.php:417,441` | (Sama dengan SC2 — tercatat di 2 audit) | — |

---

### MAJOR (9 issues)

| # | Kategori | File | Masalah | Dampak |
|---|----------|------|---------|--------|
| **SM1** | Static QA | `resources/views/pages/shop-category.blade.php:17–104` | View hardcoded — `$products` dari controller tidak dipakai. Semua kategori menampilkan halaman "Tattoo Machine" yang sama. | Shop category page tidak berfungsi — semua kategori sama. |
| **SM2** | Static QA | `app/Services/ReviewService.php` | Dead service — 8 method, tidak pernah di-inject/dipanggil. | Code bloat, membingungkan developer. |
| **SM3** | Static QA | `app/Services/LandingPageService.php` | Dead service — 6 method, tidak pernah di-inject/dipanggil. | Code bloat. |
| **SM4** | Static QA | `app/Services/SettingService.php` | Dead service — tidak pernah di-inject. Settings diakses langsung via `Setting::where()`. | Inkonsistensi arsitektur. |
| **SM5** | Static QA | `app/Http/Controllers/Admin/AdminAuthController.php:55` | Dead code — method `home()` public, tidak ada route. | Code bloat. |
| **UM1** | Upload | `resources/views/admin/products/index.blade.php:96,163` | Tanpa null check pada `thumbnail`. Jika null → `asset('storage/')` → broken image. | Admin product list menampilkan gambar rusak. |
| **UM2** | Upload | `resources/views/admin/reviews/index.blade.php:108,197` | Tanpa null check pada `photo`. Jika null → broken image. | Admin review list menampilkan gambar rusak. |
| **UM3** | Upload | `app/Services/ProductService.php:116–119` | Gallery record hard-deleted saat soft delete. Saat restore, gallery records hilang permanen. | Double data loss — file + record. |
| **UM4** | Upload | `app/Services/ProductService.php:127–138` | Restore tanpa verifikasi file. Tidak dicek apakah file masih ada di storage. | User tidak tahu file mungkin hilang. |

---

### MINOR (10 issues)

| # | Kategori | File | Masalah |
|---|----------|------|---------|
| **Smm1** | Static QA | `app/Http/Controllers/GalleryController.php:11` | Unused import: `use Illuminate\Http\Request` |
| **Smm2** | Static QA | `app/Http/Controllers/GalleryController.php:12` | Unused import: `use Illuminate\Support\Str` |
| **Smm3** | Static QA | `app/Http/Controllers/Admin/AdminAuthController.php:55` | `home()` tidak passing `$pageTitle` — misleading. |
| **Smm4** | Static QA | `app/Repositories/CategoryRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. |
| **Smm5** | Static QA | `app/Repositories/ReviewRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. |
| **Smm6** | Static QA | `app/Repositories/SettingRepository.php` | Bound di AppServiceProvider tapi tidak pernah di-inject. |
| **Smm7** | Static QA | `resources/views/components/layout/footer.blade.php:4–19` | 7 individual Setting queries per page load. |
| **Smm8** | Static QA | `resources/views/components/layout/navbar.blade.php:2` | Setting query on every page load. |
| **Um1** | Upload | `resources/views/pages/home.blade.php` | Strategi fallback tidak konsisten (onerror vs @if vs SVG). |
| **Um2** | Upload | `resources/views/pages/gallery.blade.php:9`, `home.blade.php:49` | Gambar statis hardcoded — jika file hilang, broken. |

---

### SARAN (9 issues)

| # | Kategori | File | Saran |
|---|----------|------|-------|
| **SS1** | Static QA | `config/ananniti.php` | 19 dari 22 config keys tidak pernah dibaca. Pertimbangkan hapus atau gunakan `Setting` model. |
| **SS2** | Static QA | `resources/views/layouts/admin.blade.php:10–34` | Inline `<style>` block bypass Vite. |
| **SS3** | Static QA | `resources/views/pages/home.blade.php:8` | Spaces dalam asset filename (`Hero Section.JPG`). Fragile untuk CDN. |
| **SS4** | Static QA | `app/Http/Controllers/HomeController.php:14–19` | Reviews loaded without `->with('artist')`. Potensi N+1. |
| **SS5** | Static QA | `resources/views/layouts/auth.blade.php:8` | `@vite` loads CSS only, no JS. |
| **US1** | Upload | `app/Services/ProductService.php:106–125` | Implementasikan file archival saat soft delete (pindah ke `trash/`). |
| **US2** | Upload | Semua blade view | Standarisasi pola fallback (pilih 1: `@if` ATAU `onerror`). |
| **US3** | Upload | Semua service | Tambahkan pengecekan `file_exists()` setelah upload. |
| **US4** | Upload | `UpdateProductRequest:23` | Slug `required` di update tapi `nullable` di create — inkonsisten. |

---

### CRUD Audit Gaps (27)

| Modul | Masalah |
|-------|---------|
| **Category** | Tidak ada CRUD admin — hanya via seeder. Tidak bisa tambah/edit/hapus kategori. |
| **Artist** | Tidak ada CRUD admin — hanya via seeder. Sidebar "Artists" link placeholder ke dashboard. |
| **Settings** | Tidak ada CRUD admin — hanya via seeder. `SettingService` sudah ada tapi tidak pernah dipakai. |
| **Product** | Pagination ❌, Search ❌, Sorting ❌ |
| **Portfolio** | Pagination ❌, Search ❌, Sorting ❌, Soft delete ❌ |
| **Review** | Pagination ❌, Search ❌, Sorting ❌, Soft delete ❌ |

---

## Rencana Perbaikan

### Prioritas 1 — Critical (Wajib sebelum production)

| # | Temuan | Perbaikan | Estimasi |
|---|--------|-----------|----------|
| SC1 | Config key salah | Ganti `config('ananniti.tagline')` → `config('ananniti.studio.tagline')` di `app.blade.php:7` | 1 menit |
| SC2/UC2 | Review fallback 404 | Buat direktori `public/images/reviews/` + tambahkan 5 file SVG placeholder (`review-1.svg` s/d `review-5.svg`) | 10 menit |
| UC1/UM3/UM4 | Soft delete file loss | Refactor `ProductService::deleteProduct()` — pindahkan file ke `_archive/products/` daripada hapus. Tambahkan method `restoreFiles()` di `restoreProduct()` | 30 menit |
| UM1 | Admin product null thumbnail | Tambahkan `@if($product->thumbnail)` guard di `admin/products/index.blade.php:96,163` | 5 menit |
| UM2 | Admin review null photo | Tambahkan `@if($review->photo)` guard di `admin/reviews/index.blade.php:108,197` | 5 menit |

### Prioritas 2 — Major (Sebaiknya sebelum production)

| # | Temuan | Perbaikan | Estimasi |
|---|--------|-----------|----------|
| SM1 | Shop category hardcoded | Refactor `shop-category.blade.php` — gunakan `$products` dan `$category` dari controller | 20 menit |
| SM2 | Dead service `ReviewService` | Hapus file + unregister binding di `AppServiceProvider` | 5 menit |
| SM3 | Dead service `LandingPageService` | Hapus file | 2 menit |
| SM4 | Dead service `SettingService` | Pertimbangan: hapus ATAU integrasikan ke controller yang pakai `Setting::where()` langsung | 10 menit |
| SM5 | Dead code `AdminAuthController::home()` | Hapus method + view `admin/home.blade.php` | 5 menit |
| UM4 | Restore tanpa verifikasi file | Tambahkan cek `Storage::disk('public')->exists()` di `restoreProduct()` + flash warning jika file hilang | 10 menit |

### Prioritas 3 — Minor (Bisa setelah production)

| # | Temuan | Perbaikan | Estimasi |
|---|--------|-----------|----------|
| Smm1–2 | Unused import | Hapus 2 baris `use` di `GalleryController.php` | 1 menit |
| Smm3 | Missing `$pageTitle` | Tambahkan `'pageTitle' => 'Selamat Datang'` di `AdminAuthController::home()` | 1 menit |
| Smm4–6 | Orphan repositories | Hapus 3 repository + unregister binding di `AppServiceProvider` | 10 menit |
| Smm7–8 | N+1 query di footer/navbar | Gunakan `View::composer` atau cache settings di service provider | 15 menit |
| Um1 | Fallback tidak konsisten | Standarisasi ke pola `@if` Blade check di semua view | 15 menit |
| Um2 | Gambar statis hardcoded | Tambahkan `onerror` fallback di gallery hero + home about | 5 menit |

### Prioritas 4 — Saran (Future improvement)

| # | Temuan | Perbaikan | Estimasi |
|---|--------|-----------|----------|
| SS1 | Config keys tidak dipakai | Evaluasi: gunakan config ATAU Setting model, hapus yang tidak dipakai | 15 menit |
| SS2 | Inline style bypass Vite | Pindahkan ke CSS file yang di-compile Vite | 10 menit |
| SS3 | Filename spaces | Rename file + update referensi | 5 menit |
| SS4 | Reviews N+1 | Tambahkan `->with('artist')` di `HomeController` | 2 menit |
| SS5 | Auth layout CSS only | Tambahkan `resources/js/app.js` ke `@vite` jika Alpine.js diperlukan | 1 menit |
| US1 | File archival | Implementasi `_archive/` directory untuk soft delete files | 30 menit |
| US2 | Standarisasi fallback | Buat komponen `<x.image>` reusable dengan fallback bawaan | 30 menit |
| US3 | File existence check | Tambahkan `file_exists()` setelah `$file->store()` | 10 menit |
| US4 | Slug nullable vs required | Sinkronkan: buat slug `nullable` di `UpdateProductRequest` | 2 menit |

---

## Estimasi Total Perbaikan

| Prioritas | Jumlah | Estimasi Waktu |
|-----------|--------|----------------|
| P1 — Critical | 5 issues | ~51 menit |
| P2 — Major | 6 issues | ~52 menit |
| P3 — Minor | 10 issues | ~59 menit |
| P4 — Saran | 9 issues | ~105 menit (~1.75 jam) |
| **Total** | **30 issues** | **~4 jam 27 menit** |

---

## Checklist Perbaikan

### P1 — Critical

- [ ] SC1: Fix config key `ananniti.tagline` → `ananniti.studio.tagline`
- [ ] SC2: Buat `public/images/reviews/` + 5 SVG placeholder
- [ ] UC1: Refactor soft delete — file archival ke `_archive/`
- [ ] UM1: Tambah null check thumbnail di admin products index
- [ ] UM2: Tambah null check photo di admin reviews index

### P2 — Major

- [ ] SM1: Refactor `shop-category.blade.php` — gunakan data dari controller
- [ ] SM2: Hapus `ReviewService.php` + unregister binding
- [ ] SM3: Hapus `LandingPageService.php`
- [ ] SM4: Hapus atau integrasikan `SettingService`
- [ ] SM5: Hapus `AdminAuthController::home()` + view `admin/home.blade.php`
- [ ] UM4: Tambah verifikasi file saat restore

### P3 — Minor

- [ ] Smm1–2: Hapus unused import di `GalleryController`
- [ ] Smm3: Tambah `$pageTitle` di `AdminAuthController::home()`
- [ ] Smm4–6: Hapus 3 orphan repositories + unregister binding
- [ ] Smm7–8: Optimasi query footer/navbar (cache/settings)
- [ ] Um1: Standarisasi fallback pattern
- [ ] Um2: Tambah fallback di gambar statis

### P4 — Saran

- [ ] SS1: Evaluasi config keys
- [ ] SS2: Pindahkan inline style ke Vite
- [ ] SS3: Rename filename dengan spaces
- [ ] SS4: Tambahkan eager loading reviews
- [ ] SS5: Tambah JS ke auth layout @vite
- [ ] US1: Implementasi file archival
- [ ] US2: Buat komponen `<x.image>` reusable
- [ ] US3: Tambah file existence check
- [ ] US4: Sinkronkan slug nullable vs required
