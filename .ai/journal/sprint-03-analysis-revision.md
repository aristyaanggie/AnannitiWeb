# Sprint 03 — Hero Section (Revisi Analisis)

Dokumentasi revisi analisis dan rencana implementasi Hero Section berdasarkan feedback visual quality dan design philosophy.

## 1. Hasil Revisi Analisis

### Perubahan Kritis Dibanding Analisis Sebelumnya

**Sebelum (Analisis Awal):**
- Hero layout: Dua kolom 50:50 (SaaS-style)
- Component: Reusable dengan banyak props
- Copy: Generic ("Where Art Meets Skin", "Your Story, Our Art")
- Animation: AOS library untuk fade-in
- Image: Placeholder online service
- Focus: Balance antara typography dan photography

**Sesudah (Revisi):**
- Hero layout: Editorial dengan photography dominan (65-70% visual space)
- Component: Minimal props, fokus pada implementasi sederhana
- Copy: Premium, confident, authentic (bukan generic)
- Animation: Tailwind + CSS sederhana (no library)
- Image: Placeholder berbasis SVG atau gradient (mudah diganti)
- Focus: Photography sebagai hero utama (80% attention), typography supporting

### Key Insight dari Design Philosophy

1. **Editorial Website** ≠ SaaS Landing Page
   - Editorial: Fokus visual, whitespace luas, photography dominan
   - SaaS: Icon + copy balanced, information-heavy, CTA prominent
   - Ananniti: Premium creative studio (editorial approach)

2. **Luxury Brand Aesthetics**
   - Generous whitespace untuk premium feel
   - Photography sebagai visual anchor
   - Typography sebagai secondary narrative
   - Minimal dekorasi, fokus pada essential

3. **Creative Studio Identity**
   - Premium photography: High-end tattoo imagery
   - Artistic typography: Showcase craftsmanship
   - Premium spacing: Breathing room
   - No corporate feel: Authentic, warm, professional

---

## 2. Layout Hero — Editorial Approach

### Pilihan Layout: Photography-First (Asymmetric)

**Desktop (lg: 1024px+)**
```
┌────────────────────────────────────────────────┐
│ EYEBROW (small, optional)                      │
│ "Premium Tattoo Studio in Bali"                │
│                                                │
│ MAIN HEADING (large, bold)                     │
│ "Bring Your Tattoo Vision to Life"             │
│ (70% width, left-aligned)                      │
│                                                │
│ DESCRIPTION (warm, welcoming)                  │
│ 2-3 sentences tentang studio                   │
│ (60% width, left-aligned)                      │
│                                                │
│ CTA BUTTONS (side-by-side)                     │
│ [Primary] [Secondary]                          │
│ (40% width area)                               │
│                                                │
│                    ╔═══════════════════════╗  │
│                    ║                       ║  │
│                    ║  HERO IMAGE           ║  │
│                    ║  (65-70% visual)      ║  │
│                    ║  (Asymmetric right)   ║  │
│                    ║                       ║  │
│                    ╚═══════════════════════╝  │
└────────────────────────────────────────────────┘
```

**Alasan Layout:**
1. **Photography Dominan**: 65-70% space untuk image (sesuai editorial)
2. **Asymmetric (Bukan 50:50)**: Photography bukan equal dengan text, lebih dominan
3. **Text di Kiri**: Natural reading order (top-left to bottom-right)
4. **Full Height**: Hero section min 100vh (full viewport, sesuai landing page)
5. **Whitespace Luas**: Breathing room di antara elements
6. **Visual Hierarchy**: Image sebagai focal point pertama

### Tablet (md: 768px - 1023px)

```
Text stack di atas dengan image di bawah, full-width.
Typography tetap prominent, image tetap dominan (90% width).
Spacing di-adjust tapi hierarchy tetap.
```

### Mobile (< 768px)

```
Stack vertikal:
- Eyebrow
- Heading
- Description
- CTA (full-width buttons)
- Hero image (full-width)

Typography ukuran di-scale down tapi tetap readable.
Image full-width, aspect ratio maintained.
Whitespace tetap generous (padding di sekitar elements).
```

---

## 3. Typography Hierarchy

### Hierarchy Structure

