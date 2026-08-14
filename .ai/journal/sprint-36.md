# Sprint 36 — Brand Assets CMS

**Date**: 2026-07-23
**Status**: ✅ COMPLETE

## Objective
CMS untuk logo, favicon, dan hero images menggunakan Settings table yang sudah ada.

## Features Implemented

### Admin Brand Assets Page
- 6 image uploads: logo, favicon, hero_image, about_image, gallery_hero, shop_hero
- Upload validation (image, max 5MB)
- Replace old file otomatis
- Preview image sebelum upload

### Public Website Integration
- Navbar: Dynamic logo dari Settings (fallback: AT placeholder)
- Footer: Dynamic logo dari Settings (fallback: AT placeholder)
- Homepage Hero: Dynamic dari Settings (fallback: Hero Section.JPG)
- Homepage About: Dynamic dari Settings (fallback: storage/about/studio.jpg)
- Gallery Hero: Dynamic dari Settings (fallback: onerror → placeholder)
- Shop Hero: Dynamic dari Settings (fallback: onerror → placeholder)
- Favicon: Dynamic dari Settings di semua 3 layouts

## Files Created (2)
1. `AdminBrandAssetsController.php`
2. `admin/brand-assets/edit.blade.php`

## Files Modified (9)
1. `SettingSeeder.php` — tambah 6 brand asset keys
2. `routes/web.php` — tambah 2 routes
3. `admin layout sidebar` — tambah Brand Assets link
4. `navbar.blade.php` — dynamic logo
5. `footer.blade.php` — dynamic logo
6. `home.blade.php` — dynamic hero + about
7. `gallery.blade.php` — dynamic gallery hero
8. `shop.blade.php` — dynamic shop hero
9. All 3 layouts — dynamic favicon

## Build Result
```
✓ Build successful (3.05s)
✓ CSS: 111.06 kB
✓ JS: 92.32 kB
✓ Routes: 55
✓ Errors: 0
✓ Warnings: 0
```
