# UI Components

Inventory dan dokumentasi UI components Ananniti Tattoo Bali.

**Last Updated**: 2026-07-24
**Based on**: v12.0.0 (Sprint 39 — Tattoo Supply CMS Complete)

## Component Architecture

```
resources/views/components/
├── ui/                    # Basic UI components (5 files)
├── layout/                # Layout components (5 files)
├── shop/                  # Shop components (3 files)
└── icon/                  # Icon components (3 files)
```

Total: **16 reusable Blade components**

---

## UI Components

### Button (`components/ui/button.blade.php`)
**Status**: ✅ IMPLEMENTED

Variants:
- Primary (black background, white text)
- Secondary (white background, black text)

Sizes: sm, md, lg

Props (via @props):
- `variant` — primary | secondary (default: primary)
- `size` — sm | md | lg (default: md)
- `href` — URL for link button (optional)

States: normal, hover (scale 1.02), active (scale 0.98), focus (ring-2)

### Button with Icon (`components/ui/button-with-icon.blade.php`)
**Status**: ✅ IMPLEMENTED

Combines button + Lucide icon component.

Props (via @props):
- `variant` — primary | secondary (default: primary)
- `size` — sm | md | lg (default: md)
- `icon` — icon component name (default: 'message-circle')
- `iconSize` — icon size class (default: 'w-5 h-5')
- `href` — URL for link button (optional)

### Link (`components/ui/link.blade.php`)
**Status**: ✅ IMPLEMENTED

Styled link dengan focus states dan optional external icon.

Props (via @props):
- `href` — URL (required)
- `external` — boolean, open in new tab (default: false)

### Delete Modal (`components/ui/delete-modal.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 14.11, updated Sprint 19)

Delete confirmation modal dengan dynamic action label.

Props (via @props):
- `id` — modal identifier (required)
- `title` — modal title (default: 'Confirm Delete')
- `message` — confirmation message (required)
- `action` — delete URL/route (required)
- `actionLabel` — button label (default: 'Delete')

### Status Badge (`components/ui/status-badge.blade.php`)
**Status**: ✅ IMPLEMENTED

Reusable badge untuk status indicators.

Props (via @props):
- `status` — status string (required)
- `type` — badge type/category (default: 'default')

Color mapping: pending (yellow), confirmed (green), completed (blue), cancelled (red), published (green), draft (gray).

---

## Layout Components

### Navbar (`components/layout/navbar.blade.php`)
**Status**: ✅ IMPLEMENTED

Sticky dark navbar dengan Alpine.js mobile menu.

Features:
- Dark theme (#0a0a0a background, #f5f5f0 text)
- Logo placeholder (AT box)
- Center navigation (desktop)
- Mobile hamburger menu (Alpine.js)
- Sticky positioning (z-50)
- CTA: "Consult via WhatsApp" + "View Our Works"

Menu items: Home, Services, Shop, Gallery, Artists

### Footer (`components/layout/footer.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 11)

4-column editorial luxury footer.

Sections:
1. Brand (logo + name + description)
2. Quick Links (6 anchor links)
3. Studio Information (address, hours, phone, email)
4. Connect (Instagram, WhatsApp, TikTok, Facebook)
5. Bottom Bar (copyright + "Made with passion in Bali")

Responsive: 4 columns → 2×2 → 1 column

### Container (`components/layout/container.blade.php`)
**Status**: ✅ IMPLEMENTED

Responsive container: max-w-6xl, responsive horizontal padding.

### Section (`components/layout/section.blade.php`)
**Status**: ✅ IMPLEMENTED

Section spacing wrapper with variants: sm, md, lg.

### Section Title (`components/layout/section-title.blade.php`)
**Status**: ✅ IMPLEMENTED

Section title + optional subtitle + alignment.

Props (via @props):
- `title` — section title (required)
- `subtitle` — optional subtitle
- `align` — left | center | right (default: 'center')
- `size` — sm | md | lg (default: 'md')

---

## Shop Components

### Product Card (`components/shop/product-card.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 12.1)

Reusable product card.

Props (via @props):
- `image` — product image path
- `title` — product name
- `category` — category name
- `price` — formatted price
- `badge` — optional badge text
- `href` — link to product detail

Features:
- Responsive image with lazy loading
- Badge display
- Price formatting with Rp currency (Sprint 19 fix)
- Hover effects (scale, border)

### Category Filter (`components/shop/category-filter.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 12.2)

Alpine.js-powered horizontal category filter.

Props (via @props):
- `categories` — array of categories
- `active` — currently active category slug

Features:
- Horizontal scroll on mobile
- aria-pressed states
- Alpine.js state management

### Loading Skeleton (`components/shop/loading-skeleton.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 12.7)

Loading placeholder for product grids.

Props (via @props):
- `count` — number of skeleton items (default: 6)

---

## Icon Components

### Message Circle (`components/icon/message-circle.blade.php`)
**Status**: ✅ IMPLEMENTED

Lucide MessageCircle icon with size variants.

Props: size (sm = 16px, md = 20px, lg = 24px)

### WhatsApp (`components/icon/whatsapp.blade.php`)
**Status**: ✅ IMPLEMENTED

WhatsApp icon.

### Instagram (`components/icon/instagram.blade.php`)
**Status**: ✅ IMPLEMENTED

Instagram icon.

---

## Admin Components

### Admin Layout (`layouts/admin.blade.php`)
**Status**: ✅ IMPLEMENTED (Sprint 14.6)

Admin layout with sidebar navigation.

Features:
- Sidebar with Lucide icons
- Active state indicators
- Responsive: sidebar → top nav on mobile
- Stats dashboard
- Quick actions

### Public Layout (`layouts/app.blade.php`)
**Status**: ✅ IMPLEMENTED

Public layout with navbar + footer components.

---

## Component States

### Interactive States (Implemented)
- Default
- Hover (scale, color change)
- Active (scale down)
- Focused (ring-2 ring-offset-2)
- Disabled

### Data States (Implemented)
- Empty state (all admin pages)
- Loading state (skeleton components)

---

## Accessibility

- [x] Keyboard navigation on all interactive elements
- [x] ARIA labels on mobile menu
- [x] aria-pressed on category filter
- [x] Focus indicators (ring-2 ring-offset-2)
- [x] Semantic HTML throughout
- [x] Color contrast WCAG AA

## Naming Convention

- File: kebab-case (`button.blade.php`, `product-card.blade.php`)
- Usage: `<x-ui.button />`, `<x.shop.product-card />`
- Namespace: folder-based (`ui.`, `layout.`, `shop.`, `icon.`)