**Eyebrow** (Supporting context)
- Font: Body font (Inter), tidak serifed
- Size: text-xs ke text-sm (12-14px)
- Weight: font-medium
- Color: text-secondary (66666)
- Transform: uppercase (optional, untuk premium feel)
- Spacing: mb-3 ke mb-4 (12-16px from eyebrow to heading)
- Purpose: Premium label, tidak essential
- Optional: Bisa di-skip untuk simpler hero

**Heading (H1)** (Main message)
- Font: Heading font (Playfair Display), serif untuk luxury
- Size: text-5xl ke text-6xl responsive (48-72px)
- Weight: font-bold (700)
- Color: text-primary (1a1a1a)
- Line Height: 1.1 ke 1.2 (untuk tight, impactful heading)
- Max Width: 60-70% width (tidak full width, maintain readability)
- Spacing: mb-4 ke mb-6 (16-24px from heading to description)
- Purpose: Focal point typografi, menjawab pertanyaan "Mengapa Ananniti?"

**Description** (Supporting text)
- Font: Body font (Inter)
- Size: text-lg ke text-xl (18-20px) — larger dari body, lebih prominent
- Weight: font-regular (400)
- Color: text-secondary (666666)
- Line Height: 1.6 ke 1.7 (untuk comfortable reading)
- Max Width: 50-60% width (readable line length 60-80 chars)
- Spacing: mb-8 ke mb-12 (32-48px from description to CTA)
- Purpose: Warm, welcoming tone yang menjelaskan value proposition
- Tone: Conversational, authentic, professional

**CTA Buttons**
- Primary: "Discuss Your Tattoo Idea" (primary button)
- Secondary: "View Our Works" (secondary variant)
- Spacing: gap-4 (16px between buttons)
- Size: md ke lg (medium-large)
- Behavior: Inline-flex, side-by-side di desktop

### Visual Hierarchy Intent

1. **Eyes first**: Photography (dominant visual)
2. **Eyes second**: Heading (large, bold, serif, high contrast)
3. **Eyes third**: Description + CTA (supporting narrative)
4. **Eyes fourth**: Eyebrow (optional context)

---

## 4. Photography Strategy

### Photography Placement & Proportion

**Desktop Position:**
- Right side of screen, asymmetric
- Starts dari middle vertical (tidak full height, untuk whitespace)
- 65-70% dari hero section width
- Approximate dimensions: 800x600px-900x700px (16:9 ke 4:3)
- Aligned: Top-right ke bottom-right area

**Image Specifications:**
- Aspect ratio: 3:4 atau 4:5 (portrait crop, untuk dynamic look)
- Alt: Sesuai alt text guidelines (descriptive tattoo description)
- Responsive: 100% width di mobile, constrained di desktop

### Photography Content Strategy

**Visual Direction:**
- High-end tattoo photograph (portfolio-quality)
- Artistic composition (tidak just close-up, tapi with context)
- Professional lighting (high contrast, artistic)
- Subject: Completed tattoo atau artist working (aspirational)

**Why Photography Dominan:**
- Ananniti = tattoo studio (visual art medium)
- Photography = proof of quality
- Emotional impact > text messaging
- First 3-5 seconds: Image captures attention sebelum text dibaca

### Placeholder Strategy

**Local Placeholder (Bukan Online Service):**

Option 1: SVG Gradient Placeholder
```
- Simple SVG dengan gradient (warm colors, premium aesthetic)
- Ukuran: 800x600px
- Gradient: Dark brown to gold (sesuai brand aesthetic)
- Mudah diganti dengan real image later
- File: resources/assets/images/hero-placeholder.svg
```

Option 2: HTML5 Canvas Placeholder
```
- Dynamic gradient based pada brand colors
- Can add subtle animation
- Fallback ke static image
```

Option 3: Image Placeholder
```
- Use high-quality placeholder image
- Aspect ratio: 3:4
- Colors: Warm, premium (beige, brown tones)
- Can download dari placeholder service, save locally
```

**Recommended: SVG Gradient Placeholder**
- Lightweight
- No external dependency
- Easy to replace
- Premium feel dengan simple gradient
- Dapat include faint text atau logo watermark

---

## 5. CTA Strategy

### Primary CTA: "Discuss Your Tattoo Idea"

