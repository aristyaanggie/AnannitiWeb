# Sprint 05 — Services Section (Revision Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Requirement Sprint 05 Revision sangat berbeda dari implementasi sebelumnya. Bukan membuat daftar 4 layanan, tetapi membuat **pemilih layanan dengan hanya 2 card utama** yang dapat di-expand.

**Key Difference:**
- Previous: 4 services in list format
- Now: 2 expandable cards (Studio Service, Home Service)
- Previous: Static information
- Now: Interactive expand/collapse dengan Alpine.js

**New Requirements:**
- Hanya 2 card (Studio Service, Home Service)
- Card dapat di-expand untuk menampilkan detail
- Expand behavior: max-height + opacity + transition
- Button: "Learn More" → berubah jadi "Show Less" saat expand
- Layout: 2 card desktop, stacked mobile
- Alpine.js untuk interactivity (sudah tersedia di project)
- No modal, no page navigation, hanya height expansion

---

## 2. Current Implementation vs New Requirement

### Current Implementation (Sprint 05 - Iteration 1)
```
4 Services dalam grid:
- Custom Tattoo (with icon)
- Tattoo Consultation (with icon)
- Tattoo Touch Up (with icon)
- Tattoo Supply (with icon)
- CTA button: "View Full Portfolio"
```

**Issues:**
❌ Terlalu banyak services (4 instead of 2)
❌ Tidak ada expand behavior
❌ Static information (tidak interactive)
❌ Tidak menggunakan Alpine.js
❌ Tidak sesuai requirement baru

### New Requirement (Sprint 05 - Revision)
```
2 Service Cards:
1. Studio Service
   - Title
   - Short description
   - "Learn More" button
   - Expanded content (on click)
   
2. Home Service
   - Title
   - Short description
   - "Learn More" button
   - Expanded content (on click)
```

**Key Features:**
✅ Hanya 2 card (clear choice)
✅ Interactive expand/collapse
✅ Smooth animation (max-height, opacity, transition)
✅ Button toggle: "Learn More" ↔ "Show Less"
✅ Semantic HTML dengan aria-expanded, aria-controls
✅ Alpine.js untuk state management
✅ Premium look (no shadow, minimal design)

---

## 3. Card Design Specification

### Card Structure (Collapsed)
```
┌─────────────────────────────────┐
│ Studio Service                  │
│                                 │
│ Private tattoo studio offering  │
│ personalized sessions in our    │
│ comfortable studio environment. │
│                                 │
│ [Learn More ▼]                  │
└─────────────────────────────────┘
```

### Card Structure (Expanded)
```
┌─────────────────────────────────┐
│ Studio Service                  │
│                                 │
│ Private tattoo studio offering  │
│ personalized sessions in our    │
│ comfortable studio environment. │
│                                 │
│ Details:                        │
│ • Private tattoo studio         │
│ • Sterile equipment             │
│ • Comfortable environment       │
│ • Professional artists          │
│ • Custom tattoo session         │
│ • Free consultation             │
│                                 │
│ [Show Less ▲]                   │
└─────────────────────────────────┘
```

### Card Styling
- **Background**: White (bg-white or bg-surface)
- **Border**: Black or neutral gray (border-2 border-black or border-text-primary)
- **Radius**: Small (rounded-lg or rounded-xl)
- **Shadow**: Minimal or none (no large shadow)
- **Padding**: Generous (p-6 md:p-8)
- **Hover**: Border lebih jelas, subtle change
- **Transition**: 200ms ease-out

---

## 4. Service Content Specification

### Service 1: Studio Service

**Title:** Studio Service

**Short Description (Collapsed):**
"Private tattoo studio offering personalized sessions in our comfortable studio environment."

**Expanded Details:**
```
Fasilitas di studio kami:
• Private tattoo studio
• Sterile equipment
• Comfortable environment
• Professional artists
• Custom tattoo session
• Free consultation
```

### Service 2: Home Service

**Title:** Home Service

**Short Description (Collapsed):**
"Tattoo service at your preferred location with professional artists and portable equipment."

**Expanded Details:**
```
Layanan di lokasi Anda:
• Tattoo service at your location
• Appointment required
• Sterile portable equipment
• Area coverage: Bali
• Professional preparation
• Consultation before visit
```

---

## 5. Alpine.js Implementation Strategy

### State Management
```javascript
x-data="{ 
  expanded: false 
}"
```

### Toggle Logic
```javascript
@click="expanded = !expanded"
```

### Conditional Rendering
```blade
x-show="!expanded" → Show short description
x-show="expanded" → Show expanded content
```

### Button Toggle
```blade
x-text="expanded ? 'Show Less' : 'Learn More'"
```

### Aria Attributes
```blade
:aria-expanded="expanded"
aria-controls="service-details-studio"
```

---

## 6. Layout Pattern

### Desktop (md: 1024px+)
```
┌──────────────────┐  ┌──────────────────┐
│ Studio Service   │  │ Home Service     │
└──────────────────┘  └──────────────────┘
     (50% width)           (50% width)
       gap-12
```

### Mobile (< 1024px)
```
┌──────────────────┐
│ Studio Service   │
└──────────────────┘
       gap-8
┌──────────────────┐
│ Home Service     │
└──────────────────┘
```

### CSS Classes
```
Container: grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12
Card: w-full border-2 border-text-primary rounded-lg p-6 md:p-8
```

---

## 7. Animation Specification

