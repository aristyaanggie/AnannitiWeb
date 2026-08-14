# Context - Responsive Design

Responsive design guidelines untuk Ananniti Tattoo Bali.

## Breakpoints

Tailwind CSS default breakpoints:

```
sm   = 640px   (Small devices - phones in landscape)
md   = 768px   (Medium devices - tablets)
lg   = 1024px  (Large devices - small laptops)
xl   = 1280px  (Extra large - laptops)
2xl  = 1536px  (2X large - large monitors)
```

## Mobile First Approach

1. Design untuk mobile first
2. Add complexity ketika screen size increases
3. Gunakan breakpoint prefixes: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`

Contoh:
```html
<!-- Mobile: full width, Tablet: 50%, Desktop: 33% -->
<div class="w-full md:w-1/2 lg:w-1/3">
  Content
</div>
```

## Responsive Typography

```html
<!-- Scale text berdasarkan screen size -->
<h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
  Heading
</h1>

<p class="text-sm sm:text-base md:text-lg">
  Body text
</p>
```

## Responsive Spacing

```html
<!-- Different padding pada different screens -->
<section class="px-4 sm:px-6 md:px-8 lg:px-12 py-8 md:py-12 lg:py-16">
  Content
</section>
```

## Responsive Grids

```html
<!-- Mobile: 1 col, Tablet: 2 cols, Desktop: 3 cols -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
  <!-- Items -->
</div>
```

## Responsive Images

```html
<!-- Different image sizes untuk different screens -->
<img 
  srcset="
    image-small.jpg 640w,
    image-medium.jpg 1024w,
    image-large.jpg 1920w
  "
  sizes="
    (max-width: 640px) 100vw,
    (max-width: 1024px) 90vw,
    1200px
  "
  src="image-medium.jpg"
  alt="Description"
  class="w-full h-auto"
/>
```

## Responsive Navigation

```html
<!-- Mobile: hamburger menu, Desktop: full nav -->
<nav>
  <!-- Mobile menu button -->
  <button class="md:hidden" @click="menuOpen = !menuOpen">
    Menu
  </button>
  
  <!-- Desktop navigation -->
  <ul class="hidden md:flex space-x-6">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
  </ul>
</nav>
```

## Responsive Hide/Show

```html
<!-- Hide pada mobile, show pada desktop -->
<div class="hidden md:block">
  Desktop only content
</div>

<!-- Show pada mobile, hide pada desktop -->
<div class="md:hidden">
  Mobile only content
</div>
```

## Container Queries

[TO BE DEFINED] - Jika menggunakan container queries di future

## Flexible Layouts

### Flexbox
```html
<div class="flex flex-col md:flex-row gap-4">
  <div class="md:w-1/3">Sidebar</div>
  <div class="md:w-2/3">Content</div>
</div>
```

### Grid
```html
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Items automatically layout -->
</div>
```

## Touch-Friendly Design

Mobile considerations:
- Minimum touch target: 44x44px
- Button padding: p-3 atau p-4
- Spacing between buttons: m-2 atau m-3
- Large clickable areas
- Hindari hover-only interactions

## Performance pada Mobile

- Optimize images untuk mobile
- Minimize JavaScript bundles
- Gunakan media queries efficiently
- Lazy load off-screen content
- Optimize font loading

## Testing Responsive Design

### Viewport Sizes untuk Test
- iPhone SE: 375px
- iPhone 12: 390px
- iPad Mini: 768px
- iPad Pro: 1024px
- Desktop: 1920px

### Tools
- Chrome DevTools device emulation
- Physical device testing
- Browser extensions seperti Responsively

## Landscape/Portrait

```html
<!-- Portrait orientation -->
<div class="landscape:hidden">
  Portrait content
</div>

<!-- Landscape orientation -->
<div class="hidden landscape:block">
  Landscape content
</div>
```

## Orientation Detection

```html
<!-- Mobile landscape memiliki limited height -->
<nav class="landscape:h-12 portrait:h-16">
  Navigation
</nav>
```

## Print Styles

```html
<!-- Hide pada print -->
<nav class="print:hidden">Navigation</nav>

<!-- Show hanya pada print -->
<div class="hidden print:block">Print only content</div>
```

## Accessibility pada Mobile

- Large enough text (minimum 16px)
- Sufficient color contrast
- Large touch targets
- Focus indicators
- Mobile screen reader support

## Common Responsive Patterns

### Hero Section
```html
<section class="h-screen md:h-96 bg-cover bg-center">
  Content
</section>
```

### Two Column Layout
```html
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  <aside class="lg:col-span-1">Sidebar</aside>
  <main class="lg:col-span-2">Content</main>
</div>
```

### Card Grid
```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
  <!-- Cards -->
</div>
```

## References

- Tailwind responsive design: https://tailwindcss.com/docs/responsive-design
- MDN responsive design: https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design
