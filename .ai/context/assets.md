# Context - Assets

Assets management guidelines untuk Ananniti Tattoo Bali.

## Struktur Direktori Asset

```
resources/assets/
├── images/
│   ├── logos/
│   │   ├── logo-full.png
│   │   ├── logo-icon.png
│   │   └── logo-dark.png
│   ├── backgrounds/
│   │   ├── hero-bg.jpg
│   │   ├── pattern-1.png
│   │   └── gradient-1.svg
│   ├── icons/
│   │   ├── arrow.svg
│   │   ├── menu.svg
│   │   └── search.svg
│   └── photos/
│       ├── team/
│       ├── portfolio/
│       └── testimonials/
├── icons/
│   └── (SVG icon components atau sprite sheet)
└── logos/
    └── (Logo variations)
```

## Format Gambar

### Web Optimization

- **PNG**: Logos, icons, images dengan transparency
- **JPG/JPEG**: Photographs, complex images
- **SVG**: Icons, logos, illustrations (scalable)
- **WebP**: Modern format untuk optimization (dengan fallbacks)

### Image Specifications

#### Logos
- **Full Logo**: 300x100px minimum, transparent PNG
- **Icon Logo**: 80x80px minimum, transparent PNG
- **Dark Mode**: Separate version jika needed

#### Hero Images
- **Desktop**: 1920x600px (16:9), max 500KB
- **Tablet**: 1024x400px (16:9), max 300KB
- **Mobile**: 640x400px (16:9), max 150KB

#### Portfolio Images
- **Thumbnail**: 400x400px, max 100KB
- **Full Size**: 1200x1200px, max 300KB
- **High Resolution**: 2000x2000px, max 800KB

#### Team Photos
- **Avatar**: 200x200px, max 50KB
- **Full Profile**: 600x700px, max 150KB

## Image Optimization

### Tools & Process

1. **Compress images** sebelum uploading
   - TinyPNG, ImageOptim, atau similar
   - Remove metadata
   - Reduce dimensions

2. **Gunakan responsive images**
   ```html
   <img 
     srcset="image-small.jpg 640w, image-medium.jpg 1024w, image-large.jpg 1920w"
     sizes="(max-width: 640px) 100vw, (max-width: 1024px) 80vw, 1200px"
     src="image-medium.jpg"
     alt="Description"
   />
   ```

3. **Lazy load images**
   ```html
   <img loading="lazy" src="image.jpg" alt="Description" />
   ```

4. **Gunakan WebP dengan fallback**
   ```html
   <picture>
     <source srcset="image.webp" type="image/webp" />
     <img src="image.jpg" alt="Description" />
   </picture>
   ```

## SVG Icons

### Best Practices

- Gunakan SVG untuk icons dan logos (scalable)
- Keep SVG file size minimal
- Gunakan consistent stroke widths
- Gunakan 24x24px atau 32x32px base size
- Single color atau simple multi-color

### SVG Implementation

Inline SVG atau sebagai components:

```html
<!-- Inline SVG -->
<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
  <path d="..." />
</svg>

<!-- SVG Component -->
<x-icons.arrow class="w-6 h-6" />
```

## Font Files

### Web Fonts

- Gunakan Google Fonts atau self-hosted
- Preload critical fonts
- Limit ke 2-3 font families
- Include WOFF2 format

```html
<link rel="preload" as="font" href="/fonts/font.woff2" crossorigin />
```

## Video Assets

[TO BE DEFINED] - Video hosting dan optimization

## Download/Export

### Untuk Development
- Export pada 2x resolution untuk high DPI screens
- Include PNG dan SVG versions
- Provide dark mode variants jika needed

### Untuk Production
- Optimize semua images
- Gunakan CDN untuk image delivery
- Set appropriate cache headers
- Monitor image sizes

## Asset Versioning

Vite handles automatic asset versioning:

```html
<img src="{{ asset('images/logo.png') }}" alt="Logo" />
```

Generates:
```html
<img src="/build/assets/logo-abc123.png" alt="Logo" />
```

## Accessibility

### Image Alt Text

Every image harus memiliki descriptive alt text:

```html
<img src="tattoo.jpg" alt="Black and gray rose tattoo on forearm" />
```

### Alt Text Rules
- Descriptive dan concise
- Include relevant details (style, subject, etc.)
- Jangan mulai dengan "image of" atau "picture of"
- Untuk decorative images: alt=""

## Storage

### Public Storage

Untuk files accessible via URL:

```
storage/app/public/
```

Link storage ke public:
```bash
php artisan storage:link
```

Access di views:
```html
<img src="{{ Storage::url('images/photo.jpg') }}" alt="Photo" />
```

### Private Storage

Untuk files tidak directly accessible

## Performance Budget

- Homepage images: < 2MB total
- Page images: < 1MB total
- Individual image: < 500KB

## Tools

- **Image Compression**: TinyPNG, ImageOptim
- **Icon Creation**: Figma, Illustrator
- **Image Editing**: Photoshop, GIMP, Figma
- **Icon Fonts**: Font Awesome, Heroicons

## CDN Integration

[TO BE DEFINED] - CDN setup untuk image delivery

## References

- MDN Image Optimization: https://developer.mozilla.org/en-US/docs/Web/Performance
- Web.dev Image Optimization: https://web.dev/image-optimization/
