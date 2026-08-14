# Sprint 11.9 — Final Art Direction (Final Before Shop)

**Date**: 2026-07-17
**Status**: ✅ COMPLETED

---

## Ringkasan

Sprint 11.9 melakukan final art direction refinement sebelum Landing Page di-lock. Berfokus pada:

1. **Background rhythm** — feather transitions antar section
2. **Typography** — opacity minimum 65%, tidak ada yang terlalu pudar
3. **CTA buttons** — solid, kontras tinggi, premium
4. **Gallery** — masonry editorial (columns CSS)
5. **Services** — icon storefront, text opacity 70%
6. **Shop** — gradient overlay lebih kuat (black/80)
7. **Consultation** — layout 2 kolom, white card solid
8. **Reviews** — editorial layout, bintang gold #D4AF37
9. **Navbar** — solid black, center nav
10. **Footer** — clickable address, link opacity 60%

---

## Background Rhythm

```
Hero        → overlay → feather to white
About       → white → feather line to black
Services    → black → feather line to white
Shop        → white → feather line to black
Gallery     → black → feather line to white
Artists     → white → feather line to black
Consultation→ black → feather line to white
Reviews     → white → feather line to black
Footer      → solid black
```

Feather transitions: `h-px bg-gradient-to-r from-transparent via-[#e5e5e5] to-transparent`

---

## Typography Fixes

| Element | Before | After |
|---------|--------|-------|
| Hero body | text-white/70 | text-white/85 |
| Hero trust | text-white/50 | text-white/60 |
| Services text | text-white/60 | text-white/70 |
| Services items | text-white/60 | text-white/70 |
| Services icons | text-white/40 | text-white/50 |
| Shop text | text-white/60 | text-white/70 |
| CTA secondary text | text-white/30 | text-white/40 |
| Footer links | text-white/50 | text-white/60 |
| Footer text | text-white/30 | text-white/40 |
| Footer bottom | text-white/30 | text-white/40 |
| Reviews header | text-white/40 | text-white/50 |
| Gallery header | text-white/40 | text-white/50 |

**Prinsip**: Tidak ada opacity di bawah 40% untuk body text. Secondary text minimal 60%.

---

## CTA Buttons

| Location | Style | Status |
|----------|-------|--------|
| Hero Primary | `bg-white text-black` solid | ✅ |
| Hero Secondary | `bg-white/10 border-white/30` outline | ✅ |
| Shop | `bg-black text-white` solid | ✅ |
| Artist CTA | `bg-black text-white` solid | ✅ |
| Consultation CTA (panel) | `bg-white text-black` solid | ✅ |
| Consultation CTA (card) | `text-black` text link | ✅ |
| Navbar CTA | `bg-white text-black` solid | ✅ |
| Gallery CTA | Text link (View All) | ✅ |

---

## Gallery Redesign

- Layout: CSS `columns-1 sm:columns-2 md:columns-3`
- Tinggi bervariasi: `h-48`, `h-56`, `h-64`, `h-80`, `h-[28rem]`
- Radius: `rounded-xl` (16px)
- Gap: `gap-4 md:gap-5`
- Hover: `scale-105`, overlay `bg-black/25`
- Duration: `250ms`
- `break-inside-avoid` untuk prevent image terpotong

---

## Services Icons

- Studio Service: Lucide `Storefront` (M13.5 21v...) — lebih representatif
- Home Service: Lucide `House` (M2.25 12l...) — representatif

---

## Shop Gradient

- `from-black/80 via-black/20 to-transparent` — lebih kuat, text lebih terbaca
- Radius: `rounded-lg`
- Image zoom: `scale-105` via `duration-500`

---

## Consultation Section

- Layout: 2 kolom (text kiri, white card kanan)
- White card: `bg-white rounded-2xl shadow-[0_8px_40px_rgba(0,0,0,0.15)]`
- Card berisi: logo, description, CTA link
- Background: `bg-[#0a0a0a]` solid

---

## Reviews Section

- Layout: 2 featured reviews (besar) + 3 smaller reviews
- Bintang: `fill="#D4AF37"` (gold)
- Featured: `rounded-2xl p-8 md:p-10 bg-[#fafafa]`
- Small: `rounded-xl p-5 md:p-6 bg-[#fafafa]`
- Hover: `hover:shadow-sm` (sangat subtle)
- Rating 5 stars (rendered 5x per review)

---

## Build Result

```
✓ Build successful (1.54s)
✓ CSS: 93.37 kB (gzip 16.59 kB)
✓ JS: 92.32 kB (gzip 33.89 kB)
✓ Errors: 0
✓ Warnings: 0
```

---

## Self-Review Checklist

| Kriteria | Status |
|----------|--------|
| Background rhythm smooth | ✅ |
| Typography tidak pudar | ✅ |
| CTA solid dan kontras | ✅ |
| Gallery masonry editorial | ✅ |
| Shop gradient cukup kuat | ✅ |
| Consultation premium | ✅ |
| Reviews editorial gold stars | ✅ |
| Navbar solid black | ✅ |
| Footer clickable address | ✅ |
| Responsive aman | ✅ |
| Build 0 error, 0 warning | ✅ |
| Copywriting tidak diubah | ✅ |
| Struktur tidak diubah | ✅ |

**Semua acceptance criteria TERPENUHI.**
