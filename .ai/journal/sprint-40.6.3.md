# Sprint 40.6.3 — About Image Final (Remove Empty Frame)

**Date**: 2026-08-05
**Status**: ✅ Complete
**Type**: Desktop UI Final (Phase 1) — About Section Only

## Objective

Hilangkan seluruh empty frame/card pada foto About (khususnya mobile). Foto harus menyatu dengan layout — tanpa frame, letterbox, ruang kosong, atau background hitam di bawah foto.

## 1. Root Cause Mengapa Frame Kosong Muncul

Pada Sprint 40.6.2, frame mobile memakai **fixed aspect-ratio `aspect-[4/5]`**:
```
Frame: relative w-full aspect-[4/5] md:aspect-auto md:h-full
  └─ img: absolute inset-0 w-full h-full object-cover
```
- Tinggi frame ditentukan **lebar × 5/4** (rasio tetap), bukan oleh gambar.
- Karena img `absolute` tidak menyumbang tinggi, frame selalu lebih tinggi dari proporsi natural foto landscape → area frame di bawah komposisi foto terisi oleh surface gelap `bg-[#1a1a1a]`.
- Efek visual: foto tampak "ditempel di dalam card/frame" dengan area kosong hitam di bawah — tidak premium.

## 2. Perubahan yang Dilakukan

File: `resources/views/pages/home.blade.php` (photo column About)

| Elemen | Sebelum (40.6.2) | Sesudah (40.6.3) |
|--------|------------------|------------------|
| Frame | `relative w-full aspect-[4/5] md:aspect-auto md:h-full ...` | `relative w-full overflow-hidden rounded bg-[#1a1a1a] md:h-full` — **tanpa aspect-ratio** |
| Image | `absolute inset-0 w-full h-full object-cover object-center` (selalu absolute) | Mobile: `relative w-full h-auto` (**in-flow**, tinggi mengikuti gambar); Desktop: `md:absolute md:inset-0 md:w-full md:h-full md:object-cover md:object-center` |

**Mobile (<md):** image in-flow `w-full h-auto` → tinggi container = tinggi visual gambar natural. Landscape → pendek & lebar; portrait → tinggi; square → 1:1. **Mustahil ada ruang kosong** karena tidak ada rasio tetap yang lebih tinggi dari gambar.

**Desktop (md+):** image `md:absolute md:inset-0 md:h-full md:object-cover md:object-center` → mengisi penuh kolom setinggi blok teks (sama dengan 40.6.2 desktop yang sudah disetujui). Foto kiri, teks kanan, center alignment — **tidak berubah**.

## 3. Mengapa Sekarang Tidak Ada Empty Frame Lagi

- **Mobile**: tidak ada lagi rasio tetap. Container mengikuti tinggi visual gambar (`h-auto`), sehingga foto dan frame selalu tepat sama tingginya — tidak ada area di bawah foto untuk diisi surface gelap.
- **Desktop**: `object-cover` mengisi penuh kolom (tinggi = tinggi teks) → tidak ada sisa area.
- **Landscape/portrait/square**: mobile menampilkan aspek natural (tanpa crop, tanpa ruang mati); desktop men-crop via object-cover ke kolom (tanpa ruang mati).
- **Surface `bg-[#1a1a1a]`** hanya transien saat load / gambar gagal (fallback `hero-placeholder2.jpeg` ada & terverifikasi). Saat foto tampil, image menutupinya penuh.

## 4. Build

```
✓ npm run build — success (2.71s)
✓ CSS: 117.56 kB (gzip 19.77 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

## 5. Risk Analysis

- **Sistem**: Zero. Tidak ada DB/migration/model/controller/route/logic/CMS.
- **Section lain**: Tidak tersentuh.
- **Desktop**: Identik dengan 40.6.2 desktop yang disetujui (foto kiri, teks kanan, center, tinggi mengikuti layout).
- **Mobile**: berubah dari fixed 4:5 → natural in-flow. Urutan Text→Photo tetap. Ini perubahan yang diminta.
- **Responsive Phase 5**: pola in-flow mobile + absolute desktop adalah standar, aman untuk pengembangan lanjut.

## 6. QA Manual (harus dicek)

1. **Mobile (foto landscape saat ini)**: Foto tampil full-width dengan tinggi natural — TIDAK ada area hitam di bawah foto, tidak ada kesan card.
2. **Mobile — portrait**: upload foto portrait → tampil tinggi natural, tanpa ruang kosong.
3. **Mobile — square**: tampil 1:1 natural.
4. **Desktop (≥1024px)**: foto kiri mengisi kolom setinggi teks, teks kanan center — identik sebelumnya.
5. **Scroll mobile**: urutan Text → Photo tetap.
6. **Load**: tidak ada flash putih (surface gelap transien hanya saat load).

## Documentation

- `.ai/journal/sprint-40.6.3.md`
- `progress.md` — row 40.6.3 + version
- `change-log.md` — v13.0.9