**Alasan:**
- Action-oriented, specific outcome
- First-person implied (user benefit)
- Clear next step (discussion, not pressure)
- Professional, warm tone
- Not pushy (vs. "Book Now")

**Button Style:**
- Variant: Primary (dark background)
- Size: md ke lg
- Icon: Message Circle (dari Lucide React) — sesuai dengan "discuss"
- Layout: Icon + text, inline-flex, gap-2
- Behavior: Clickable, focus state, hover state

**Target:**
- Leads to contact form atau WhatsApp conversation
- Not hard-sell, invitation untuk dialog

### Secondary CTA: "View Our Works"

**Alasan:**
- Softer CTA, exploration-focused
- Allows user to see portfolio first
- Reduces friction (browse before committing)
- Educational, builds confidence

**Button Style:**
- Variant: Secondary (outline atau light background)
- Size: md ke lg
- Icon: Eye atau Gallery icon (optional)
- Layout: Text only atau icon + text
- Behavior: Links to gallery section (smooth scroll atau navigate)

**Target:**
- Scroll to gallery section
- Or navigate to dedicated gallery page (future)

### CTA Placement & Spacing

**Desktop:**
- Below description text
- Side-by-side (primary left, secondary right)
- Spacing: mt-8 ke mt-12 (32-48px from description)
- Gap between buttons: gap-4 (16px)

**Mobile:**
- Stack vertically (full-width)
- Primary above secondary
- Spacing: my-4 (16px between buttons)
- Width: 100% atau max-w-xs untuk comfortable touch target

**Keyboard/Accessibility:**
- Tab order: Primary CTA first, Secondary CTA second
- Focus visible ring
- Proper semantic HTML (button elements)

---

## 6. Responsive Strategy

### Typography Scaling

**Heading (H1):**
- Mobile: text-4xl (36px)
- Tablet: text-5xl (48px)
- Desktop: text-6xl (60px)

**Description:**
- Mobile: text-base ke text-lg (16-18px)
- Tablet: text-lg (18px)
- Desktop: text-xl (20px)

### Layout Changes

**Mobile (< 640px):**
- Hero min-height: 100vh (full viewport)
- Layout: Stack vertically
- Image placement: Below all text content
- Image width: 100% (full-width)
- Padding: px-4 (horizontal), py-12 ke py-16 (vertical)
- Text max-width: 100% (full width di mobile)
- CTA buttons: Full-width atau max-w-xs + mx-auto

**Tablet (640px - 1023px):**
- Layout: Start transitioning to side-by-side
- Image: Positioned right, but reduced proportion (55-60%)
- Text: Proportional to available space
- Padding: px-6 ke px-8

**Desktop (1024px+):**
- Layout: Asymmetric (65-70% image, 30-35% text)
- Hero min-height: 100vh
- Max-width: Not constrained (full-width hero)
- Padding: Generous whitespace
- Text max-width: 60-70% untuk good line length

### Visual Hierarchy Preservation

**Key Principle:** Hierarchy tetap clear di semua breakpoints

- **Mobile**: Heading dominan (large relative to viewport), image impressive (full-width)
- **Tablet**: Heading tetap prominent, image starting to balance
- **Desktop**: Photography lebih dominan, but heading tetap clear focal point

### Responsive Image Strategy

**Desktop:** Optimized untuk wider screens
**Tablet:** Adjusted aspect ratio untuk portrait orientation
**Mobile:** Full-width, maintained aspect ratio

---

## 7. Accessibility Strategy

### Semantic HTML

```html
<section id="hero" class="...">
  <div class="...">
    <!-- Eyebrow (optional) -->
    <p class="text-sm uppercase">...</p>
    
    <!-- Main Heading -->
    <h1 class="text-6xl font-bold">...</h1>
    
    <!-- Description -->
    <p class="text-xl leading-relaxed">...</p>
    
    <!-- CTA Buttons -->
    <div class="flex gap-4">
      <button>...</button>
      <a href="...">...</a>
    </div>
    
    <!-- Hero Image -->
    <img src="..." alt="..." />
  </div>
</section>
```

### Keyboard Navigation

