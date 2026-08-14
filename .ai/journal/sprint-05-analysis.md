# Sprint 05 — Services Section (Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Setelah membaca dokumentasi dan menganalisis struktur project, saya telah mengidentifikasi requirements untuk Services section. Section ini bertujuan menjelaskan layanan utama Ananniti Tattoo dengan tetap mempertahankan filosofi editorial dan premium aesthetic.

**Key Insights:**
- Services bukan feature list atau card grid (tidak SaaS style)
- Layout harus editorial dengan banyak whitespace
- Photography menjadi supporting element (bukan dominan seperti Hero/About)
- Services merupakan jawaban: "Layanan apa saja yang tersedia?"
- Tidak hard-selling, tetapi memperlihatkan kemampuan studio
- Color palette: Black/White/Gray only
- Typography: Playfair Display + Inter (consistent dengan Hero/About)

---

## 2. Current Services Placeholder

```blade
<section id="services">
  <x-layout.section spacing="lg" class="bg-surface">
    <x-layout.container>
      <x-layout.section-title title="Services" alignment="center" />
      <div class="bg-border rounded-md p-8 text-center text-text-secondary">
        <p>Placeholder untuk services section</p>
      </div>
    </x-layout.container>
  </x-layout.section>
</section>
```

**What Needs to Change:**
- Remove placeholder content (bg-border div)
- Add section title with subtitle (using x-layout.section-title)
- Add services list (4 services minimum)
- Add supporting image (services.jpeg)
- Implement editorial layout
- Add CTA button at end
- Implement responsive design
- Add animation cascade

---

## 3. Services Content

### Service 1: Custom Tattoo
**Title:** Custom Tattoo
**Description:** Desain tattoo eksklusif sesuai ide dan karakter klien.
**Full Description (optional):** Setiap tattoo adalah karya seni yang unik. Tim kami bekerja sama dengan Anda untuk menciptakan desain custom yang benar-benar mencerminkan kepribadian dan cerita Anda.

### Service 2: Tattoo Consultation
**Title:** Tattoo Consultation
**Description:** Diskusi konsep, ukuran, placement, dan style sebelum proses tattoo.
**Full Description (optional):** Konsultasi mendalam untuk memastikan visi Anda terwujud dengan sempurna. Kami membahas detail placement, ukuran, warna, dan teknik yang paling sesuai.

### Service 3: Tattoo Touch Up
**Title:** Tattoo Touch Up
**Description:** Perbaikan detail tattoo lama agar kembali tajam dan hidup.
**Full Description (optional):** Tattoo lama yang mulai memudar? Kami siap memperbarui detail dan mengembalikan ketajaman warna original Anda dengan hasil yang fresh dan vibrant.

### Service 4: Tattoo Supply
**Title:** Tattoo Supply
**Description:** Penyedia perlengkapan tattoo berkualitas untuk artist profesional.
**Full Description (optional):** Kami menyediakan perlengkapan tattoo premium dari brand terpercaya. Kualitas terjamin untuk hasil terbaik setiap session.

---

## 4. Layout Pattern Analysis

### Option A: Section Title + Service List + Image (Recommended)

```
Section Title & Subtitle
    ↓
Short Intro Text (optional)
    ↓
Service Grid (1-2 column responsive)
    ↓
Supporting Image (optional)
    ↓
CTA Button
```

**Advantages:**
- Clear information hierarchy
- Services easy to scan
- Image below as supporting element
- Not overwhelming

### Option B: Image + Services (Alternative)

```
Large Supporting Image
    ↓
Section Title & Subtitle
    ↓
Service List
    ↓
CTA Button
```

**Advantages:**
- Image visible immediately
- Creates visual interest early

### Implementation Choice: Option A
- Reason: Aligns with Hero/About editorial pattern
- Services information first (user can decide)
- Image as visual support (not forced)
- More readable on mobile

---

## 5. Service Item Structure

### Card Style (Clean, Minimal)
```
Service Icon (Lucide React, 20-24px)
    ↓
Service Title (bold, dark)
    ↓
Service Description (brief, gray)
```

**Size:** Small, compact
**Layout:** Grid 2x2 or 1x4 (responsive)
**No excessive padding or background**
**Focus on typography**

---

## 6. Responsive Layout

### Desktop (md: 1024px+)
- Services: 2-column grid (2x2 layout)
- Gap: md:gap-12 (3rem)
- Image: Optional, below services
- Typography: Larger sizes

### Tablet (sm: 640px - 1023px)
- Services: 2-column grid maintained
- Gap: md:gap-8 (2rem)
- Typography: Medium sizes
- Image: Responsive width

### Mobile (< 640px)
- Services: 1-column stack
- Gap: gap-4 (1rem)
- Typography: Mobile-optimized
- Full-width layout
- Image: Full-width, responsive height

---

## 7. Component Usage

### Layout Components
1. **x-layout.section** - Wrapper with lg spacing (py-16 md:py-24)
2. **x-layout.container** - Max-w-6xl, responsive padding
3. **x-layout.section-title** - Title + optional subtitle

### UI Components
1. **x-ui.button** - CTA button at end (variant="primary", size="lg")
2. **x-ui.link** - Secondary CTA if needed

### Icon Component
- **Lucide React icons** (from npm package already installed)
- Line icons only (simple, not filled)
- Size: 20-24px (sm to md)
- Color: Inherit from text color (text-text-primary)

