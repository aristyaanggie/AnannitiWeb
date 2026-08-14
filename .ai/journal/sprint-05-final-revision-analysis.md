# Sprint 05 — Services Section (Final Revision Analysis)

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. Ringkasan Analisis

Final Revision Sprint 05 memiliki requirement yang jauh lebih detail dan spesifik dibanding revision sebelumnya. Fokus utama adalah **visual design precision** dan **user interaction polish**.

**Key New Requirements (vs Previous Revision):**
1. Icons HARUS di atas title (Lucide React: Building2/Store untuk Studio, House untuk Home)
2. Card background LEBIH TERANG dari section background
3. Border: 1px (bukan 2px), neutral gray
4. Radius: 4px (bukan lg/rounded-lg)
5. Hover: Background + Border lebih terang (bukan scale)
6. Button dengan icon: "Learn More →" dan "Show Less ▲"
7. Chevron HARUS rotate smooth (0° → 180°)
8. Spacing lebih lega (whitespace design principle)
9. Section background: Dark (contoh #0A0A0A), card background: Lighter (contoh #171717)

---

## 2. Current Implementation Issues

### What Needs to Change

❌ **Border**: Currently 2px → Should be 1px
❌ **Border Color**: Currently black → Should be neutral gray
❌ **Radius**: Currently rounded-lg (8px) → Should be 4px
❌ **Icons**: Not implemented → Must add Lucide icons above title
❌ **Button Text**: "Learn More" only → Should be "Learn More →" with icon
❌ **Chevron**: Not implemented → Should rotate on expand
❌ **Card Background**: Same as section → Should be lighter
❌ **Section Background**: Light (surface) → Should be darker (optional, per requirement)
❌ **Hover**: No visual change → Should have background + border lighter
❌ **Spacing**: Could be more lega → Increase whitespace

### What's Already Good

✅ 2 cards only
✅ Expand/collapse works
✅ Alpine.js implementation
✅ Responsive layout
✅ ARIA attributes
✅ Semantic HTML

---

## 3. Detailed Specification Analysis

### Icon Requirements

**Studio Service Icon:**
- Lucide: `Building2` or `Store`
- Size: 20-24px (w-5 h-5 or w-6 h-6)
- Color: Inherit text (text-text-primary)
- Position: Above title
- No background, no circle, no box

**Home Service Icon:**
- Lucide: `House`
- Size: 20-24px
- Color: Inherit text
- Position: Above title
- No background, no circle, no box

**Implementation:**
```blade
<svg class="w-6 h-6 text-text-primary mb-3">
  <!-- Lucide icon -->
</svg>
```

### Card Background Color

**Current Issue:** Card background same as section (bg-surface = #ffffff)

**Requirement:**
- Section background: Darker (optional, example #0A0A0A or use design token)
- Card background: Lighter than section (example #171717 or use bg-surface)

**If Dark Section:**
- Section: bg-text-primary (#1a1a1a) or custom dark
- Card: bg-surface (#ffffff) or lighter gray

**Current Setup (Light Section):**
- Section: bg-surface (#ffffff)
- Card: Should be slightly different or maintain same but with border distinction

**Recommendation:** Keep card bg-surface, focus on border quality instead

### Border Specification

**Current:** border-2 border-text-primary (2px black)

**New Spec:**
- Width: 1px (border-1 or custom)
- Color: Neutral gray (text-text-muted #999999 or lighter gray)
- Hover: Border slightly darker or more opaque

**Tailwind Issue:** Tailwind doesn't have border-1 by default

**Solution:**
```css
/* Add to app.css */
.border-thin {
  border-width: 1px;
}

/* Or use Tailwind's border class (1px default) */
.border {
  border-width: 1px;
}
```

### Radius Specification

**Current:** rounded-lg (8px)

**New Spec:** 4px (smaller, more minimal)

**Tailwind:** Use `rounded` (4px) instead of `rounded-lg`

### Button with Icon

**Current:** "Learn More" text only

**New Spec:**
- Collapsed: "Learn More →" (with right arrow, ArrowRight icon)
- Expanded: "Show Less ▲" (with chevron up, ChevronUp icon)

**Icon Behavior:**
- ArrowRight: Static
- ChevronUp: Rotates 180° on expand → 0° on collapse

**Implementation:**
```blade
<button @click="expanded = !expanded" ...>
  <span x-text="expanded ? 'Show Less' : 'Learn More'" />
  <svg 
    :class="expanded ? 'rotate-180' : 'rotate-0'"
    class="inline w-4 h-4 ml-1 transition-transform duration-300"
  >
    <!-- ChevronDown icon (rotates to ChevronUp) -->
  </svg>
</button>
```

### Hover State

**Current:** hover:border-text-primary (border color stays same)

**New Spec:**
- Background: Slightly lighter (opacity or lighter gray)
- Border: Slightly lighter (gray instead of black)
- Transition: 200ms

**Implementation:**
```blade
class="bg-surface hover:bg-opacity-80 border border-text-muted hover:border-text-primary transition-all duration-200"
```

---

## 4. Implementation Changes Required

### Change 1: Add Lucide Icons

**Location:** Above each card title

**Studio Service:**
```blade
<div class="mb-3">
  <svg class="w-6 h-6 text-text-primary">
    <!-- Building2 or Store icon from Lucide -->
  </svg>
</div>
```

**Home Service:**
```blade
<div class="mb-3">
  <svg class="w-6 h-6 text-text-primary">
    <!-- House icon from Lucide -->
  </svg>
</div>
```

### Change 2: Update Border Styling

**From:**
```blade
class="border-2 border-text-primary rounded-lg"
```

**To:**
```blade
class="border border-text-muted rounded hover:border-text-primary"
```

### Change 3: Add Icon to Button

**From:**
```blade
<span x-text="expanded ? 'Show Less' : 'Learn More'" />
```

**To:**
```blade
<span x-text="expanded ? 'Show Less' : 'Learn More'" />
<svg 
  :class="expanded ? 'rotate-180' : 'rotate-0'"
  class="inline w-4 h-4 ml-1 transition-transform duration-300"
>
  <!-- ChevronDown icon -->
</svg>
```

### Change 4: Update Hover State

**Add to card classes:**
```blade
hover:bg-gray-50 hover:border-text-primary
```

### Change 5: Increase Spacing/Whitespace

- Increase padding: p-6 md:p-8 → p-8 md:p-10
- Increase gaps: gap-8 md:gap-12 → gap-12 md:gap-16
- Increase title margin: mb-4 → mb-6

---

## 5. Lucide Icon Implementation

### Required Icons

**Studio Service:**
```
Icon: Building2 or Store (showroom/studio icon)
Size: 24px (w-6 h-6)
SVG data can be obtained from: https://lucide.dev/
```

**Home Service:**
```
Icon: House (home location)
Size: 24px (w-6 h-6)
SVG data can be obtained from: https://lucide.dev/
```

**Chevron Down (for button, rotates on expand):**
```
Icon: ChevronDown (rotates 180° when expanded)
Size: 16px (w-4 h-4)
Animation: rotate-0 to rotate-180 on expand
```

### SVG Implementation (Inline)

Since project uses inline SVGs (no Lucide React component), we'll use SVG paths:

**Building2 Icon:**
```svg
<svg class="w-6 h-6 text-text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
    d="M3 21h18M3 7v10a6 6 0 006 6h6a6 6 0 006-6V7M7 3h10a2 2 0 012 2v4H5V5a2 2 0 012-2z"></path>
</svg>
```

**House Icon:**
```svg
<svg class="w-6 h-6 text-text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
    d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4"></path>
</svg>
```

**ChevronDown Icon:**
```svg
<svg class="w-4 h-4 text-text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
</svg>
```

---

## 6. Acceptance Criteria Detailed

- [ ] Hanya terdapat 2 card ✅ (already done)
- [ ] Card dapat expand ✅ (already done)
- [ ] Icon Lucide di atas title ❌ (NEW - need to add)
- [ ] Border 1px, neutral gray ❌ (need to change from 2px black)
- [ ] Radius 4px ❌ (need to change from 8px)
- [ ] Button dengan arrow icon ❌ (need to add)
- [ ] Chevron rotate smooth ❌ (need to add)
- [ ] Hover: background + border lighter ❌ (need to add)
- [ ] Spacing lega ❌ (need to increase)
- [ ] Expand smooth ✅ (already done)
- [ ] Responsive ✅ (already done)
- [ ] Build berhasil ✅ (already done)
- [ ] No warnings ✅ (already done)
- [ ] Semantic HTML ✅ (already done)
- [ ] WCAG AA ✅ (already done)

---

## 7. Implementation Order

### Priority 1 (Visual Changes)
1. Add Lucide icons above titles
2. Change border from 2px → 1px
3. Change border color to neutral gray
4. Change radius from lg → 4px
5. Add hover state (background + border)

### Priority 2 (Interaction Polish)
6. Add arrow icon to button
7. Add chevron to button with rotation
8. Ensure smooth rotation animation

### Priority 3 (Spacing)
9. Increase card padding
10. Increase grid gaps
11. Increase margins for whitespace

---

**Analysis Status**: ✅ COMPLETE

**Changes Required**: 7 major changes

**Ready for Implementation**: YES

**Next Step**: Implement Final Revision changes with detailed specifications

