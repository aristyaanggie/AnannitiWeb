# Sprint 03 — Hero Section (Revision Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Setelah membaca task specification dan menganalisis implementasi Sprint 03 sebelumnya, ditemukan beberapa poin kritis yang perlu revisi:

### Issue Utama

1. **Layout Tidak Sesuai Spec**: Implementasi saat ini menggunakan grid 2 kolom (TEXT | IMAGE) yang **tidak sesuai** dengan Hero Philosophy di task spec.

2. **Photography Tidak Fullscreen**: Image dijadikan elemen layout biasa, bukan background fullscreen yang memenuhi Hero.

3. **Missing Fullscreen Background Implementation**: Task spec sangat jelas: Hero harus menggunakan layering dengan background image absolute yang memenuhi seluruh hero, bukan grid layout.

4. **Visual Reference Tidak Diikuti**: Visual reference (Saint Laurent, Aesop, Apple, Acne Studios, Daniel Wellington) semuanya menggunakan fullscreen background + overlay + content on top. Bukan grid 2 kolom.

---

## 2. Analisis Detail Implementasi Saat Ini

### Current Structure
```html
<section id="hero" class="min-h-[100svh] bg-background">
  <container>
    <grid class="grid-cols-1 lg:grid-cols-2">
      <text-content /> <!-- left -->
      <image-content /> <!-- right -->
    </grid>
  </container>
</section>
```

### Masalah
- ❌ Grid layout (TEXT | IMAGE) bukan fullscreen background
- ❌ Image dijadikan elemen di dalam grid, bukan background
- ❌ Container membatasi width, photography tidak fullscreen
- ❌ Tidak ada overlay layer yang jelas
- ❌ Tidak sesuai dengan visual reference premium brands

### Yang Benar Menurut Spec
```html
<section id="hero" class="min-h-[100svh] relative">
  <!-- Background Image Layer -->
  <img class="absolute inset-0 object-cover" />
  
  <!-- Overlay Layer -->
  <div class="absolute inset-0 bg-black/40-50" />
  
  <!-- Content Layer (on top) -->
  <container class="relative z-10">
    <content />
  </container>
</section>
```

---

## 3. Requirement Dari Task Spec

### Hero Philosophy
- ✅ Hero adalah pengalaman visual pertama (bukan section biasa)
- ✅ Photography menjadi elemen UTAMA (bukan supporting)
- ✅ Typography menjadi elemen KEDUA
- ✅ CTA menjadi elemen KETIGA
- ✅ Animation hanya PELENGKAP

### Layout Rules (Critical)
```
❌ JANGAN:
- Grid 2 kolom (TEXT | IMAGE)
- Image di dalam container
- Image sebagai elemen layout

✅ HARUS:
- Fullscreen background image (absolute)
- Dark overlay 40-50% opacity
- Content di atas image (layering)
- Content positioned di sisi kiri
- Generous whitespace
```

### Hero Height
- `min-h-[100svh]` ✅ (100% small viewport height)
- Navbar tetap di atas Hero ✅

### Background Image
- Memenuhi seluruh Hero ✅
- `object-cover` + `object-center` ✅
- Placeholder lokal ✅
- Mudah diganti dengan aset final ✅

### Overlay
- Opacity 40-50% ✅
- Tujuan: readability + contrast + premium feel ✅
- Bukan gradient berlebihan ✅

### Content Position
- Sisi KIRI ✅
- Vertical alignment sesuai reference ✅
- Tidak di tengah ✅
- Whitespace luas ✅

### Content Elements (Urutan)
1. Eyebrow ✅
2. Heading ✅
3. Description ✅
4. CTA ✅
5. Trust Indicator ✅

### Photography Rules
- Photography adalah Hero ✅
- Bukan dekorasi
- **Mata pertama kali melihat FOTO** ← Critical difference
- Setelah itu heading
- Setelah itu CTA

### Responsive
- Desktop: Komposisi editorial tetap ✅
- Tablet: Premium feel tetap ✅
- Mobile: Fullscreen image tetap, content atas ✅

### Animation
- Fade + Fade Up ✅
- Duration 200-300ms (bukan 600ms) ← Change needed
- **No external library** ✅
- Jangan: AOS, GSAP, Infinite, Floating, Parallax ✅

### Technical Rules
- Tailwind utilities terlebih dahulu ✅
- Hindari custom CSS ✅
- Jangan tambah package ✅
- Jangan abstraction prematur ✅

---

## 4. Perbedaan Kritis: Current vs. Spec

