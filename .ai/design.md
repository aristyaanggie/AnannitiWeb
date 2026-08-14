# Desain

Dokumentasi lengkap design system untuk Ananniti Tattoo Bali.
Every element must earn its place.

## Palet Warna

### Color Restriction

Website Ananniti Tattoo hanya menggunakan warna berikut:

- **Black**: #000000, #0a0a0a, #1a1a1a
- **White**: #ffffff, #f5f5f0
- **Neutral Gray**: #333333, #666666, #999999, #e5e5e5

Dilarang menggunakan:

❌ Brown, Gold, Beige, Cream
❌ Blue, Red, Green
❌ Accent Color, Gradient Color

### Warna Utama
- Primary: `#1a1a1a` (dark, untuk buttons dan primary actions)
- Primary Light: `#333333` (hover state)

### Warna Secondary
- Secondary: `#8b7355` (warm brown — hanya untuk design token, BUKAN untuk visual)
- Catatan: Warna secondary TIDAK digunakan di UI karena color restriction

### Warna Netral
- Background: `#fafafa` (page background)
- Surface: `#ffffff` (card background)
- Border: `#e5e5e5` (borders)

### Warna Text
- Text Primary: `#1a1a1a` (black)
- Text Secondary: `#666666` (gray)
- Text Muted: `#999999` (light gray)

### Warna Navbar
- Navbar Background: `#0a0a0a` (dark)
- Navbar Text: `#f5f5f0` (warm white)

### Warna Dark Sections
- Section Background: `#0a0a0a` (hitam)
- Card Background: `bg-white/[0.02]` atau `bg-[#141414]` (subtle)
- Text: White dengan opacity variants (`text-white`, `text-white/90`, `text-white/70`, `text-white/60`, `text-white/50`, `text-white/40`)

### Warna Status
- Success: `#10b981`
- Error: `#ef4444`
- Warning: `#f59e0b`
- Info: `#3b82f6`

### Kontras Visual

Kontras visual dibangun menggunakan:
- Photography
- White Space
- Typography
- Opacity
- Scale

Bukan menggunakan warna.

## Tipografi

### Font Families
- **Heading**: Playfair Display (serif, elegant)
- **Body**: Inter (sans-serif, readable)

### Font Sizes (Tailwind Scale)
```
xs   = 0.75rem (12px)
sm   = 0.875rem (14px)
base = 1rem (16px)
lg   = 1.125rem (18px)
xl   = 1.25rem (20px)
2xl  = 1.5rem (24px)
3xl  = 1.875rem (30px)
4xl  = 2.25rem (36px)
5xl  = 3rem (48px)
6xl  = 3.75rem (60px)
```

### Heading Hierarchy
- H1: `text-5xl md:text-6xl` — Page titles
- H2: `text-4xl md:text-5xl` — Major sections
- H3: `text-2xl md:text-3xl` — Subsections
- H4: `text-xl md:text-2xl` — Small sections
- H5: `text-lg md:text-xl` — Minor headings
- H6: `text-base` — Labels

### Font Weights
- Regular: 400 (body text)
- Medium: 500 (secondary headings)
- Semibold: 600 (headings, emphasis)
- Bold: 700 (strong emphasis, main headings)

### Line Heights
- Headings: 1.2
- Body: 1.6
- Relaxed: 1.625 (review text, descriptions)

## Spacing

### Base Unit
4px (Tailwind default)

### Spacing Scale
```
0    = 0px
1    = 4px
2    = 8px
3    = 12px
4    = 16px
6    = 24px
8    = 32px
10   = 40px
12   = 48px
16   = 64px
20   = 80px
24   = 96px
32   = 128px
40   = 160px
48   = 192px
64   = 256px
```

### Section Spacing
- Small sections: `py-16 md:py-24`
- Medium sections: `py-24 md:py-36`
- Large sections: `py-32 md:py-48 lg:py-64`
- Hero/Trust Section: `py-24 md:py-36 lg:py-48`

## Components

### UI Components (Implemented)
- **Button**: Primary (black), Secondary (white), sizes sm/md/lg
- **Button with Icon**: Button + Lucide icon (MessageCircle)
- **Link**: Styled link dengan focus states

