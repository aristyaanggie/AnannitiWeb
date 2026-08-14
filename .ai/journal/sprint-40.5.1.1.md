# Sprint 40.5.1.1 — Hero Responsive Fix (Revision)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Final UI Retouch (Hero Section Only — Revision 40.5.1)

## Objective

Perbaiki target visual Hero yang belum terpenuhi di Sprint 40.5.1:
1. Background Hero selalu memenuhi tinggi Hero (tidak ada blank space abu/putih)
2. Gradient langsung di bawah Hero (tidak turun terlalu jauh)
3. Mobile terasa layout khusus (bukan hasil mengecilkan desktop)
4. Tidak ada blank/white/gray space, horizontal scroll, vertical gap tidak perlu
5. Desktop tetap IDENTIK

## Root Cause

### Blank space abu/putih
Saat `$heroImage` gagal load (file tidak ada / path rusak) dan fallback juga gagal, `<img>` kosong menampilkan background section yang **transparan** → terlihat body putih dengan overlay `bg-black/40` → tampak area abu/putih besar di bawah. Tidak ada fallback warna di level section.

### Gradient turun terlalu jauh
Gradient `h-32` (128px) statis di semua breakpoint + vertical spacing mobile longgar → pada layar pendek section tumbuh melebihi 100svh dan gradient terdorong turun.

### Mobile terasa mengecilkan desktop
Spacing mobile identik desktop (`mb-5/mb-6/mb-10/mb-14`), tidak ada rhythm khusus mobile.

## Changes

File: `resources/views/pages/home.blade.php` (Hero only)

| Line | Before | After |
|------|--------|-------|
| 12 | `min-h-[100svh] relative overflow-hidden` | `min-h-[100svh] relative overflow-hidden bg-[#0a0a0a]` — fallback gelap permanen, hero tidak pernah putih/abu |
| 23 | `mb-5` (eyebrow) | `mb-4 sm:mb-5` |
| 24 | `mb-5` (subheading) | `mb-4 sm:mb-5` |
| 25 | `mb-6` (h1) | `mb-5 sm:mb-6` |
| 26 | `mb-10` (paragraph) | `mb-8 sm:mb-10` |
| 27 | `mb-14` (CTA row) | `mb-10 sm:mb-14` |
| 36 | `gap-x-4` (trust row) | `gap-x-3 sm:gap-x-4` |
| 49 | `h-32` (gradient) | `h-20 sm:h-32` — lebih pendek di mobile, ≥640px identik |

Semua perubahan dibungkus `sm:`/`md:`/`lg:` sehingga ≥640px (desktop & tablet 768/820) menggunakan nilai semula → **desktop IDENTIK**.

## Responsive QA (12 breakpoints)

| Breakpoint | Background | Gradient | Content | Overflow |
|------------|-----------|----------|---------|----------|
| 320 | full, gelap, tanpa area abu/putih | 80px band di dasar hero | rhythm rapat, CTA full-width | none |
| 360 | full | 80px | rhythm rapat | none |
| 375 | full | 80px | rhythm rapat | none |
| 390 | full | 80px | rhythm rapat | none |
| 412 | full | 80px | rhythm rapat | none |
| 430 | full | 80px | rhythm rapat | none |
| 768 | full | 128px (identik lama) | md layout | none* |
| 820 | full | 128px | md layout | none* |
| 1024 | full | 128px | lg layout identik | none |
| 1280 | full | 128px | identik | none |
| 1440 | full | 128px | identik | none |
| 1920 | full | 128px | identik | none |

\* Catatan: horizontal scroll 768–820 berasal dari Navbar (H2) — dilaporkan di 40.5.0, dikerjakan Sprint 40.5.2.

### Checks
- **Tidak ada blank space**: `bg-[#0a0a0a]` menjamin area hero selalu gelap saat image gagal/loading ✓
- **Image mengikuti tinggi section**: `absolute inset-0` (top+bottom=0) memaksa img setinggi section; `object-cover` mengisi penuh tanpa crop kosong ✓
- **Gradient di bawah Hero**: band 80px (mobile) / 128px (≥sm) di dasar hero, tepat sebelum About ✓
- **Desktop identical**: semua nilai ≥640px = nilai sebelum perubahan ✓
- **Layout shift**: perubahan hanya spacing/gradient/bg — tidak ada perubahan struktur ✓

## Risk Assessment

- **Sistem**: Zero. Tidak ada DB/migration/seeder/model/controller/route/business logic/JS/CMS yang disentuh.
- **Section lain**: Hanya Hero. Section lain tidak tersentuh.
- **Risiko**: `bg-[#0a0a0a]` pada section tidak terlihat selama image tampil normal (image menutupinya). Jika image normal, visual 100% sama dengan sebelumnya.
- **Catatan (di luar scope)**: Navbar mobile menu hilang — dicatat, dikerjakan Sprint 40.5.2.

## Build

```
✓ npm run build — success (3.67s)
✓ CSS: 117.00 kB (gzip 19.61 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## Section Touched

Hero section ONLY. No other files modified.