- Tab order: Natural (eyebrow → heading → description → CTA primary → CTA secondary → image)
- Focus visible: All interactive elements memiliki focus ring (Tailwind: focus:ring-2)
- Skip links: Dapat diimplementasikan untuk skip ke main content

### Image Alt Text

```
Good: "Professional tattoo artist creating a detailed black and gray rose design"
Not: "tattoo image"
Better: "Completed custom black and gray rose tattoo on client's forearm"
```

### Color Contrast

- Heading (primary color #1a1a1a on white): 12.63:1 ✓ (WCAG AAA)
- Body (secondary color #666666 on white): 4.8:1 ✓ (WCAG AA)
- CTA buttons: Primary color on button background ✓

### Focus States

```html
<!-- Primary Button Focus -->
<button class="... focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">

<!-- Secondary Button Focus -->
<a class="... focus:outline-none focus:ring-2 focus:ring-offset-2">
```

### Motion Accessibility

```html
<!-- Respect prefers-reduced-motion -->
<div class="animate-fadeIn motion-reduce:!animation-none">
```

---

## 8. Animation Strategy

### Animation Philosophy

**Principles:**
- Subtle, not distracting
- Enhance, not distract (as per animation guidelines)
- 200-300ms duration (micro-interaction range)
- Ease-out (for entering elements)
- Respect prefers-reduced-motion

### Fade-In Animation (No Library)

**Implementation with Tailwind + CSS:**

```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeInUp {
  animation: fadeInUp 0.6s ease-out forwards;
}
```

### Animation Stagger (Cascade Effect)

**Elements dengan staggered delay:**
1. Eyebrow: 0ms (instant)
2. Heading: 100ms delay
3. Description: 200ms delay
4. CTA buttons: 300ms delay
5. Hero image: 400ms delay

**Purpose:** Sequential reveal, visual narrative

### Implementation Approach

**Option 1: Alpine.js (Simple Intersection Observer)**
```javascript
// Trigger animation when element enters viewport
x-intersect="animate = true"
// Apply animation class: animate-fadeInUp
```

**Option 2: Pure CSS (On Page Load)**
```html
<!-- Animation plays on load, no dependency -->
<h1 class="animate-fadeInUp">Heading</h1>
```

**Recommended: Option 2 (Pure CSS on Load)**
- Simpler (no Alpine.js needed)
- Consistent behavior
- Better for static content
- Still respects prefers-reduced-motion

### Animation Timing

- Duration: 600ms untuk fade-in (smooth, not jarring)
- Delay: Staggered 100ms intervals
- Total sequence: 1000ms (1 second) untuk complete animation

### No JavaScript Libraries

- ❌ AOS (no external library)
- ❌ GSAP (no external library)
- ✓ CSS @keyframes
- ✓ Tailwind animation utilities (if available)
- ✓ Alpine.js (already in project, for interactivity)

---

## 9. Technical Decision

### Decision 1: Hero as Inline Blade (Not Component)

**Why:**
- Hero used only once on homepage
- Complex props not needed
- Simpler to maintain
- Easy to evolve

**What:**
```html
<!-- resources/views/pages/home.blade.php -->
<section id="hero" class="...">
  <!-- Inline implementation -->
</section>
```

**Benefit:** No abstraction overhead for single-use section

---

### Decision 2: SVG Gradient Placeholder (Local)

**Why:**
- No external dependency
- No CDN latency
- Easy to replace
- Lightweight
- Professional placeholder

**What:**
```html
<img src="{{ asset('images/hero-placeholder.svg') }}" alt="Premium tattoo design placeholder" />
```

---

### Decision 3: 100vh vs 100svh (Hero Height)

**Decision: 100vh (viewport height)**

**Alasan:**
- Better browser support (100svh only modern browsers)
- Acceptable on mobile (address bar calculation is ok)
- Consistent behavior across devices
- Industry standard for hero sections

**Fallback:** Consider 100svh untuk future browser support (with @supports query)

---

### Decision 4: Tailwind Utility First (No Custom CSS)

**Approach:**
- Use Tailwind @apply for responsive sizing
- Minimal custom CSS (only @keyframes if necessary)
- All colors from design tokens
- All spacing from Tailwind scale

**Benefit:** Consistency, maintainability, no class bloat

---

### Decision 5: No Component Reusability (Yet)

**Hero is inline, not abstracted:**
- Future optimization: Can extract to component if used elsewhere
- Current scope: Single-use section on homepage
- Simplicity over abstraction

---

## 10. Final Implementation Plan

### Phase 1: HTML Structure

```html
<section id="hero" class="min-h-screen bg-background flex items-center">
  <x-layout.container class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
    
    <!-- Text Content (Left) -->
    <div class="flex flex-col justify-center">
      <!-- Eyebrow -->
      <p class="text-xs uppercase tracking-wider text-text-secondary mb-4">
        Premium Tattoo Studio in Bali
      </p>
      
      <!-- Heading -->
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary mb-6 leading-tight max-w-xl">
        Bring Your Tattoo Vision to Life
      </h1>
      
      <!-- Description -->
      <p class="text-lg md:text-xl leading-relaxed text-text-secondary mb-8 max-w-lg">
        At Ananniti, we combine artistic excellence with professional craftsmanship. 
        Every design is a collaboration, every tattoo a masterpiece.
      </p>
      
      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4">
        <x-ui.button-with-icon 
          icon="message-circle" 
          variant="primary" 
          size="lg"
        >
          Discuss Your Tattoo Idea
        </x-ui.button-with-icon>
        
        <x-ui.button 
          variant="secondary" 
          size="lg"
          @click="window.location.href='#gallery'"
        >
          View Our Works
        </x-ui.button>
      </div>
    </div>
    
    <!-- Hero Image (Right) -->
    <div class="flex items-center justify-center lg:justify-end">
      <img 
        src="{{ asset('images/hero-placeholder.svg') }}" 
        alt="Premium custom tattoo artwork showcase"
        class="w-full max-w-md lg:max-w-lg h-auto object-cover rounded-lg"
      />
    </div>
    
  </x-layout.container>
</section>
```

### Phase 2: Styling

**Tailwind Classes:**
- Layout: grid, grid-cols-1, lg:grid-cols-2, gap-8, lg:gap-12
- Text sizing: text-4xl, md:text-5xl, lg:text-6xl (responsive heading)
- Colors: text-text-primary, text-text-secondary (from design tokens)
- Spacing: mb-4, mb-6, mb-8 (consistent hierarchy)
- Animation: animate-fadeInUp (if using custom keyframes)

**Custom CSS (If needed):**
```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeInUp {
  animation: fadeInUp 0.6s ease-out forwards;
}
```

### Phase 3: Animation (Optional, Simple)

**Approach 1: CSS only (on page load)**
```html
<h1 class="animate-fadeInUp">...</h1>
<p class="animate-fadeInUp" style="animation-delay: 100ms;">...</p>
```

**Approach 2: Alpine.js (if scroll-triggered)**
```html
<div x-intersect="animate = true" :class="animate ? 'animate-fadeInUp' : ''">
</div>
```

**Recommended: Approach 1 (simpler)**

### Phase 4: Responsive Adjustments

**Mobile:** Full width, stack layout, appropriate padding
**Tablet:** Transition layout, start positioning image
**Desktop:** Asymmetric layout, photography dominant

### Phase 5: Accessibility Review

- ✓ Semantic HTML
- ✓ Alt text
- ✓ Focus states
- ✓ Color contrast
- ✓ Keyboard navigation
- ✓ prefers-reduced-motion

### File Changes

**New:**
- None (inline implementation)

**Modified:**
- `resources/views/pages/home.blade.php` — Replace hero placeholder
- `resources/assets/images/hero-placeholder.svg` — Add placeholder

**No changes needed:**
- Design tokens
- Components
- Layout structure

---

## Summary

**Hero Section akan:**
- ✓ Terlihat editorial, premium, bukan SaaS
- ✓ Fotografinya dominan (65-70% visual)
- ✓ Typography hierarchy clear dan impactful
- ✓ Copy authentic, warm, professional
- ✓ CTA jelas dan actionable
- ✓ Responsive semua devices
- ✓ Accessible (WCAG AA)
- ✓ Animation subtle (jika digunakan)
- ✓ No library, only Tailwind + CSS
- ✓ Easy to maintain dan evolve

**Siap untuk implementasi.**
