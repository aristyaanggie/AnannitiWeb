# Context - Spacing

Spacing guidelines untuk layout consistency di Ananniti Tattoo Bali.

## Spacing Scale

Tailwind CSS default spacing scale:

```
0    = 0px
1    = 0.25rem (4px)
2    = 0.5rem (8px)
3    = 0.75rem (12px)
4    = 1rem (16px)
6    = 1.5rem (24px)
8    = 2rem (32px)
12   = 3rem (48px)
16   = 4rem (64px)
20   = 5rem (80px)
24   = 6rem (96px)
```

## Common Spacing Patterns

### Padding
- **Small components**: p-2 ke p-3
- **Medium components**: p-4 ke p-6
- **Large components**: p-8 ke p-12
- **Sections**: p-12 ke p-24

### Margin
- **Between elements**: m-2 ke m-4
- **Between sections**: m-8 ke m-16
- **Between sections (vertical)**: my-12 ke my-24

### Gap (Flexbox/Grid)
- **Tight spacing**: gap-2
- **Normal spacing**: gap-4
- **Loose spacing**: gap-6 ke gap-8
- **Section spacing**: gap-12 ke gap-16

## Layout Spacing

### Container
- Max width: max-w-7xl
- Horizontal padding: px-4 ke px-8
- Vertical padding: py-12 ke py-24

### Grid
- Column gap: gap-4 ke gap-6
- Row gap: gap-6 ke gap-8

### Form Elements
- Input height: h-10 (40px) atau h-12 (48px)
- Between form fields: mb-4 ke mb-6
- Between form sections: mb-8

### Section Spacing
- Between hero dan next section: my-16 ke my-24
- Between sections: my-12 ke my-20
- Between subsections: my-8 ke my-12

## Responsive Spacing

Gunakan breakpoint prefixes untuk responsive spacing:

```html
<!-- Different spacing pada mobile/desktop -->
<div class="px-4 md:px-8 lg:px-12">
  <section class="my-12 md:my-16 lg:my-24">
  </section>
</div>
```

## Consistency Rules

- Always gunakan spacing scale, hindari random values
- Maintain consistent spacing between components
- Gunakan multiples dari base unit (4px)
- Increase spacing di larger breakpoints
- Gunakan negative margin sparingly

## Whitespace Strategy

- Generous whitespace untuk premium feel
- Breathing room around content
- Clear visual hierarchy through spacing
- Hindari cramped layouts

## References

- Tailwind spacing docs: https://tailwindcss.com/docs/padding
- Tailwind margin docs: https://tailwindcss.com/docs/margin
- Tailwind gap docs: https://tailwindcss.com/docs/gap
