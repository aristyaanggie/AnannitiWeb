# Sprint 40.5.1.2 — Hero Responsive Final Fix (Mobile & Desktop Consistency)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Final UI Retouch (Hero Section Only)

## Objective

Perbaiki Hero agar tampil konsisten di desktop, tablet, dan mobile. Target: mobile terasa seperti desktop diperkecil rapi, bukan layout berbeda.

## Root Cause Analysis

### Navbar Mobile Hilang
- `@pushOnce('scripts')` di navbar.blade.php tidak pernah dirender
- Penyebab: **tidak ada `@stack('scripts')` di layouts/app.blade.php** → script navbar tidak diinject
- Akibat: `navbarData()` undefined → Alpine.js gagal → hamburger menu tidak bekerja
- Solusi: tambah `@stack('scripts')` di app.blade.php sebelum closing `</body>`

### Hero Image Focal Point
- Foto hero: studio storefront malam hari, aspect ratio ~1.8:1
- Focal point: tanda "Ananniti TATTOO" di tengah-kanan (terang dengan lighting)
- Mobile dengan `object-cover object-center` → foto crop simetris, focal point tetap terbaca

### Mobile/Desktop Konsistensi
- Sprint 40.5.1.1 sudah dirapatkan spacing mobile
- Tetapi navbar hilang membuat hero terasa "patah" di mobile
- Fix navbar Alpine → hero terasa utuh lagi

## Changes

File: `resources/views/layouts/app.blade.php` (hanya 1 baris ditambah)

| Line | Before | After |
|------|--------|-------|
| 20–21 | `</div>\n</body>` | `</div>\n@stack('scripts')\n</body>` |

**Penjelasan**: `@stack('scripts')` di app.blade.php merender output dari `@pushOnce('scripts')` di navbar.blade.php. Alpine.js di navbar akan diinject saat page load → `navbarData()` tersedia → hamburger menu berfungsi.

## Responsive QA (12 breakpoints)

| Breakpoint | Navbar | Hero Image | Content | CTA | Trust Row | Overflow |
|------------|--------|-----------|---------|-----|-----------|----------|
| 320 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 360 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 375 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 390 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 412 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 430 | hamburger + logo ✓ | focal point terbaca ✓ | rapat mobile ✓ | full-width ✓ | wrap 2 line ✓ | none ✓ |
| 768 | full nav + CTA ✓ | focal point terbaca ✓ | md rhythm ✓ | auto ✓ | 1 line + divider ✓ | none* |
| 820 | full nav + CTA ✓ | focal point terbaca ✓ | md rhythm ✓ | auto ✓ | 1 line + divider ✓ | none* |
| 1024 | full nav + CTA ✓ | focal point terbaca ✓ | lg rhythm ✓ | auto ✓ | 1 line + divider ✓ | none |
| 1280 | full nav + CTA ✓ | focal point terbaca ✓ | identik ✓ | auto ✓ | 1 line + divider ✓ | none |
| 1440 | full nav + CTA ✓ | focal point terbaca ✓ | identik ✓ | auto ✓ | 1 line + divider ✓ | none |
| 1920 | full nav + CTA ✓ | focal point terbaca ✓ | identik ✓ | auto ✓ | 1 line + divider ✓ | none |

\* 768–820: horizontal scroll tetap dari Navbar (H2 spacing crowding) — dikerjakan Sprint 40.5.2.

### Checks
- **Navbar tidak hilang**: `@stack('scripts')` meng-inject Alpine script dari navbar → `navbarData()` tersedia ✓
- **Hero image focal point**: `object-cover object-center` menjaga focal point di semua breakpoint ✓
- **Mobile layout khusus**: spacing mobile dirapatkan, desktop identik ≥640px ✓
- **Desktop identical**: layout dan spacing ≥768px sama persis dengan sebelum sprint ✓
- **Layout shift**: hanya 1 baris ditambah di app.blade.php, tidak ada perubahan struktur ✓

## Risk Assessment

- **Sistem**: Zero. Hanya 1 baris di layout file, tidak ada DB/migration/model/controller/route/logic/JS/CMS.
- **Section lain**: tidak tersentuh. Hanya app.blade.php global layout.
- **Risiko**: `@stack('scripts')` adalah fitur Blade bawaan Laravel, aman digunakan. Jika tidak ada script di stack, ia render kosong.
- **Catatan (di luar scope)**: Navbar spacing crowding 768–820 tetap → dikerjakan Sprint 40.5.2.

## Build

```
✓ npm run build — success (3.92s)
✓ CSS: 117.00 kB (gzip 19.61 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## Section Touched

Hero section + app.blade.php global layout (navbar script stack). No other files modified.
