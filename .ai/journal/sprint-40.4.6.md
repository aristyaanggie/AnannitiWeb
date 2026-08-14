# Sprint 40.4.6 — About Photo Alignment Final

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Final UI Retouch (Layout Alignment Only)

## Objective

Perbaiki layout foto About agar benar-benar sejajar secara vertikal dengan block text di sebelah kanan.

## Problem

Grid About menggunakan alignment redundan:
- `items-center` pada container grid
- `self-center` pada kedua child (photo & text)

Kedua utility menargetkan hal yang sama (cross-axis centering), dan hasil akhir bergantung pada stretch semantics CSS Grid. Alignment tidak dikelola dari satu sumber (single source of truth), sehingga posisi foto rawan bergeser antar breakpoint.

## Solution

Ganti dari Grid ke Flex alignment yang deterministik:

| Before | After |
|--------|-------|
| `grid grid-cols-1 md:grid-cols-2 ... items-center` | `flex flex-col md:flex-row gap-12 md:gap-16 lg:gap-20 md:items-center` |
| Photo wrapper: `md:order-1 order-2 self-center` | `md:order-1 order-2 md:flex-1` |
| Text wrapper: `md:order-2 order-1 self-center` | `md:order-2 order-1 md:flex-1` |

**Cara kerja (desktop `md:`):**
- `md:flex-row` → photo (order-1) kiri, text (order-2) kanan
- `md:items-center` → kedua kolom di-center vertikal terhadap kolom paling tinggi; foto & text berbagi sumbu tengah yang sama
- `md:flex-1` pada kedua child → tetap 50/50 lebar (setara grid-cols-2 lama)

**Cara kerja (mobile):**
- `flex-col` → stack vertikal, text lebih dulu (order-1), foto di bawah (order-2)
- Tanpa `items-center` di mobile → tidak ada horizontal centering, text tetap rata kiri
- Child stretch penuh (default flex-col cross-axis stretch), lebar foto tetap full

**Tidak berubah:**
- Ukuran foto tetap `aspect-[4/5]` — tidak ada perubahan dimensi
- Gap tetap `gap-12 md:gap-16 lg:gap-20`
- Padding section tetap `py-24 md:py-32 lg:py-40`
- Order mobile/desktop tetap (text dulu di mobile, foto kiri di desktop)
- Tanpa margin negatif, tanpa translateY

## Changes

| File | Line | Before | After |
|------|------|--------|-------|
| `resources/views/pages/home.blade.php` | 55 | `grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20 items-center` | `flex flex-col md:flex-row gap-12 md:gap-16 lg:gap-20 md:items-center` |
| `resources/views/pages/home.blade.php` | 56 | `md:order-1 order-2 self-center` | `md:order-1 order-2 md:flex-1` |
| `resources/views/pages/home.blade.php` | 65 | `md:order-2 order-1 self-center` | `md:order-2 order-1 md:flex-1` |

## QA

### Alignment Desktop (md+)
- Photo dan text berbagi vertical center yang sama via `md:items-center` ✓
- Foto selalu tepat di tengah terhadap keseluruhan tinggi block text (kolom paling tinggi menentukan tinggi baris, keduanya di-center) ✓
- Tidak terlihat lebih atas maupun lebih bawah ✓

### Alignment Mobile
- Text tampil lebih dulu, foto di bawah, keduanya full-width ✓
- Tidak ada horizontal centering yang menggeser text ✓

### Konsistensi Layout
- Lebar kolom tetap 50/50 (`md:flex-1` setara `grid-cols-2`) ✓
- `aspect-[4/5]` dipertahankan — ukuran foto tidak berubah ✓
- Section lain di `home.blade.php` tidak tersentuh ✓

## Risk Analysis

- **Sistem**: Tidak ada perubahan database, migration, seeder, model, controller, route, middleware, validation, business logic, CMS, auth, upload, booking, WhatsApp flow, atau JavaScript. **Zero backend risk.**
- **Layout**: Perubahan terisolasi di section About. Flex dengan `flex-1` + `items-center` menghasilkan geometri yang sama dengan grid 2 kolom (50/50). `order-*` mempertahankan urutan visual lama.
- **Risiko sisa**: Foto `aspect-[4/5]` secara alami lebih tinggi dari block text di desktop (estimasi ~765px vs ~390px). Karena diminta center (bukan edge-matching), foto memanjang di atas & bawah text secara simetris. Jika di kemudian hari diinginkan tepi atas/bawah sejajar, itu keputusan ukuran foto — di luar scope sprint ini.

## Build

```
✓ npm run build — success (2.43s)
✓ CSS: 116.47 kB (gzip 19.52 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## Section Touched

About section ONLY. No other sections or files modified.
