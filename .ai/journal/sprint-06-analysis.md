# Sprint 06 — Tattoo Supply Preview (Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Section Tattoo Supply Preview akan menjadi **preview/category introduction** untuk halaman Shop. Bukan e-commerce, hanya pintu masuk dengan 4 kategori utama.

**Key Points:**
- Section ini preview, bukan full shop
- 4 kategori: Tattoo Machine, Needles, Ink, Accessories
- Layout: Editorial, simple, banyak whitespace
- Card style: konsisten dengan website (border tipis, radius kecil)
- Hover: Image zoom, border lebih terang
- CTA: "Explore Shop" menuju /shop

---

## 2. Current Implementation

### Tattoo Supply Section Placeholder
```blade
<section id="supply">
  <x-layout.section spacing="lg">
    <x-layout.container>
      <x-layout.section-title title="Tattoo Supply" alignment="center" />
      <div class="bg-border rounded-md p-8 text-center text-text-secondary">
        <p>Placeholder untuk tattoo supply section</p>
      </div>
    </x-layout.container>
  </x-layout.section>
</section>
```

**What Needs to Change:**
- Replace placeholder dengan 4 category cards
- Add category images (asset lokal)
- Add category name dan description
- Add CTA button "Explore Shop"
- Implement responsive grid (4 cards desktop, 2x2 tablet, 1 mobile)
- Add hover effects (image zoom, border light)

---

## 3. Category Content

### Category 1: Tattoo Machine
```
Image: machine.jpeg
Name: Tattoo Machine
Description: Professional tattoo machines for every style and technique.
```

### Category 2: Needles
```
Image: needles.jpeg
Name: Needles
Description: High-quality disposable needles from trusted brands.
```

### Category 3: Ink
```
Image: ink.jpeg
Name: Ink
Description: Premium tattoo inks for vibrant, lasting results.
```

### Category 4: Accessories
```
Image: accessories.jpeg
Name: Accessories
Description: Essential tools and supplies for tattoo artists.
```

---

## 4. Layout Design

### Structure
```
Section Title (centered)
↓
Short Description (centered, max-width)
↓
Category Grid (4 columns desktop, 2x2 tablet, 1 mobile)
↓
CTA Button "Explore Shop" (centered, below grid)
```

### Grid Implementation
```blade
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
  <!-- 4 Category Cards -->
</div>
```

---

## 5. Card Design

### Card Structure
```
┌──────────────────────────┐
│                          │
│   Category Image         │  ← Hover: Zoom 1.05
│                          │
├──────────────────────────┤
│                          │
│   Category Name          │  ← h4, text-text-primary
│   Description            │  ← text-text-secondary
│                          │
└──────────────────────────┘
```

### Card Styling
- Border: 1px, text-muted (#999999)
- Radius: rounded (4px)
- Background: bg-surface (#ffffff)
- Hover: border-text-primary (slightly darker)
- Padding: p-6 (24px)
- Image: rounded-b (bottom rounded)

### Hover Effects
- Image: scale-105 (zoom)
- Border: border-text-primary (slightly darker)
- Transition: 250ms ease-out
- No shadow, no scale card

---

## 6. Image Management

### Asset Path
```
public/images/shop/
├── machine.jpeg
├── needles.jpeg
├── ink.jpeg
└── accessories.jpeg
```

### Image Implementation
```blade
<img 
  src="{{ asset('images/shop/machine.jpeg') }}"
  alt="Tattoo Machine"
  class="w-full h-48 object-cover rounded-b transition-transform duration-250 group-hover:scale-105"
/>
```

### Image Size
- Height: h-48 (192px)
- Width: w-full (responsive)
- Fit: object-cover (crop, no distortion)
- Bottom radius: rounded-b (smooth)

---

## 7. CTA Button

### Button Implementation
```blade
<x-ui.button variant="primary" size="lg" class="mt-12">
  Explore Shop
</x-ui.button>
```

### Link
- href: `/shop` (route)

### Position
- Below grid
- Centered (text-center wrapper)

---

## 8. Accessibility

- [x] Semantic HTML (`<section>`, `<img>`, `<h4>`)
- [x] Alt text untuk images (descriptive)
- [x] Keyboard navigation (natural tab order)
- [x] Focus states (buttons have focus rings)
- [x] Color contrast (black on white: 12.63:1 = WCAG AAA)

---

## 9. Responsive Breakpoints

### Desktop (md: 1024px+)
- 4 columns (25% each)
- Grid: md:grid-cols-4
- Gap: md:gap-8 (32px)

### Tablet (sm: 640px - 1023px)
- 2 columns (50% each)
- Grid: sm:grid-cols-2
- Gap: sm:gap-6 (24px)

### Mobile (< 640px)
- 1 column (100%)
- Grid: grid-cols-1
- Gap: gap-6 (24px)

---

## 10. Implementation Checklist

### Phase 1: Setup ✅
- [x] Create public/images/shop/ folder

### Phase 2: Create Placeholder Images
- [ ] Create machine.jpeg (1200x800px landscape)
- [ ] Create needles.jpeg (1200x800px landscape)
- [ ] Create ink.jpeg (1200x800px landscape)
- [ ] Create accessories.jpeg (1200x800px landscape)

### Phase 3: HTML Structure
- [ ] Replace placeholder dengan category grid
- [ ] Add 4 category cards
- [ ] Add images, names, descriptions
- [ ] Add CTA button

### Phase 4: Styling & Responsive
- [ ] Apply Tailwind utilities
- [ ] Responsive grid (1 → 2 → 4 columns)
- [ ] Card styling (border, radius, padding)
- [ ] Hover effects (image zoom, border change)

### Phase 5: Verification
- [ ] Build check
- [ ] Responsive testing
- [ ] Self-review

---

**Analysis Status**: ✅ COMPLETE

**Ready for Implementation**: YES

**Next Step**: Implement Tattoo Supply Preview section dengan 4 category cards

