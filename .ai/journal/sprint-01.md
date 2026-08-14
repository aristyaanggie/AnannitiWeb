# Sprint 01 - Design Foundation Journal

Dokumentasi perjalanan Sprint 01: Design Foundation.

## Objective

Membangun fondasi UI yang akan digunakan oleh seluruh halaman website.

Sprint ini membangun sistem desain yang reusable dan scalable, bukan membuat tampilan website.

## Hasil Implementasi

### 1. Typography Setup ✅

**Fonts Imported:**
- Playfair Display (weights: 400, 500, 600, 700, 800, 900) - untuk headings
- Inter (weights: 300, 400, 500, 600, 700) - untuk body text

**Heading Hierarchy:**
- H1: text-5xl → text-6xl (responsive)
- H2: text-4xl → text-5xl
- H3: text-2xl → text-3xl
- H4: text-xl → text-2xl
- H5: text-lg → text-xl
- H6: text-base

**Line Heights:**
- Headings: 1.2
- Body: 1.6
- Implementation menggunakan Tailwind utilities + CSS custom properties

### 2. Design Token System ✅

**Color Tokens (CSS Custom Properties):**
- Primary: #1a1a1a (dark color untuk buttons dan primary actions)
- Primary Light: #333333 (hover state)
- Secondary: #8b7355 (warm brown untuk secondary actions)
- Secondary Light: #a0826d (hover state)
- Background: #fafafa (page background)
- Surface: #ffffff (card background)
- Border: #e5e5e5 (borders)
- Text Primary: #1a1a1a
- Text Secondary: #666666
- Text Muted: #999999
- Status colors: success (#10b981), error (#ef4444), warning (#f59e0b), info (#3b82f6)

**Custom Properties:**
Semua tokens disimpan sebagai CSS custom properties di :root untuk easy reusability.

### 3. Base CSS & Global Styling ✅

**Global Styles:**
- HTML: smooth scrolling, font smoothing
- Body: typography defaults, background color
- Headings: font family, weight, line height
- Links: color transitions, focus states
- Images: max-width, auto height
- Buttons, inputs, textareas: font inheritance, focus states, disabled states
- Selection: primary color background

**Focus States:**
Semua interactive elements memiliki ring-2 ring-offset-2 focus state untuk accessibility.

### 4. Main Layout ✅

**File:** `resources/views/layouts/app.blade.php`

**Features:**
- HTML5 semantic structure
- Meta tags (charset, viewport, description)
- Vite asset linking (@vite directive)
- Slot untuk page content
- Flex layout untuk full-height pages
- Background color dari design token

### 5. Reusable Layout Components ✅

#### Container Component
- **File:** `components/layout/container.blade.php`
- Max-width: 1200px (max-w-6xl)
- Responsive padding: px-4 (mobile) → px-12 (desktop)
- Mobile-first approach
- Accepts additional classes

#### Section Component
- **File:** `components/layout/section.blade.php`
- Spacing variants: sm, md, lg
- Default: md (py-12 → py-16 responsive)
- Maintains consistent vertical rhythm

#### Section Title Component
- **File:** `components/layout/section-title.blade.php`
- Title prop (required)
- Subtitle prop (optional)
- Alignment options: left, center
- Size variants: sm, md, lg
- Optional slot untuk additional content

### 6. UI Components ✅

#### Button Component
- **File:** `components/ui/button.blade.php`
- Variants: primary (dark), secondary (brown)
- Sizes: sm, md, lg
- Disabled state support
- Type support: button, submit, reset
- Focus states dengan ring styling
- Hover transitions
- Props: variant, size, disabled, type, class

#### Link Component
- **File:** `components/ui/link.blade.php`
- Styled link dengan brand colors
- Hover state transitions
- Focus states dengan ring styling
- External link support (target="_blank", rel="noopener noreferrer")
- Props: href, external, class

### 7. Configuration File ✅

**File:** `config/ananniti.php`

**Sections:**
- Studio info (name, tagline, description)
- Contact (email, phone, whatsapp, address, city, postal_code)
- Social media (instagram, facebook, tiktok, youtube)
- Business hours (Monday-Sunday)
- Maps (google_maps_url, latitude, longitude)
- Payment (currency, currency_symbol)

**Status:** Semua values menggunakan [TO BE DEFINED] placeholders.

## File Baru

1. `resources/views/layouts/app.blade.php`
2. `resources/views/components/layout/container.blade.php`
3. `resources/views/components/layout/section.blade.php`
4. `resources/views/components/layout/section-title.blade.php`
5. `resources/views/components/ui/button.blade.php`
6. `resources/views/components/ui/link.blade.php`
7. `config/ananniti.php`
8. `.ai/todos/01-design-foundation.md`

**Total:** 8 files baru

## File yang Diubah

1. `resources/css/app.css` - Updated dengan:
   - Google Fonts import
   - CSS custom properties untuk design tokens
   - Global styling untuk semua elemen
   - Typography system
   - Base component styles
   - Focus states dan accessibility

**Total:** 1 file dimodifikasi

## Hasil Verifikasi

### Laravel ✅
```
Laravel Framework 12.63.0
Status: Running normal
```

### Vite ✅
```
Build successful
Time: 3.38s
Modules transformed: 55
CSS: 48.52 kB (gzip 10.42 kB)
JS: 46.16 kB (gzip 17.79 kB)
```

### Tailwind CSS ✅
```
Tailwind v4 dengan @theme directive
Build berhasil tanpa error
Semua utilities available
Custom properties terintegrasi
```

### Build Status ✅
```
✓ Build successful
✓ No errors
✓ No warnings
✓ Assets generated correctly
✓ manifest.json created
```

## Struktur Component

```
components/
├── layout/
│   ├── container.blade.php
│   ├── section.blade.php
│   └── section-title.blade.php
└── ui/
    ├── button.blade.php
    └── link.blade.php

layouts/
└── app.blade.php
```

## Design Token Summary

**Color System:**
- 14 color tokens (primary, secondary, neutral, status)
- Semua disimpan sebagai CSS custom properties
- Easy to update centrally
- Accessible dari CSS, Blade, dan component props

**Spacing:**
Menggunakan Tailwind default spacing scale:
- xs-4xl (dari 0.25rem hingga 5rem)
- Responsive variants (sm:, md:, lg:, xl:, 2xl:)

**Typography:**
- 2 font families (Playfair Display, Inter)
- Responsive heading sizes
- Consistent line heights
- Professional typography hierarchy

**Transitions:**
- Duration: 300ms (standard Tailwind)
- Easing: ease-out (untuk entering), ease-in (untuk exiting)
- Properties: color, background-color, border-color, transform, opacity

## Component Usage Examples

```blade
<!-- Layout -->
<x-layout-container>
  <x-layout-section spacing="md">
    <x-layout-section-title title="Portfolio" />
  </x-layout-section>
</x-layout-container>

<!-- UI Components -->
<x-ui-button variant="primary" size="lg">
  Book Now
</x-ui-button>

<x-ui-link href="/portfolio" external>
  View Our Work
</x-ui-link>
```

## Rekomendasi

1. **Color Refinement**: Warna yang dipilih sudah premium namun masih perlu validasi dengan stakeholder
2. **Additional Components**: Untuk Sprint berikutnya, pertimbangkan untuk membuat:
   - Input component dengan validation states
   - Card component untuk content blocks
   - Badge component untuk status indicators
3. **Typography Scale**: Font size scale sudah sesuai dokumentasi, namun perlu testing di device yang berbeda
4. **Accessibility**: Semua components sudah memiliki focus states, perlu testing dengan screen readers

## Catatan untuk Sprint Berikutnya

- Design tokens sudah solid, tidak perlu refactor di sprint berikutnya
- Component library sudah siap untuk digunakan di semua halaman
- Tidak ada hardcode colors atau spacing di components dasar
- Config file sudah ready untuk diisi dengan data asli
- Build process berjalan smooth, tidak ada performance issues
- Typography sudah terintegrasi dengan Google Fonts

---

**Sprint Status**: ✅ COMPLETED

**Date Completed**: 2026-07-10

**Next Sprint**: Sprint 02 - Landing Page & Hero Section [Scheduled: TBD]
