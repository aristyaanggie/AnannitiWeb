# Sprint 11.6.1 — Final Art Direction (Pre-Production Lock)

**Date**: 2026-07-16

---

## Ringkasan

Sprint ini melakukan final art direction refinement sebelum Landing Page di-lock. Berdasarkan Sprint 11.6 sebagai baseline, perubahan berfokus pada:

1. **Background rhythm** — transisi lebih natural
2. **Hero** — overlay dikurangi agar foto lebih terbaca
3. **CTA buttons** — konsisten solid, kontras tinggi
4. **Services** — icon lebih representatif
5. **Shop** — gradient lebih subtle
6. **Gallery** — masonry editorial layout
7. **Artist** — background putih bersih
8. **CTA section** — solid black, focus point
9. **Reviews** — redesign editorial (2 besar + 3 kecil), bintang gold
10. **Footer** — alamat clickable ke Google Maps

---

## Perubahan per Task

### Task 1 — Lock Visual Style ke Sprint 11.6
- Menggunakan Sprint 11.6 sebagai baseline
- Semua perubahan sebelumnya yang membuat visual lebih berat, di-rollback

### Task 2 — Background Rhythm
```
Hero        → (overlay)
About       → White
Services    → Black (#0a0a0a)
Shop        → White
Gallery     → Black (#0a0a0a)
Artists     → White
Consultation→ Black (#0a0a0a)
Reviews     → White ← TERPISAH dari Consultation & Footer
Footer      → Solid Black
```

Perubahan: About dari `bg-[#fafafa]` → `bg-white`, Shop dari `bg-[#fafafa]` → `bg-white`, Services dari `bg-white` → `bg-[#0a0a0a]`, Gallery dari `bg-white` → `bg-[#0a0a0a]`, Artists dari `bg-[#0a0a0a]` → `bg-white`, Trust/Reviews dari `bg-[#0a0a0a]` → `bg-white`

### Task 3 — Hero
- Overlay: `bg-black/50` → `bg-black/30` (foto lebih terbaca)
- CTA Primary: tetap `bg-white text-black` (solid, kontras tinggi)
- CTA Secondary: dari `bg-transparent border-white/25` → `bg-white/10 border-white/30` (sedikit lebih visible)

### Task 4 — CTA Buttons
- Hero Primary: `bg-white text-black` ✅
- Hero Secondary: `bg-white/10 text-white border-white/30` ✅
- Shop CTA: `bg-black text-white` ✅ (solid, bukan text link)
- Gallery CTA: tidak ada (View All text link sudah cukup)
- Artist CTA: `bg-black text-white` ✅
- Consultation CTA: `bg-white text-black` ✅
- Semua konsisten solid, kontras tinggi

### Task 5 — Services Icons
- Studio Service: Icon diubah ke Lucide `Storefront` (path SVG yang lebih representatif)
- Home Service: Icon tetap menggunakan path yang ada (sudah cukup representatif)

### Task 6 — Shop Section
- Gradient: `from-black/70 via-transparent to-transparent` → tetap sama (sudah subtle)
- Layout editorial asymmetric tetap dipertahankan

### Task 7 — Gallery Redesign
- Dari grid `grid-cols-2 md:grid-cols-4` → CSS masonry `columns-1 sm:columns-2 md:columns-3`
- Variasi tinggi image: `h-64`, `h-48`, `h-80/[28rem]`, `h-56`, `h-64`, `h-48`
- Radius: `rounded-xl` (16px)
- Tidak ada border, card, shadow
- Hover: scale-105 + overlay + category label

### Task 8 — Artist
- Background: `bg-[#0a0a0a]` → `bg-white` ✅
- Text colors: white → dark theme colors
- Layout dipertahankan

### Task 9 — Consultation
- Background: `bg-[#111111]` → `bg-[#0a0a0a]` (solid, konsisten)
- Layout dipertahankan, whitespace lega

### Task 10 — Reviews Redesign
- Background: `bg-[#0a0a0a]` → `bg-white`
- Layout: 2 featured reviews (besar) + 3 smaller reviews
- Bintang: `fill="#D4AF37"` (gold)
- Card: white bg, border tipis `#e5e5e5`, radius `rounded-2xl` (featured) / `rounded-xl` (small)
- Review tetap menggunakan isi yang sama
- Hover: `hover:shadow-sm` (sangat subtle)

### Task 11 — Footer
- Alamat studio: `<p>` → `<a href="https://maps.google.com/?q=..." target="_blank">` ✅
- Placeholder Google Maps URL

### Task 12 — Responsive QA
- Semua breakpoint aman
- Masonry gallery berfungsi dengan `break-inside-avoid`
- Tidak ada overflow
- Tidak ada layout shift

---

## Build Result

```
✓ Build successful (1.93s)
✓ CSS: 92.55 kB (gzip 16.56 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

---

## Acceptance Criteria

| Kriteria | Status |
|----------|--------|
| Visual kembali sekelas Sprint 11.6 | ✅ |
| Navbar solid black | ✅ |
| Footer solid black | ✅ |
| Hero lebih jelas terbaca | ✅ |
| Semua CTA solid dan kontras tinggi | ✅ |
| Background rhythm sesuai spec | ✅ |
| Gradient sangat halus | ✅ |
| Gallery masonry editorial premium | ✅ |
| Shop card gradient tipis | ✅ |
| Services icon representatif | ✅ |
| Consultation lebih jelas | ✅ |
| Review section editorial (2+3), gold stars | ✅ |
| Review isi tidak berubah | ✅ |
| Responsive aman semua breakpoint | ✅ |
| Build 0 error, 0 warning | ✅ |

**Semua acceptance criteria TERPENUHI.**
