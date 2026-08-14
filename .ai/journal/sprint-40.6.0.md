# Sprint 40.6.0 — About Final Polish (Desktop Only)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Desktop UI Final (Phase 1) — About Section Only

## Objective

1. Sempurnakan photo alignment — vertical center foto == vertical center blok teks
2. Sempurnakan transisi About → Services (hitam → abu → putih, premium editorial)

## Target 1 — Photo Alignment

### Problem
Container memakai `md:items-center` — centering hanya dari sisi container (taller item menentukan tinggi baris, item pendek di-center). Ini benar secara matematis, namun tidak eksplisit/terjamin bila proporsi teks berubah (e.g. paragraph lebih panjang).

### Solution
Equal-height columns + inner vertical centering:

| Before | After |
|--------|-------|
| Container: `... md:items-center` | Container: `... md:items-stretch` (kedua kolom tinggi sama) |
| Photo wrapper: `md:order-1 order-2 md:flex-1` | + `md:flex md:flex-col md:justify-center` (foto di-center vertikal di kolomnya) |
| Text wrapper: `md:order-2 order-1 md:flex-1` | + `md:flex md:flex-col md:justify-center` (teks di-center vertikal di kolomnya) |

Hasil: kedua kolom tinggi SAMA (kolom tertinggi menentukan), masing-masing konten di-center vertikal → **vertical center foto == vertical center blok teks** secara pasti, di kedua arah (foto lebih tinggi ATAU teks lebih tinggi).

**Dipertahankan**: ukuran foto, aspect `[4/5]`, object-cover, crop, gap, layout desktop, urutan mobile (Text → Photo, order-1/order-2). Mobile tidak berubah (`md:` only).

## Target 2 — About → Services Transition

### Problem
Gradient lama `from-[#0a0a0a] via-[#0a0a0a]/40 to-white` (3 stop) — lompatan nilai terlalu besar → terlihat garis batas/patah.

### Solution
Multi-stop ramp halus (6 stop) + tinggi sedikit lebih panjang:

| Before | After |
|--------|-------|
| `h-28 md:h-32` | `h-32 md:h-40` (lebih panjang, tidak ekstrem) |
| `bg-gradient-to-b from-[#0a0a0a] via-[#0a0a0a]/40 to-white` | `bg-[linear-gradient(to_bottom,#0a0a0a_0%,#202020_20%,#4e4e4e_45%,#9b9b9b_70%,#e3e3e3_90%,#ffffff_100%)]` |

Ramp: #0a0a0a → #202020 → #4e4e4e → #9b9b9b → #e3e3e3 → #ffffff. Hitam→abu→putih natural tanpa banding.

**Dipertahankan**: warna utama (#0a0a0a atas, putih bawah), gradient TIDAK dihapus, section bg tetap #0a0a0a. Top gradient = #0a0a0a (About bg) → seamless; bottom = #ffffff (Services bg) → seamless.

## Files Changed

- `resources/views/pages/home.blade.php` — About section (lines 55, 56, 65) + transition (lines 81–82). Hanya section About + transisinya. Tidak ada file lain.

## Build

```
✓ npm run build — success (4.26s)
✓ CSS: 117.37 kB (gzip 19.72 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## Risk

- **Sistem**: Zero. Tidak ada DB/migration/model/controller/route/logic/CMS.
- **Section lain**: Tidak tersentuh.
- **Layout**: Equal-height columns (`md:items-stretch` + inner `justify-center`) hanya aktif di `md:`. Mobile/tablet layout (Text → Photo) tidak berubah. Gradient multi-stop hanya mengubah visual background, bukan struktur.
- **Mobile/tablet**: `md:` guard memastikan stacking mobile tetap Text → Photo.

## Manual QA Checklist (desktop)

1. **Photo alignment**: Pada desktop (≥1024px), periksa garis horizontal imajiner — center foto harus tepat segaris dengan center blok teks (antara h2 dan trust points). Foto tidak boleh menonjol ke atas/bawah blok teks.
2. **Photo composition**: Foto studio tetap utuh (aspect 4/5, object-cover), tidak ada area kosong/abu di dalam kotak foto.
3. **Transition**: Pada transisi About (hitam) → Services (putih), tidak boleh ada garis batas keras — harus ramp halus hitam→abu→putih. Periksa pada 1440px dan 1920px.
4. **Section padding**: Jarak vertikal About & Services (py-24/32/40) tidak berubah.
5. **Gap antar kolom**: gap-12/16/20 antar foto & teks tetap proporsional.
6. **Mobile (quick)**: Stacking tetap Text → Photo, gradient transisi halus, tidak ada yang rusak.

## Documentation

- `.ai/journal/sprint-40.6.0.md` (ini)
- `progress.md` — row 40.6.0 + current phase
- `change-log.md` — v13.0.6
