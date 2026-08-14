# Sprint 36.1 — Brand Assets Runtime Fix

**Date**: 2026-07-23
**Status**: ✅ COMPLETE

## Objective
Pastikan seluruh Brand Assets CMS benar-benar digunakan oleh website.

## Audit Results

### Brand Assets Flow Traced:

| Asset | Upload → DB → Blade → Fallback | Status |
|-------|--------------------------------|--------|
| hero_image | AdminBrandAssetsController → `hero_image` key → `home.blade.php` `@if($heroImage)` → `Hero Section.JPG` | ✅ WORKING |
| about_image | AdminBrandAssetsController → `about_image` key → `home.blade.php` `@if($aboutImage)` → `storage/about/studio.jpg` | ✅ WORKING |
| gallery_hero | AdminBrandAssetsController → `gallery_hero` key → `gallery.blade.php` `@if($galleryHero)` → `onerror` → placeholder | ✅ WORKING |
| shop_hero | AdminBrandAssetsController → `shop_hero` key → `shop.blade.php` `@if($shopHero)` → `onerror` → placeholder | ✅ WORKING |
| logo | AdminBrandAssetsController → `logo` key → `navbar.blade.php` `@if($navLogo)` + `footer.blade.php` `@if($footerLogo)` → AT placeholder | ✅ WORKING |
| favicon | AdminBrandAssetsController → `favicon` key → all 3 layouts `@if($favIcon)` → default `public/favicon.ico` | ✅ FIXED |

### Temuan Utama
- **5 dari 6 assets** sudah terhubung dari Sprint 36
- **Favicon** adalah satu-satunya yang belum terhubung — layout tidak membaca dari settings
- **Fix**: Tambah `$favIcon` query + `<link rel="icon">` ke semua 3 layouts

### DB Values
- `hero_image` = `brand-assets/PGjCEKGuJeOoLu6YMjra9apOuojKR4XsVwavYWMH.jpg` (sudah ada file)
- `logo` = null (belum diupload)
- `favicon` = null (belum diupload)
- `about_image` = null (fallback ke `storage/about/studio.jpg`)
- `gallery_hero` = null (fallback via onerror)
- `shop_hero` = null (fallback via onerror)

## Files Modified (3)
1. `layouts/app.blade.php` — tambah favicon
2. `layouts/admin.blade.php` — tambah favicon
3. `layouts/auth.blade.php` — tambah favicon

## Build Result
```
✓ Build successful (3.22s)
✓ CSS: 111.06 kB
✓ JS: 92.32 kB
✓ Routes: 55
✓ Errors: 0
✓ Warnings: 0
```