### Layout Components (Implemented)
- **Container**: max-w-6xl, responsive padding
- **Section**: Spacing wrapper (sm/md/lg)
- **Section Title**: Title + optional subtitle + alignment
- **Navbar**: Sticky, dark theme, responsive, Alpine.js mobile menu
- **Footer**: 4-column layout, editorial luxury

### Design Patterns
- **Editorial Layout**: Photography dominant, typography supporting
- **Dark Sections**: #0a0a0a background, white text
- **Card Styling**: border border-white/10, rounded, bg-white/[0.02]
- **Hover Effects**: Border change, opacity change (200-250ms)

## Responsive Design

### Breakpoints (Tailwind Default)
```
sm   = 640px   (phones in landscape)
md   = 768px   (tablets)
lg   = 1024px  (small laptops)
xl   = 1280px  (laptops)
2xl  = 1536px  (large monitors)
```

### Mobile First Approach
1. Design untuk mobile first
2. Add complexity ketika screen size increases
3. Gunakan breakpoint prefixes: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`

### Responsive Grid Patterns
- **1 column**: Mobile (`grid-cols-1`)
- **2 columns**: Tablet (`sm:grid-cols-2`)
- **3 columns**: Desktop (`md:grid-cols-3`)
- **4 columns**: Large desktop (`md:grid-cols-4`)

## Animation & Transitions

### Duration
- Micro interactions: 150-200ms
- Transitions: 200-300ms
- Page transitions: 300ms

### Easing
- Enter: `ease-out`
- Leave: `ease-in`
- Interactive: `ease-out`

### CSS Animations (app.css)
- `fadeInUp`: 300ms, fade + slide up
- `fadeIn`: 300ms, pure fade
- Delay utilities: `.delay-100` to `.delay-500`

### Motion Preference
```css
@media (prefers-reduced-motion: reduce) {
  .animate-fadeInUp, .animate-fadeIn {
    animation: none;
    opacity: 1;
  }
}
```

## Accessibility

### WCAG Compliance
- Target: WCAG AA minimum
- Color contrast: 4.5:1 minimum untuk text
- Focus states: Ring-2 ring-offset-2 pada semua interactive elements
- Keyboard navigation: Semua interactive elements accessible
- Alt text: Semua images memiliki descriptive alt text
- Semantic HTML: `<section>`, `<nav>`, `<footer>`, `<h1>`-`<h6>`, `<img>`

### Focus States
- Ring-2 ring-offset-2 pada buttons, links, form elements
- Ring color: primary color
- Visible dan konsisten

## Brand Guidelines

### Brand Voice
- Professional namun approachable
- Knowledgeable dan trustworthy
- Passionate tentang tattoo art
- Respectful terhadap customer autonomy
- Clear dan direct

### Photography Style
Photography adalah identitas utama website.

Semua Hero menggunakan:
- Fullscreen Background Image
- Object Cover
- Object Center
- Dark Overlay
- High Contrast
- Natural Color

Jangan menggunakan image di dalam card.
Jangan menggunakan image kecil.
Jangan menggunakan ilustrasi.
Jangan menggunakan stock photo yang terlihat generik.
Photography harus terasa nyata dan profesional.

### Logo
- Placeholder: "AT" dalam box
- Background: `bg-white/10`
- Text: White, font-bold
- Size: 36px-48px

### Visual Philosophy
- Editorial luxury (bukan SaaS, bukan template)
- Photography dominant
- Typography supporting
- Whitespace sebagai elemen utama
- Minimal, confident, authentic

## Icon Rules

Gunakan Lucide React sebagai satu-satunya sumber icon.

Aturan:
- Jangan menggunakan Heroicons, Font Awesome, Bootstrap Icons, SVG random
- Gunakan icon seminimal mungkin
- Icon hanya digunakan apabila benar-benar membantu UX
- Ukuran: 16px-24px (w-4 h-4 hingga w-6 h-6)
- Color: inherit dari parent (currentColor)
- Stroke-based (bukan filled)

---

**Last Updated**: 2026-07-24
**Status**: Design system finalized melalui Sprint 00-39