| Aspek | Current | Spec | Status |
|-------|---------|------|--------|
| **Layout** | Grid 2 kolom | Fullscreen background | ❌ Berbeda |
| **Image Role** | Grid element | Background layer | ❌ Berbeda |
| **Positioning** | Content inside container | Content on top overlay | ❌ Berbeda |
| **Photography Fullscreen** | Tidak | Ya | ❌ Berbeda |
| **Overlay** | Tidak ada | 40-50% opacity | ❌ Missing |
| **Layering** | Flat grid | Layered (BG, overlay, content) | ❌ Berbeda |
| **First Visual** | Text + Image together | Photography first | ❌ Berbeda |
| **Animation Duration** | 600ms | 200-300ms | ❌ Berbeda |
| **Visual Reference Match** | Partial | Full (Aesop, Saint Laurent) | ❌ Partial |

---

## 5. Implementation Plan

### Phase 1: Update HTML Structure
```html
<section id="hero" class="min-h-[100svh] relative overflow-hidden">
  <!-- Background Image Layer (Absolute) -->
  <img 
    src="{{ asset('images/hero-placeholder.svg') }}" 
    alt="Premium custom tattoo artwork showcase"
    class="absolute inset-0 w-full h-full object-cover object-center"
    loading="eager"
  />
  
  <!-- Overlay Layer (Absolute) -->
  <div class="absolute inset-0 bg-black/45" />
  
  <!-- Content Layer (Relative/Positioned) -->
  <div class="relative z-10 min-h-[100svh] flex items-center">
    <container class="w-full">
      <!-- Content: Eyebrow, Heading, Description, CTA, Trust -->
    </container>
  </div>
</section>
```

### Phase 2: Adjust CSS
- Ubah animation duration dari 600ms menjadi 200-300ms
- Pastikan overlay visibility optimal
- Test contrast dengan overlay

### Phase 3: Responsive Refinement
- Desktop: Content tetap di sisi kiri, image fullscreen
- Tablet: Transition smooth, content tetap prominent
- Mobile: Content tetap readable, image fullscreen

### Phase 4: Verification
- Visual reference match (Aesop, Saint Laurent)
- First impression dalam 3-5 detik
- Photography dominan
- Premium aesthetic
- No template feel
- Build success
- No warnings

---

## 6. Acceptance Criteria

- ✅ Hero fullscreen (min-h-[100svh])
- ✅ Background image fullscreen (absolute, inset-0)
- ✅ Overlay 40-50% opacity bekerja optimal
- ✅ Content di sisi kiri (tidak di tengah)
- ✅ Photography terlihat pertama kali mata membuka halaman
- ✅ Typography hierarchy jelas
- ✅ CTA prominent
- ✅ Trust indicator subtle
- ✅ Animation ringan (200-300ms)
- ✅ Responsive desktop/tablet/mobile
- ✅ Build berhasil
- ✅ No warnings
- ✅ No errors
- ✅ Terasa seperti luxury brand (bukan SaaS/template)

---

## 7. Key Differences from Current

### Layout Change
```
BEFORE (Current):
┌─────────────────────┐
│  TEXT  │  IMAGE     │  <- Grid 2 kolom
└─────────────────────┘

AFTER (Spec):
┌─────────────────────┐
│ [IMAGE FULLSCREEN]  │  <- Background layer
│ [OVERLAY DARK]      │  <- Overlay layer
│ [CONTENT ON TOP]    │  <- Content layer
│  TEXT               │
└─────────────────────┘
```

### Animation Duration
```
BEFORE: 600ms per element
AFTER:  200-300ms per element
```

### Visual Hierarchy
```
BEFORE: Text + Image equal prominence
AFTER:  Photography dominant (65-70%), Text supporting
```

---

## 8. Implementation Roadmap

1. **Update home.blade.php** - Hero section structure
2. **Adjust app.css** - Animation duration
3. **Verify responsive** - Desktop, tablet, mobile
4. **Test build** - npm run build
5. **Visual check** - Match with reference
6. **QA verification** - All criteria met

---

## 9. Risk Assessment

| Risk | Probability | Impact | Mitigation |
|------|-------------|--------|-----------|
| Animation timing off | Low | Low | Test on multiple devices |
| Overlay too dark/light | Low | Medium | Adjust opacity 40-50% |
| Image not fullscreen | Low | High | Use absolute positioning |
| Layout breaks mobile | Low | Medium | Test responsive thoroughly |
| Build fails | Low | Low | Incremental testing |

---

## 10. Success Metrics

- ✅ Hero terlihat seperti luxury brand (Aesop, Saint Laurent style)
- ✅ Photography menjadi focal point pertama
- ✅ Typography supporting role jelas
- ✅ First impression: "Premium, professional, trustworthy"
- ✅ No SaaS/template feel
- ✅ Build: Success, no errors, no warnings
- ✅ Responsive: All breakpoints working

---

**Status**: Analysis Complete ✅
**Next Step**: Implementation

