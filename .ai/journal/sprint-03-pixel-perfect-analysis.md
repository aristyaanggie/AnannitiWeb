# Sprint 03 — Hero Section (Pixel Perfect Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Saya telah melakukan analisis mendalam terhadap:
- Visual reference yang diberikan
- Dokumentasi design system di folder `.ai/`
- Implementasi saat ini
- Reusable components yang tersedia
- Typography dan spacing guidelines

**Kesimpulan**: Implementasi saat ini sudah **90% sesuai** dengan visual reference, tetapi perlu dilakukan **fine-tuning pixel-perfect** untuk mencapai kesesuaian visual 100%.

---

## 2. Analisis Visual Reference

### Visual Reference yang Diberikan
```
NAVBAR (floating, dark)
────────────────────────
ESTABLISHED MMXXIV
ANANNITI TATTOO STUDIO

Description...

[ CTA Primary ]  [ CTA Secondary ]

────────────────────────
Background Photography (fullscreen)
Overlay 45%
Photography fokus utama
Content di kiri
Whitespace besar
```

### Key Characteristics
✅ **Navbar**: Fixed/sticky, dark background, minimal
✅ **Hero**: Fullscreen (min-h-[100svh])
✅ **Photography**: Dominant, fullscreen background
✅ **Overlay**: Dark (40-50% opacity)
✅ **Content**: Left-positioned, white typography
✅ **CTA**: Two buttons (primary + secondary), horizontal desktop
✅ **Whitespace**: Generous, right side empty
✅ **Animation**: Minimal (fade/fade-up, 200-300ms)
✅ **Color**: Black/White/Gray only (NO brown, gold, beige, accent colors)

---

## 3. Analisis Implementasi Saat Ini

### Structure Analysis ✅

**Current Hero HTML:**
```blade
<section id="hero" class="min-h-[100svh] relative overflow-hidden">
  <!-- Layer 1: Background Image -->
  <img src="{{ asset('images/hero-placeholder.jpeg') }}" 
       alt="Premium custom tattoo artwork showcase"
       class="absolute inset-0 w-full h-full object-cover object-center"
       loading="eager" />
  
  <!-- Layer 2: Overlay -->
  <div class="absolute inset-0 bg-black/45" />
  
  <!-- Layer 3: Content -->
  <div class="relative z-10 min-h-[100svh] flex items-center pt-16 md:pt-20">
    <x-layout.container class="w-full">
      <div class="max-w-2xl">
        <!-- Content here -->
      </div>
    </x-layout.container>
  </div>
</section>
```

**Assessment**: ✅ Structure sesuai spec

### Issues Identified

#### 1. **Image Path Issue**
- Current: `asset('images/hero-placeholder.jpeg')`
- Required: `asset('images/hero/hero.jpg')`
- **Action**: Update path ke folder yang sudah dibuat

#### 2. **Button Styling**
- Current: Using design token colors (primary/secondary)
- Problem: Design tokens are brown/beige (violates color restriction)
- Required: Black/White buttons only
- **Action**: Update button styling to match color restriction

#### 3. **Typography Sizing**
- Current: `text-4xl md:text-5xl lg:text-6xl` for heading
- Assessment: Ukuran sudah sesuai visual reference
- Status: ✅ OK

#### 4. **Spacing**
- Current: `mb-4`, `mb-6`, `mb-8`, `mb-12`
- Assessment: Spacing sudah sesuai dengan spacing scale
- Status: ✅ OK

