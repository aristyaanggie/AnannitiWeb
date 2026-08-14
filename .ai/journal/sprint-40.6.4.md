# Sprint 40.6.4 — About Final Layout (Keep Original Section Size)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Desktop UI Final (Phase 1) — About Section Only

## Objective

Kembalikan tinggi About Section seperti desain awal (tidak dipendekkan oleh tinggi teks). Foto besar, premium, elemen utama, tetap seimbang dengan blok teks. Tanpa empty frame, card effect, atau ruang kosong. CMS-safe (portrait/landscape/square).

## 1. Penyebab About Menjadi Pendek (Sprint 40.6.3)

Pada 40.6.2/40.6.3, frame desktop memakai `md:h-full`:
```
Frame: relative w-full overflow-hidden rounded md:h-full
  └─ img: md:absolute md:inset-0 md:h-full md:object-cover   (tidak menyumbang tinggi)
```
Karena img `md:absolute` tidak menyumbang tinggi, tinggi kolom foto = `h-full` dari wrapper yang stretch = **tinggi baris**, dan tinggi baris ditentukan **konten teks** (~380px). Foto pun dipaksa setinggi teks → **section jadi pendek, foto mengecil**.

**Temuan tambahan (root cause "empty frame" sebelumnya):** foto About saat ini `tzW6P1rCrdM5PempBG1jFXlToIJCZIHjqf6jhwPl.jpg` (4426×2659, landscape) adalah storefront malam dengan **±40% bagian atas berupa langit gelap**. Saat di-crop ke frame portrait (4:5) dengan `object-position center`, area langit gelap tampil besar di atas → terlihat seperti "area kosong / frame". Permasalahan ini tidak bisa diselesaikan dengan mengecilkan section — harus dengan struktur layout yang benar.

## 2. Cara Tinggi Section Dikembalikan Tanpa Mengorbankan Alignment

File: `resources/views/pages/home.blade.php` (photo column)

| Sebelum (40.6.3) | Sesudah (40.6.4) |
|------------------|------------------|
| Frame: `relative w-full overflow-hidden rounded bg-[#1a1a1a] md:h-full` | Frame: `relative w-full overflow-hidden rounded md:aspect-[4/5]` — **desktop tinggi = lebar × 5/4 (mengembalikan tinggi section)**; **hapus `bg-[#1a1a1a]`** agar foto IS the frame (tanpa kesan card) |

**Desktop (md+):**
- Frame `md:aspect-[4/5]` → kolom foto ~765px (sama dengan desain awal) → **section tinggi seperti semula**.
- img `md:absolute md:inset-0 md:h-full md:object-cover md:object-center` → mengisi penuh frame (crop center, tanpa ruang kosong).
- Text column `md:flex-1 md:justify-center` + container `md:items-stretch` → teks di-center terhadap foto. **Foto tetap elemen utama; teks sejajar di tengah.**

**Mobile (<md):**
- img `relative w-full h-auto` (in-flow) → tinggi mengikuti gambar natural → **tanpa empty frame**.
- Urutan Text → Photo tetap.

**CMS-safe:** portrait → crop center penuh; landscape → center band; square → crop penuh. Tidak ada tuning per-foto, tanpa margin/translateY/magic number.

## 3. Mengapa Layout Sekarang Lebih Profesional

- **Section tinggi kembali** — driven oleh kolom foto (4:5), bukan dipendekkan oleh teks.
- **Foto besar & dominan** — mengisi penuh kolom tinggi, premium editorial.
- **Tidak ada card/frame** — `bg-[#1a1a1a]` dihapus; area gelap pada foto adalah konten foto, bukan background frame. Rounded corners hanya membulatkan foto.
- **Balance visual** — foto & teks di-center pada kolom setinggi sama (items-stretch + justify-center).
- **Stabil untuk foto CMS apapun** — object-cover + aspect layout-driven.

## 4. Build Result

```
✓ npm run build — success (3.39s)
✓ CSS: 117.60 kB (gzip 19.78 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## 5. Risk Analysis

- **Sistem**: Zero. Tidak ada DB/migration/model/controller/route/logic/CMS.
- **Section lain**: Tidak tersentuh. Gradient atas & bawah About tidak diubah.
- **Desktop**: tinggi section kembali ke desain awal (4:5). Foto kiri, teks kanan, center.
- **Tablet (768–1024)**: dua kolom tetap (`md:flex-row`), frame 4:5 proporsional dengan lebar kolom.
- **Mobile**: in-flow natural (40.6.3 yang diterima), tanpa empty frame.
- **Perubahan visual disengaja**: foto di desktop kembali setinggi 4:5 (lebih tinggi dari 40.6.3) — sesuai target "kembalikan tinggi section".

## 6. QA Manual (harus dicek)

1. **Desktop (≥1024px)**: tinggi section About kembali tinggi (foto 4:5 besar); foto kiri, teks kanan; center foto segaris center blok teks.
2. **Foto saat ini (landscape storefront)**: foto mengisi penuh kolom; langit gelap adalah bagian foto (bukan kotak kosong) — tidak ada background card yang terlihat.
3. **Tidak ada card/frame**: tidak ada surface abu di tepi foto; hanya foto dengan sudut rounded.
4. **Uji CMS — portrait**: upload portrait → crop center penuh, layout tidak bergeser.
5. **Uji CMS — square**: crop penuh, rapi.
6. **Mobile (quick)**: Text → Photo, foto full-width natural, tanpa empty frame.
7. **Gradient atas & bawah About**: tidak berubah.

## Documentation

- `.ai/journal/sprint-40.6.4.md`
- `progress.md` — row 40.6.4 + version
- `change-log.md` — v13.0.10