### Expand Animation
```css
max-height: 0 → max-height: auto (or specific height like 400px)
opacity: 0 → opacity: 1
transition: max-height 300ms ease-out, opacity 300ms ease-out
```

### Implementation (Tailwind + Alpine)
```blade
<div 
  class="transition-all duration-300 ease-out overflow-hidden"
  :style="{ maxHeight: expanded ? '400px' : '0px', opacity: expanded ? 1 : 0 }"
>
  <!-- Expanded content -->
</div>
```

Or simpler with max-h classes:
```blade
<div 
  class="transition-all duration-300 ease-out overflow-hidden"
  :class="expanded ? 'max-h-96' : 'max-h-0'"
>
  <!-- Expanded content -->
</div>
```

---

## 8. Technical Implementation

### Alpine.js Data Structure
```javascript
{
  serviceStudioExpanded: false,
  serviceHomeExpanded: false
}
```

### HTML Structure
```blade
<section id="services">
  <x-layout.section spacing="lg" class="bg-surface">
    <x-layout.container>
      
      <!-- Section Title -->
      <x-layout.section-title 
        title="How We Serve You" 
        subtitle="Choose the perfect service option for your needs"
        alignment="center"
      />
      
      <!-- Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 mt-12">
        
        <!-- Card 1: Studio Service -->
        <div 
          x-data="{ expanded: false }"
          class="border-2 border-text-primary rounded-lg p-6 md:p-8 bg-surface transition-all duration-300"
        >
          <!-- Title -->
          <h3 class="text-2xl font-bold text-text-primary mb-4">
            Studio Service
          </h3>
          
          <!-- Short Description (always visible) -->
          <p class="text-text-secondary mb-6">
            Private tattoo studio offering personalized sessions in our comfortable studio environment.
          </p>
          
          <!-- Expanded Content (conditional) -->
          <div 
            class="overflow-hidden transition-all duration-300"
            :class="expanded ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'"
          >
            <ul class="space-y-2 text-text-secondary mb-6">
              <li>• Private tattoo studio</li>
              <li>• Sterile equipment</li>
              <li>• Comfortable environment</li>
              <li>• Professional artists</li>
              <li>• Custom tattoo session</li>
              <li>• Free consultation</li>
            </ul>
          </div>
          
          <!-- Button -->
          <button 
            @click="expanded = !expanded"
            class="text-primary hover:text-primary-light transition-colors duration-200 font-semibold"
          >
            <span x-text="expanded ? 'Show Less' : 'Learn More'" />
          </button>
        </div>
        
        <!-- Card 2: Home Service (similar structure) -->
        
      </div>
      
    </x-layout.container>
  </x-layout.section>
</section>
```

---

## 9. Accessibility Implementation

### ARIA Attributes
```blade
<!-- Container -->
<div role="region" aria-label="Service Options">

<!-- Button -->
<button 
  :aria-expanded="expanded"
  aria-controls="service-details-studio"
  class="..."
>
  Learn More
</button>

<!-- Expandable Content -->
<div 
  id="service-details-studio"
  :hidden="!expanded"
  class="..."
>
  <!-- Details -->
</div>
```

### Keyboard Navigation
- Tab through cards
- Enter/Space on button to toggle
- Focus visible on button
- Semantic HTML structure

---

## 10. Color & Typography

### Colors (Compliant)
- Border: text-text-primary (#1a1a1a)
- Background: bg-surface (#ffffff)
- Text: text-text-primary (#1a1a1a)
- Secondary text: text-text-secondary (#666666)
- Hover: opacity/subtle change (no new colors)

### Typography
- Title: h3, text-2xl, font-bold, Playfair Display
- Description: text-base, text-text-secondary, Inter
- Details: text-sm, text-text-secondary, Inter

---

## 11. Implementation Checklist

### Phase 1: Analysis ✅
- [x] Understand new requirement (2 cards, expandable)
- [x] Identify Alpine.js usage
- [x] Plan layout and animation

### Phase 2: Implement Services Section
- [ ] Remove old 4-service implementation
- [ ] Create 2-card layout
- [ ] Add Alpine.js state management
- [ ] Implement card styling (border, padding, radius)
- [ ] Add expand/collapse animation

### Phase 3: Add Interactivity
- [ ] Button toggle: Learn More ↔ Show Less
- [ ] Card expand with max-height animation
- [ ] Opacity transition
- [ ] ARIA attributes (aria-expanded, aria-controls)

### Phase 4: Verification
- [ ] Build check
- [ ] Responsive testing (desktop, tablet, mobile)
- [ ] Accessibility check (keyboard, ARIA)
- [ ] Self-review

---

## 12. Acceptance Criteria

- [ ] Hanya 2 card (Studio Service, Home Service)
- [ ] Card dapat expand/collapse
- [ ] Button toggle: "Learn More" ↔ "Show Less"
- [ ] Animation smooth (max-height, opacity, 250-300ms)
- [ ] Responsive (2 card desktop, stacked mobile)
- [ ] Alpine.js untuk interactivity
- [ ] ARIA attributes (aria-expanded, aria-controls)
- [ ] Keyboard accessible
- [ ] Build berhasil
- [ ] No warnings
- [ ] Semantic HTML
- [ ] Premium look (minimal design)
- [ ] Not SaaS template
- [ ] Not boring

---

**Analysis Status**: ✅ COMPLETE

**Ready for Implementation**: YES

**Next Step**: Implement Services section revision with 2 expandable cards

