# Sprint 40.6.1 — About Layout Architecture (CMS Safe)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Desktop UI Final (Phase 1) — About Section Only

## Objective

Bangun ulang arsitektur layout About agar **content-independent** — rapi untuk SEMUA foto CMS (portrait, landscape, square, resolusi besar/kecil) tanpa tuning per-foto.

## 1. Perubahan Arsitektur Layout

File: `resources/views/pages/home.blade.php` (About section, photo column only)

| Sebelum | Sesudah |
|---------|---------|
| Frame: `aspect-[4/5] overflow-hidden rounded` | Frame: `relative aspect-[4/5] overflow-hidden rounded bg-[#1a1a1a]` — ditambah `relative` (positioning context) + surface netral gelap |
| Image: `w-full h-full object-cover` (in-flow, height mengikuti frame via %) | Image: `absolute inset-0 w-full h-full object-cover object-center` — **decoupled** dari frame |

Prinsip arsitektur baru:

```
Photo column (md:flex-1, 50%)
  └─ Frame: relative + aspect-[4/5]   ← ukuran frame = lebar kolom × 4/5, TIDAK tergantung gambar
       └─ img: absolute inset-0 + object-cover   ← mengisi frame, crop premium
```

- **Frame size** ditentukan murni oleh: lebar kolom + `aspect-ratio` + `justify-center`. Bukan oleh gambar.
- **Image** diposisikan `absolute inset-0` → dimensi intrinsik gambar (tinggi/lebar asli) **tidak pernah** mempengaruhi tinggi frame. `object-cover object-center` mengisi frame dengan crop premium dari sudut mana pun.
- **Text column**: `md:flex-1 md:flex md:flex-col md:justify-center` + container `md:items-stretch` (equal-height columns) → teks selalu di-center terhadap kolom foto, terlepas dari isi gambar.
- **Surface netral** `bg-[#1a1a1a]`: mencegah flash putih/abu saat image load, saat image rusak, atau untuk PNG transparan.
- **Mobile**: tetap Text → Photo (`order-1`/`order-2`), tidak berubah.
- **Tanpa**: margin-top manual, translateY, negative margin, hardcoded padding, magic number.

## 2. Mengapa Solusi Ini Aman Terhadap Perubahan Foto CMS

| Skenario Foto CMS | Perilaku Layout |
|-------------------|-----------------|
| Portrait (tinggi) | Frame tetap 4:5 → object-cover crop, layout stabil |
| Landscape (lebar) | Frame tetap 4:5 → object-cover crop, layout stabil |
| Square | Frame tetap 4:5 → crop premium, layout stabil |
| Resolusi besar | Gambar `absolute` mengisi frame, tidak memperbesar layout |
| Resolusi kecil | Gambar di-upscale oleh frame (`absolute inset-0`), frame & teks tetap stabil |
| Path rusak / kosong | `onerror` fallback + `bg-[#1a1a1a]` → frame tetap penuh, tanpa area putih |
| Transparan (PNG) | Surface `#1a1a1a` tampil rapi di baliknya |

Karena frame `relative aspect-[4/5]` menetapkan ukuran dari **lebar kolom saja** (bukan dari gambar), dan gambar `absolute inset-0` hanya mengisi, maka **setiap perubahan CMS tidak menggeser layout sama sekali** — foto dapat diganti kapan pun tanpa perubahan kode.

## 3. Build Result

```
✓ npm run build — success (3.13s)
✓ CSS: 117.37 kB (gzip 19.72 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## 4. Risk Analysis

- **Sistem**: Zero. Tidak ada DB/migration/model/controller/route/logic/CMS yang disentuh.
- **Section lain**: Tidak tersentuh.
- **Layout desktop**: Ukuran foto, aspect 4:5, gap, crop, proporsi 50/50 — semuanya dipertahankan (identik visual dengan 40.6.0).
- **Mobile/tablet**: Perubahan hanya di frame & img (positioning internal). Stacking Text→Photo tetap. `md:` guard menjaga tablet.
- **Responsive Phase 5**: `absolute inset-0` + aspect-ratio adalah pola standar yang robust — tidak perlu dirombak ulang.
- **Catatan**: `bg-[#1a1a1a]` hanya terlihat saat image belum load / transparan / gagal — tidak mengubah tampilan foto normal.

## 5. QA Manual (harus dicek)

1. **Cek foto saat ini**: Foto studio tampil penuh, crop premium, tanpa flash putih saat load (harusnya gelap `#1a1a1a`).
2. **Cek teks & foto sejajar**: Center foto segaris dengan center blok teks (desktop ≥1024px).
3. **Uji CMS (disarankan)**: Ganti `about_image` di admin dengan foto landscape dan square → layout harus identik, foto ter-crop rapi, tidak ada pergeseran teks.
4. **Uji path rusak**: Set sementara `about_image` ke path tidak valid → frame tetap terisi (fallback/placeholder), tanpa area putih.
5. **Mobile (quick)**: Urutan tetap Text → Photo, foto full-width, rapi.

## Documentation

- `.ai/journal/sprint-40.6.1.md`
- `progress.md` — row 40.6.1 + version
- `change-log.md` — v13.0.7
