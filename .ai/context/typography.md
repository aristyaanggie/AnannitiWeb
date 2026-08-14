# Context - Tipografi

Typography guidelines untuk Ananniti Tattoo Bali.

## Pemilihan Font

### Heading Font
- [TO BE DEFINED] - Font family
- [TO BE DEFINED] - Font weights
- [TO BE DEFINED] - Line height

### Body Font
- [TO BE DEFINED] - Font family
- [TO BE DEFINED] - Font weights
- [TO BE DEFINED] - Line height

### Code Font
- [TO BE DEFINED] - Monospace font family

## Font Sizes

Menggunakan Tailwind CSS default scale:

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
7xl  = 4.5rem (72px)
8xl  = 6rem (96px)
```

## Typography System

### Headings

- **H1**: text-5xl ke text-6xl, font-bold, gunakan untuk page titles
- **H2**: text-4xl ke text-5xl, font-bold, gunakan untuk major sections
- **H3**: text-2xl ke text-3xl, font-semibold, gunakan untuk subsections
- **H4**: text-xl ke text-2xl, font-semibold, gunakan untuk small sections
- **H5**: text-lg ke text-xl, font-semibold, gunakan untuk minor headings
- **H6**: text-base, font-semibold, gunakan untuk labels

### Body Text

- **Large**: text-lg, line-height: 1.75
- **Normal**: text-base, line-height: 1.6
- **Small**: text-sm, line-height: 1.5
- **Extra Small**: text-xs, line-height: 1.5

### Special

- **Lead/Intro**: text-lg ke text-xl, lighter weight
- **Emphasis**: italic
- **Strong**: font-bold
- **Caption**: text-xs ke text-sm, gray color
- **Quote**: italic, larger size, accent color

## Font Weights

- **Thin**: 100 (rarely used)
- **Light**: 300 (intro text, light labels)
- **Normal**: 400 (body text)
- **Medium**: 500 (secondary headings)
- **Semibold**: 600 (headings, emphasis)
- **Bold**: 700 (strong emphasis, important text)
- **Black**: 900 (rarely used)

## Line Height

- Headings: 1.2 ke 1.3
- Body text: 1.5 ke 1.7
- Large text: 1.4 ke 1.6

## Letter Spacing

- Normal: 0
- Tight: -0.025em (untuk headings)
- Wide: 0.025em ke 0.1em (untuk emphasis)

## Text Colors

- Primary text: [TO BE DEFINED] (usually dark gray atau black)
- Secondary text: [TO BE DEFINED] (gray)
- Muted text: [TO BE DEFINED] (light gray)
- Links: [TO BE DEFINED] (brand color)
- Links hover: [TO BE DEFINED] (darker brand color)

## Text Alignment

- Left align: Default untuk body text
- Center align: Untuk emphasis, headings
- Right align: Untuk specific layouts
- Justified: Hindari untuk readability issues

## Text Transform

- Uppercase: Untuk labels, buttons, emphasis
- Lowercase: [TO BE DEFINED]
- Capitalize: Untuk headings, titles
- None: Default

## Responsive Typography

Scale typography di different breakpoints:

```html
<!-- Contoh: H1 responsive -->
<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold">
  Ananniti Tattoo Bali
</h1>

<!-- Contoh: Body responsive -->
<p class="text-sm md:text-base lg:text-lg">
  Premium tattoo studio
</p>
```

## Accessibility

- Minimum font size: 14px (text-sm) untuk body text
- Maximum line length: 70-80 characters untuk readability
- Sufficient contrast: 4.5:1 untuk normal text
- Line height: Minimum 1.5 untuk body text
- Jangan gunakan color alone untuk convey information

## Usage Guidelines

- Gunakan consistent typography hierarchy
- Limit font families ke 2-3 maximum
- Gunakan generous line height untuk readability
- Ensure sufficient color contrast
- Maintain visual hierarchy through size dan weight
- Gunakan typography untuk guide user attention

## Implementation di Tailwind

Semua typography diimplementasikan menggunakan Tailwind CSS utility classes:

```html
<h1 class="text-5xl font-bold">Main Heading</h1>
<h2 class="text-3xl font-semibold">Section Heading</h2>
<p class="text-base leading-relaxed">Body text</p>
<small class="text-sm text-gray-600">Caption text</small>
```

## References

- Tailwind typography docs: https://tailwindcss.com/docs/font-size
- Tailwind font weight docs: https://tailwindcss.com/docs/font-weight