### Design Tokens
- text-text-primary (#1a1a1a - black)
- text-text-secondary (#666666 - gray)
- bg-background (#fafafa - off-white)
- bg-surface (#ffffff - white)

---

## 8. Icon Selection

### Service Icons (Lucide React)
1. **Custom Tattoo**: Palette icon (art/design) or Pen/PenTool
2. **Tattoo Consultation**: MessageCircle or MessageSquare or Speech
3. **Tattoo Touch Up**: Sparkles or Zap or RefreshCw
4. **Tattoo Supply**: Package or BoxOpen or Briefcase

**Icon Configuration:**
```blade
<svg class="w-6 h-6 text-text-primary">
  <!-- Lucide icon SVG -->
</svg>
```

Or use icon component if available (check if Lucide React integrated).

**Important:** Icons should be:
- Line-style (not filled)
- 20-24px size
- Color: Inherit from text (text-text-primary)
- No extra decoration
- Minimal visual impact

---

## 9. Animation System

**Cascade Timing:**
1. Title: 0ms delay
2. Services (batch): 100ms delay (start together or staggered)
3. CTA: 200-300ms delay

**Animation Type:**
- animate-fadeInUp (fade + slide up)
- Duration: 300ms (from app.css)

**Implementation:**
```blade
<!-- Title -->
<h2 class="... animate-fadeInUp">Services</h2>

<!-- Services (optional individual animation) -->
<div class="... animate-fadeInUp delay-100">
  <!-- Service items -->
</div>

<!-- CTA -->
<button class="... animate-fadeInUp delay-200">
  View Full Portfolio
</button>
```

---

## 10. Image Management

### Asset Path
```
public/
└── images/
    └── services/
        └── services.jpeg
```

### Image Usage
```blade
<img 
  src="{{ asset('images/services/services.jpeg') }}"
  alt="Ananniti Tattoo Services and Studio Setup"
  class="w-full h-auto object-cover rounded-lg mt-12"
/>
```

### Image Properties
- Size: 1200x600px or 1200x800px (landscape)
- Format: JPEG
- Optional (not critical path)
- Enhances visual appeal but not required

---

## 11. CTA Implementation

### Primary CTA (End of section)
```blade
<x-ui.button variant="primary" size="lg" class="mt-12">
  View Full Portfolio
</x-ui.button>
```

Or

```blade
<x-ui.button variant="primary" size="lg" class="mt-12">
  Discuss Your Tattoo Idea
</x-ui.button>
```

**Placement:** Below services list or image
**Style:** Primary button (black bg, white text)
**Margin:** mt-12 (3rem top margin for breathing room)

---

## 12. Background Color

### Section Background
- Option A: `bg-surface` (white, #ffffff)
- Option B: `bg-background` (off-white, #fafafa)

**Current placeholder uses:** `bg-surface` (white)

**Recommendation:** Keep `bg-surface` (white) for simplicity and contrast with About section

---

## 13. Technical Structure

### HTML Layout
```blade
<section id="services">
  <x-layout.section spacing="lg" class="bg-surface">
    <x-layout.container>
      
      <!-- Section Title -->
      <x-layout.section-title 
        title="Our Services" 
        subtitle="Premium tattoo services tailored to your vision"
      />
      
      <!-- Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 mt-12">
        <!-- Service items (4 total) -->
      </div>
      
      <!-- Optional Image -->
      <img src="..." alt="..." class="mt-12 ..." />
      
      <!-- CTA Button -->
      <div class="text-center mt-12">
        <x-ui.button variant="primary" size="lg">
          View Full Portfolio
        </x-ui.button>
      </div>
      
    </x-layout.container>
  </x-layout.section>
</section>
```

---

## 14. Accessibility Requirements

- [x] Semantic HTML (`<section id="services">`, `<h2>`, `<img>`, `<button>`)
- [x] Heading hierarchy (h2 for Services, proper nesting)
- [x] Alt text for image (descriptive)
- [x] Keyboard navigation (natural tab order)
- [x] Focus states (buttons have focus rings)
- [x] Color contrast (black text on white: 12.63:1 = WCAG AAA)
- [x] ARIA labels (if needed for icons)
- [x] Link semantics (use button for actions, link for navigation)

---

## 15. Implementation Checklist

### Phase 1: Setup ✅
- [x] Create `public/images/services/` folder
- [x] Create placeholder `services.jpeg`

### Phase 2: HTML Structure
- [ ] Replace placeholder with full Services section
- [ ] Add section title and subtitle
- [ ] Add services grid (4 items, 2x2 desktop)
- [ ] Add service icons (Lucide React)
- [ ] Add service titles and descriptions
- [ ] Add optional image
- [ ] Add CTA button

### Phase 3: Styling & Responsive
- [ ] Apply Tailwind utilities for layout
- [ ] Responsive grid (1 col mobile, 2 col desktop)
- [ ] Proper spacing and alignment
- [ ] Color tokens for typography
- [ ] Image styling (object-cover, rounded)

### Phase 4: Animation
- [ ] Add fade-up animation to title
- [ ] Add fade-up animation to services
- [ ] Add fade-up animation to CTA
- [ ] Implement cascade delays (0ms, 100ms, 200ms)

### Phase 5: Verification
- [ ] Build check
- [ ] Responsive testing
- [ ] Self-review
- [ ] Documentation

---

## 16. Acceptance Criteria

- [ ] Services section implemented
- [ ] 4 services displayed (Custom Tattoo, Consultation, Touch Up, Supply)
- [ ] Editorial layout (not card-grid SaaS style)
- [ ] Responsive (desktop, tablet, mobile)
- [ ] Icons from Lucide React (optional, not required)
- [ ] CTA button present and functional
- [ ] Color palette: Black/White/Gray only ✅
- [ ] Typography: Playfair + Inter ✅
- [ ] Build successful
- [ ] No warnings, no errors
- [ ] No duplicate code
- [ ] Semantic HTML
- [ ] WCAG AA accessible
- [ ] Image easily replaceable

---

**Analysis Status**: ✅ COMPLETE

**Ready for Implementation**: YES

**Next Step**: Implement Services section with editorial layout and 4 services

