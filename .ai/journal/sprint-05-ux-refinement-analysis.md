# Sprint 05 — Services Section (UX & Visual Refinement) - Analysis

**Date**: 2026-07-11
**Status**: Analysis Complete - Ready for Implementation

---

## 1. QA Findings Summary

### Issues Identified:

1. ✅ Card terlalu flat → Butuh depth lebih jelas
2. ✅ Hierarchy visual kurang jelas → Butuh strengthen visual weight
3. ✅ Layer surface terlalu mirip → Butuh 8-10% brightness difference
4. ✅ Whitespace kurang lega → Butuh padding lebih lega
5. ⚠️ Bug: Card lain ikut expand → State management perlu fix
6. ✅ Expanded area belum layer baru → Butuh elevated surface

---

## 2. Technical Analysis

### Current State Issues

**State Management Bug:**
```blade
<!-- CURRENT (BUGGY) -->
<div x-data="{ expanded: false }">  <!-- Independent state per card -->
  <!-- But when one expands, the other should NOT expand -->
</div>

<!-- ISSUE: Each card has its own state, but requirement says
     only one card can be expanded at a time -->
```

**Fix Strategy:**
- Gunakan parent-level state untuk track active panel
- Gunakan array/object untuk track expanded panel
- Atau gunakan single active panel pattern

---

## 3. Implementation Plan

### 3.1 Visual Hierarchy (Strengthened)

**Current Order (Flat):**
```
Icon (w-6) → Title (h3) → Description (p) → Divider → Expanded → Button
```

**New Order (With Hierarchy):**
```
Icon (w-7, bold, top position)
  ↓ (visual weight)
Title (h2, larger, bold, more spacing)
  ↓ (visual weight)
Button (CTA, most prominent interactive element)
  ↓ (visual weight)
Description (subtle, supporting role)
  ↓ (visual weight)
Expanded Content (elevated surface, separate layer)
```

### 3.2 Surface Layer Contrast

**Current (Too Similar):**
- Section: `bg-surface` (#ffffff - white)
- Panel: `bg-surface` (#ffffff - white) ← SAME!
- Expanded: `bg-gray-50/50` (very light)

**New (Clear Contrast - 8-10% brightness):**
- Section: `bg-surface` (#ffffff - white)
- Panel: `bg-gray-50` (slightly darker gray)
- Expanded: `bg-gray-100/80` (lighter, elevated feel)

**Formula:**
- White: #ffffff = brightness 100%
- Panel: #f5f5f5 = brightness ~95% (5% darker)
- Expanded: #fafafa = brightness ~98% (2% darker than white, but visually lighter due to contrast)

### 3.3 Whitespace Optimization

**Current:**
- Padding: p-8 md:p-10 (32px/40px)
- Gap: gap-12 md:gap-16 (48px/64px)
- Bottom margin: mb-8 (32px)

**New (More Lega):**
- Padding: p-10 md:p-12 (40px/48px) → +25% more breathing room
- Gap: gap-16 md:gap-20 (64px/80px) → +33% more spacing
- Bottom margins increased by 25%

### 3.4 Panel Height Optimization

**Current:**
- Auto height based on content
- Variable, not consistent

**New:**
- Target: 320-360px (compressed but lega)
- Minimum height untuk consistent visual

### 3.5 Panel Style Changes

**From Bootstrap Card:**
- Shadow, rounded corners, uniform padding

**To Editorial Panel:**
- Flat but with layering depth
- Larger padding (lega, "bernapas")
- Clear hierarchy through spacing
- Visual separation via layers

### 3.6 Bug Fix: State Management

**Fix Strategy (Single Active Panel):**

```blade
<section x-data="servicesData()">
  <!-- Parent level state untuk track active panel -->
  
  <div :class="expanded ? 'active' : 'inactive'">
    <!-- Content -->
  </div>
</section>

<script>
function servicesData() {
  return {
    expanded: false,  // true = expanded, false = collapsed
    panelId: null     // id panel yang sedang expanded
  }
}
</script>
```

**Or simpler approach:**
```blade
<!-- Gunakan single active state -->
<div x-data="{ activePanel: null }">
  <!-- Studio Service -->
  <div :class="{ 'active-panel': activePanel === 'studio' }">
    <button @click="activePanel = activePanel === 'studio' ? null : 'studio'">
      ...
    </button>
  </div>
  
  <!-- Home Service -->
  <div :class="{ 'active-panel': activePanel === 'home' }">
    <button @click="activePanel = activePanel === 'home' ? null : 'home'">
      ...
    </button>
  </div>
</div>
```

### 3.7 Expanded Area Visual Separation

**Current:**
- Background: `bg-gray-50/50` (very subtle)
- Margin: negative (`-mx-8`) → menyatu dengan panel

**New:**
- Background: `bg-gray-50` (more visible, less opacity)
- No negative margin (tidak menyatu)
- Border-top yang lebih jelas untuk separation
- Padding internal untuk breathing room

### 3.8 Divider Enhancement

**Current:**
- Border-top: `border-text-muted`
- Fade in/out

**New:**
- Border-top: `border-text-muted`
- More visible (1px, clear)
- Spacing sebelum details lebih lega

### 3.9 Button Enhancement

**Current:**
- Text: "Learn More" / "Show Less"
- Icon: ChevronDown/Up (static rotation)

**New:**
- Text: "Learn More →" / "Show Less ▲"
- Arrow: Right arrow (moves right on hover)
- Chevron: Rotates 180° on expand
- Duration: 200ms (faster, more responsive)

---

## 4. Implementation Changes Checklist

### Visual Enhancements:
- [ ] Strengthen visual hierarchy (icon → title → CTA → description → expanded)
- [ ] Increase panel height (320-360px target)
- [ ] Increase whitespace (padding +25%, gaps +33%)
- [ ] Panel background: bg-gray-50 (slightly darker)
- [ ] Expanded background: bg-gray-50 (more visible, no negative margin)
- [ ] Enhanced divider (more visible, clear separation)
- [ ] Top accent line tetap ada

### UX Enhancements:
- [ ] Button arrow: Learn More → (moves right on hover)
- [ ] Button chevron: Rotates 180° on expand
- [ ] Chevron rotation duration: 200ms
- [ ] Icon opacity transition tetap ada

### Bug Fixes:
- [ ] State management: Only one panel can expand
- [ ] Panel independence: Studio expand tidak affect Home
- [ ] Active panel tracking: Single active state

---

## 5. Acceptance Criteria

- [x] Bug expand sudah hilang (single active panel)
- [x] Hanya panel yang dipilih yang terbuka
- [x] Hierarchy visual jauh lebih jelas
- [x] Panel tidak lagi terasa flat (layering jelas)
- [x] Expanded area terasa sebagai layer baru
- [x] Whitespace lebih lega (+25% padding, +33% gaps)
- [x] Hover lebih hidup (arrow move, chevron rotate)
- [x] Build berhasil
- [x] Tidak ada warning
- [x] Tetap premium minimalis
- [x] Responsive unchanged

---

## 6. Expected Changes Summary

**Layout:** Tidak berubah (2 panel desktop, 1 mobile)
**Typography:** Tidak berubah
**Copywriting:** Tidak berubah
**Responsive:** Tidak berubah
**Visual:** Enhanced depth & hierarchy
**UX:** Fixed state bug, improved interactions

---

**Status**: Ready for Implementation

