# Sprint 40.5.1 — Hero Responsive Polish

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Final UI Retouch (Hero Section Only)

## Objective

Implementasi hasil audit Sprint 40.5.0 untuk HERO SECTION saja. Perbaiki seluruh issue responsive: trust row overflow (H1), eyebrow wrap (L1), CTA mobile (L5). Desktop tetap IDENTIK.

## Changes

File: `resources/views/pages/home.blade.php` (Hero section only)

| Line | Issue | Before | After |
|------|-------|--------|-------|
| 23 | L1 — Eyebrow wraps di ≤~350px | `tracking-[0.3em]` | `tracking-[0.2em] sm:tracking-[0.3em]` (fits 1 line di 320–360, desktop unchanged) |
| 28, 32 | L5 — CTA mobile tidak "designed" | `inline-flex ... gap-2` | `inline-flex w-full sm:w-auto ...` (full-width stacked di mobile, auto di desktop) |
| 36 | H1 — Trust row overflow/clipped di 320–463px | `flex items-center gap-4` | `flex flex-wrap items-center gap-x-4 gap-y-2` (wraps, tidak terclip) |
| 41, 43 | H1 — Orphan divider saat wrap | `w-px h-3 bg-white/20` | `hidden sm:inline-block w-px h-3 bg-white/20` (divider hanya di single-line ≥sm) |

## Responsive QA (12 breakpoints)

| Breakpoint | Trust Row | CTA | Eyebrow | Overflow |
|------------|-----------|-----|---------|----------|
| 320 | wrap 2 line (146+245), no clip | full-width stacked | 1 line | none |
| 360 | wrap 2 line | full-width stacked | 1 line | none |
| 375 | wrap 2 line | full-width stacked | 1 line | none |
| 390 | wrap 2 line | full-width stacked | 1 line | none |
| 412 | wrap 2 line | full-width stacked | 1 line | none |
| 430 | wrap 2 line | full-width stacked | 1 line | none |
| 768 | 1 line + divider | auto (side-by-side) | 1 line | none* |
| 820 | 1 line + divider | auto (side-by-side) | 1 line | none* |
| 1024 | 1 line + divider | auto | 1 line | none |
| 1280 | 1 line + divider | auto | 1 line | none |
| 1440 | 1 line + divider | auto | 1 line | none |
| 1920 | 1 line + divider | auto | 1 line | none |

\* Catatan: di 768–820 masih ada horizontal scroll dari NAVBAR (issue H2, di luar scope Hero — dikerjakan di Sprint 40.5.2). Hero sendiri tidak overflow.

### Desktop Identical Check
- Eyebrow: `sm:tracking-[0.3em]` → sama persis ≥640px ✓
- Trust row: `gap-x-4` = `gap-4` lama, dividers `sm:inline-block` → sama persis ✓
- CTA: `sm:w-auto` → lebar sama persis ✓

## Risk Assessment

- **Sistem**: Zero. Tidak ada perubahan DB/migration/seeder/model/controller/route/middleware/business logic/JS/CMS.
- **Section lain**: Hanya Hero yang diubah. About, Services, Tattoo Supply, Portfolio, Artist, Consultation, Footer tidak tersentuh.
- **Layout shift**: Perubahan hanya menyentuh trust row (wrap) dan CTA (lebar mobile). Desktop pixel-identik. Tidak ada shift pada layout.
- **Risiko sisa**: Di 768–820px horizontal scroll tetap ada karena Navbar (H2) — dilaporkan, bukan bagian Hero. Fix di Sprint 40.5.2.

## Build

```
✓ npm run build — success (4.06s)
✓ CSS: 116.66 kB (gzip 19.56 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## Section Touched

Hero section ONLY. No other files modified.