#### 5. **Color Palette**
- Issue: Design tokens menggunakan brown (#8b7355) dan secondary colors
- Task Spec: "Website hanya menggunakan warna: Hitam, Putih, Abu"
- Current: ❌ Brown colors digunakan
- **Action**: Update button colors ke black/white

#### 6. **Animation Duration**
- Current: 300ms per element (cascade 0-400ms total)
- Required: 200-300ms
- Assessment: ✅ Already optimized

---

## 4. Color Restriction Analysis

### Design System Says
```
Dilarang menggunakan:
❌ Brown
❌ Gold
❌ Beige
❌ Cream
❌ Blue
❌ Red
❌ Green
❌ Accent Color
❌ Gradient Color

Hanya gunakan:
✅ Black
✅ White
✅ Neutral Gray
```

### Current Implementation Issue
Current color tokens:
- `--color-primary: #1a1a1a` (black, OK)
- `--color-secondary: #8b7355` (BROWN, NOT OK)
- `--color-surface: #ffffff` (white, OK)

**Problem**: Button secondary variant menggunakan brown color yang violates design system.

**Solution**: Update button styling to use black/white only:
- Primary Button: Black background, white text
- Secondary Button: White background, black text (or black border, white background)

---

## 5. Button Component Analysis

### Current Button Component
```blade
@props(['variant' => 'primary', 'size' => 'md', ...])

$variantClasses = match($variant) {
    'primary' => 'bg-primary text-surface hover:bg-primary-light',
    'secondary' => 'bg-secondary text-surface hover:bg-secondary-light',
    default => 'bg-primary text-surface hover:bg-primary-light',
};
```

**Issue**: Uses design token colors (brown secondary)

### Required for Pixel Perfect
For Hero buttons:
- **Primary**: `bg-black text-white hover:bg-opacity-90`
- **Secondary**: `bg-white text-black hover:bg-opacity-90` or `bg-transparent border-2 border-white text-white`

**Options**:
1. Update button component to support `black` and `white` variants
2. Use inline classes in hero for button overrides
3. Create new button styling inline

**Recommendation**: Option 2 (inline classes) - cleaner, component stays generic

---

## 6. Visual Reference Pixel Alignment

### Navbar Alignment ✅
- Position: Fixed, top, z-50
- Background: Dark (var(--color-navbar-bg) = #0a0a0a)
- Height: h-16 md:h-20
- Content: Logo + Brand + Nav links + CTA
- Status: ✅ Matches reference

### Hero Section Alignment ✅
- Height: min-h-[100svh]
- Background: Fullscreen image (absolute inset-0)
- Overlay: Dark 45% opacity (bg-black/45)
- Content: Left-positioned (max-w-2xl)
- Status: ✅ Matches reference

### Typography Hierarchy ✅
1. Eyebrow: `text-xs uppercase tracking-widest text-white/90`
2. Heading: `text-4xl md:text-5xl lg:text-6xl font-bold text-white`
3. Description: `text-lg md:text-xl leading-relaxed text-white/85`
4. CTA: Two buttons
5. Trust: `text-sm text-white/80`
- Status: ✅ Matches reference

### CTA Button Alignment
- Current: Using x-ui.button component with variant="primary" and variant="secondary"
- Required: Black/White buttons per color restriction
- Action Needed: Update button classes

### Spacing Alignment ✅
- mb-4: 1rem (16px) - OK
- mb-6: 1.5rem (24px) - OK
- mb-8: 2rem (32px) - OK
- mb-12: 3rem (48px) - OK
- All spacing multiples of 4px (Tailwind scale)
- Status: ✅ Matches reference

### Responsive Alignment ✅
- Desktop: Full layout, buttons horizontal
- Tablet: Proportional scaling maintained
- Mobile: Stack layout, buttons full-width (flex-col sm:flex-row)
- Status: ✅ Matches reference

---

## 7. Technical Requirements Checklist

- [x] Navbar tidak berubah (tetap floating, dark)
- [x] Hero fullscreen (min-h-[100svh])
- [x] Background image fullscreen (absolute inset-0, object-cover)
- [x] Overlay 45% opacity (bg-black/45)
- [x] Content left-positioned (max-w-2xl)
- [x] Typography hierarchy clear
- [x] CTA buttons two buttons (primary + secondary)
- [x] Responsive (desktop, tablet, mobile)
- [x] Animation minimal (300ms cascade)
- [x] Accessibility (semantic HTML, alt text, keyboard nav)
- [ ] Image path updated to public/images/hero/hero.jpg
- [ ] Button colors updated to black/white (color restriction)
- [ ] Build successful
- [ ] Zero errors, zero warnings

---

## 8. Required Changes for Pixel Perfect

### Change 1: Update Image Path
**File**: `resources/views/pages/home.blade.php`
**Line**: 10
**Current**: `src="{{ asset('images/hero-placeholder.jpeg') }}"`
**New**: `src="{{ asset('images/hero/hero.jpg') }}"`
**Reason**: Task spec requires using `public/images/hero/` folder

### Change 2: Update Button Styling (Primary)
**File**: `resources/views/pages/home.blade.php`
**Line**: 41-49
**Current**: `variant="primary"` (uses design token - brown color)
**New**: Add inline class for black/white styling
**Reason**: Color restriction - only black/white/gray allowed

### Change 3: Update Button Styling (Secondary)
**File**: `resources/views/pages/home.blade.php`
**Line**: 51-58
**Current**: `variant="secondary"` (uses design token - brown color)
**New**: Add inline class for white/black styling
**Reason**: Color restriction - only black/white/gray allowed

---

## 9. Implementation Plan

### Phase 1: Folder & Image Setup ✅
- [x] Create `public/images/hero/` folder
- [x] Create placeholder `hero.jpg`

### Phase 2: Update Image Path
- [ ] Update image src in home.blade.php

### Phase 3: Update Button Styling
- [ ] Override button classes for black/white colors
- [ ] Ensure hover states work correctly
- [ ] Maintain accessibility (focus states, etc.)

### Phase 4: Verification
- [ ] Build check (npm run build)
- [ ] Visual comparison with reference
- [ ] Responsive testing
- [ ] Accessibility check
- [ ] Self-review documentation

---

## 10. Pixel Perfect Comparison Matrix

| Aspect | Visual Ref | Current | Status | Action |
|--------|-----------|---------|--------|--------|
| Layout | Fullscreen layering | Fullscreen layering | ✅ | None |
| Background | Fullscreen image | Fullscreen image | ✅ | Update path |
| Overlay | 45% dark | 45% dark | ✅ | None |
| Content Position | Left | Left | ✅ | None |
| Navbar | Fixed dark | Fixed dark | ✅ | None |
| Heading Size | Large (5xl-6xl) | Large (5xl-6xl) | ✅ | None |
| Typography | White/opacity | White/opacity | ✅ | None |
| CTA Buttons | Black/White | Brown/colors | ❌ | Update styling |
| Spacing | Generous | Generous | ✅ | None |
| Animation | 300ms fade | 300ms fade | ✅ | None |
| Responsive | Maintained | Maintained | ✅ | None |
| Color Palette | Black/White/Gray | With brown | ❌ | Update buttons |

---

## 11. Self-Review Criteria (Pre-Implementation)

Will verify after implementation:
- [ ] Hero layout identical to visual reference
- [ ] Background image path uses public/images/hero/hero.jpg
- [ ] Button colors black/white (color restriction met)
- [ ] All text white/opacity on dark overlay
- [ ] Navbar unchanged, floating above hero
- [ ] Responsive behavior maintained
- [ ] Animation cascade 300ms
- [ ] Accessibility intact (semantic HTML, alt text, keyboard nav)
- [ ] Build successful (zero errors, zero warnings)
- [ ] No template appearance
- [ ] Premium aesthetic maintained

---

## 12. Success Criteria

✅ Hero sesuai visual reference (pixel-perfect alignment)
✅ Responsive desktop/tablet/mobile
✅ Build berhasil (npm run build)
✅ Zero errors, zero warnings
✅ No duplicate code
✅ Hero mudah diganti background image (public/images/hero/hero.jpg)
✅ Color palette: Black/White/Gray only (no brown/gold/beige)
✅ Semantic HTML, accessibility WCAG AA

---

**Analysis Status**: ✅ COMPLETE

**Ready for Implementation**: YES

**Next Step**: Execute pixel-perfect changes

