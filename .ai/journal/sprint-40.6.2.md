# Sprint 40.6.2 — About Image Layout Rework (Professional CMS)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Desktop UI Final (Phase 1) — About Section Only

## Objective

Hapus masalah frame aspect-ratio tetap (area kosong / foto "ditempel dalam kotak"). Foto About harus menyatu dengan layout — tinggi wrapper mengikuti layout, image memenuhi wrapper via object-cover, tanpa letterbox/pillarbox/ruang mati untuk SEMUA foto CMS.

## 1. Perubahan Arsitektur Layout

File: `resources/views/pages/home.blade.php` (About photo column)

| Sebelum (40.6.1) | Sesudah (40.6.2) |
|------------------|------------------|
| Frame: `relative aspect-[4/5] ...` (fixed aspect menentukan tinggi) | Frame: `relative w-full aspect-[4/5] md:aspect-auto md:h-full ...` |
| Photo wrapper: `md:flex md:flex-col md:justify-center` | Photo wrapper: `md:flex-1` (tinggi ikut stretch kolom) |

Arsitektur baru:

```
Container (flex md:flex-row md:items-stretch)   ← tinggi = tinggi blok teks
  ├─ Photo column (md:flex-1, 50%)
  │    └─ Frame: relative + md:h-full (tinggi = tinggi kolom = tinggi teks)
  │         └─ img: absolute inset-0 + object-cover object-center
  └─ Text column (md:flex-1 md:justify-center)
```

**Cara kerja desktop (md+):**
- `md:items-stretch` → tinggi baris ditentukan **konten teks** (img absolute tidak menyumbang tinggi).
- Photo column stretch ke tinggi baris → frame `md:h-full` mengisi penuh.
- `md:aspect-auto` menonaktifkan aspect-ratio fixed → tidak ada kotak.
- img `absolute inset-0 object-cover object-center` mengisi frame — **tidak pernah ada ruang kosong**, apa pun orientasi foto.

**Mobile (<md):**
- Frame memakai `aspect-[4/5]` (karena img absolute tidak memberi tinggi) → foto tampil penuh lebar, proporsional.
- Urutan tetap Text → Photo.

## 2. Mengapa Lebih Baik daripada Sprint 40.6.1

| Kriteria | 40.6.1 (fixed aspect) | 40.6.2 (layout-driven) |
|----------|----------------------|------------------------|
| Foto landscape | Crop tengah vertikal sempit / terkesan "dalam kotak" | Mengisi penuh kolom, natural editorial |
| Foto portrait | Frame tinggi penuh, foto crop | Mengisi penuh kolom dengan crop center |
| Foto square | Crop ke 4:5 | Mengisi penuh kolom |
| Area kosong / letterbox | Potensial (frame lebih tinggi dari komposisi foto) | Tidak mungkin (object-cover penuh) |
| Keseimbangan kiri-kanan | Foto bisa lebih tinggi dari teks → dominan | Foto = tinggi teks persis → seimbang |
| Foto "menempel di kotak" | Ya (border frame 4:5 terlihat) | Tidak (foto memenuhi kolom, menyatu) |

Kunci: tinggi wrapper kini ditentukan **layout (konten teks)**, bukan rasio tetap. `object-cover` menjamin foto memenuhi area — foto terlihat natural seperti editorial premium, bukan ditempel di dalam bingkai.

## 3. Build Result

```
✓ npm run build — success (2.75s)
✓ CSS: 117.41 kB (gzip 19.72 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## 4. Risk Analysis

- **Sistem**: Zero. Tidak ada DB/migration/model/controller/route/logic/CMS yang disentuh.
- **Section lain**: Tidak tersentuh.
- **Visual desktop**: Foto sekarang setinggi blok teks (lebih pendek dari 4:5 lama) — ini perubahan yang DISENGAJA sesuai target ("tinggi wrapper mengikuti layout"). Ukuran/gap/crop properties lain dipertahankan.
- **Mobile/tablet**: `aspect-[4/5]` di mobile menjaga foto tetap tampil (img absolute). `md:` guard → tablet & desktop memakai `md:aspect-auto md:h-full`.
- **Responsive Phase 5**: pola absolute+object-cover di wrapper tinggi-layout adalah standar dan tidak perlu dirombak.
- **Risiko kecil**: Jika teks About sangat pendek, foto menjadi pendek/landscape — konsisten dengan kebutuhan "tinggi mengikuti layout".

## 5. QA Manual (harus dicek)

1. **Foto saat ini (landscape)**: Foto mengisi penuh kolom setinggi teks — tidak ada area kosong di bawah, tidak terlihat kotak.
2. **Keseimbangan**: Tinggi foto == tinggi blok teks; center keduanya segaris (desktop ≥1024px).
3. **Uji CMS — portrait**: upload foto portrait → foto mengisi penuh, crop center rapi, layout tidak bergeser.
4. **Uji CMS — square**: upload foto square → mengisi penuh, natural.
5. **Uji CMS — landscape lebar**: mengisi penuh, crop center, tidak ada ruang mati.
6. **Mobile (quick)**: Text → Photo, foto full-width aspect 4/5, rapi.
7. **Path rusak**: frame tetap terisi placeholder tanpa area putih.

## Documentation

- `.ai/journal/sprint-40.6.2.md`
- `progress.md` — row 40.6.2 + version
- `change-log.md` — v13.0.8
