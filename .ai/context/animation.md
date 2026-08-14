# Context - Animation

Animation guidelines untuk Ananniti Tattoo Bali.

## Prinsip Animation

1. **Purpose**: Animations harus enhance UX, bukan distract
2. **Performance**: Gunakan GPU-accelerated properties
3. **Consistency**: Maintain consistent timing across app
4. **Accessibility**: Respect prefers-reduced-motion
5. **Clarity**: Animations harus clarify, bukan confuse

## Duration Guidelines

- **Micro interactions**: 100-200ms (hover, focus)
- **Transitions**: 200-400ms (state changes, fades)
- **Full page**: 300-500ms (navigation, modal open)
- **Complex animation**: 500-800ms (elaborate sequences)

## Easing Functions

### Predefined Easing di Tailwind

- `ease-in`: Slow start
- `ease-out`: Slow end
- `ease-in-out`: Slow start dan end
- `ease-linear`: Constant speed

### Usage

- `ease-out`: Untuk elements entering
- `ease-in`: Untuk elements exiting
- `ease-in-out`: Untuk interactive transitions

## Common Transitions

### Fade

```html
<div class="transition-opacity duration-300 ease-out opacity-0 hover:opacity-100">
  Content
</div>
```

### Scale

```html
<button class="transition-transform duration-200 ease-out hover:scale-105">
  Click me
</button>
```

### Slide

```html
<div class="transition-transform duration-300 ease-out transform -translate-x-full hover:translate-x-0">
  Slide in
</div>
```

### Color

```html
<link class="transition-colors duration-300 ease-out text-blue-500 hover:text-blue-700">
  Link
</link>
```

## Transition Properties

Properties yang optimized untuk performance:
- `transform`: Scale, translate, rotate
- `opacity`: Fade in/out
- `background-color`: Color changes
- `color`: Text color changes
- `border-color`: Border color changes

Hindari transitioning:
- `width`, `height` - Gunakan transform scale instead
- `left`, `top` - Gunakan transform translate instead
- `box-shadow` - Performance heavy

## CSS Animations

[TO BE DEFINED] - Custom keyframe animations

```css
@keyframes slideIn {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(0);
  }
}
```

## Loading States

- Skeleton screens untuk content loading
- Spinner animation untuk processing
- Progress bar untuk long operations
- Pulse animation untuk active states

## Hover Effects

- Scale: +5% ke +10%
- Color shift: Slightly darker/lighter
- Shadow enhancement: Add/increase shadow
- Cursor: Show pointer/grab/etc

## Focus States

- Ring highlight (Tailwind ring utilities)
- Scale slightly (1-2%)
- Color shift
- Maintain animation untuk keyboard navigation

## Accessibility

### Respect prefers-reduced-motion

```css
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

### Tailwind support

```html
<div class="motion-reduce:transition-none">
  Content
</div>
```

## Micro Interactions

### Buttons
- Hover: Scale 1.05, color change
- Active: Scale 0.95, color change
- Duration: 150-200ms

### Links
- Hover: Color change, underline
- Focus: Ring highlight, underline
- Duration: 200ms

### Forms
- Focus: Border color change, shadow, scale 1.01
- Error: Shake animation (if needed)
- Success: Checkmark animation

### Modals
- Open: Fade in (200ms), scale dari 0.95 ke 1
- Close: Fade out (200ms), scale dari 1 ke 0.95
- Backdrop: Fade in/out (200ms)

## Page Transitions

[TO BE DEFINED] - Page navigation animations

## Performance Optimization

1. Gunakan `will-change` sparingly
2. Prefer transform dan opacity
3. Batch animations untuk avoid repaints
4. Test pada low-end devices
5. Monitor performance dengan DevTools

## Testing

- Test pada various devices
- Test keyboard navigation
- Test dengan reduced motion enabled
- Verify smooth 60fps animations
- Test touch interactions

## Disabling Animations

Untuk testing atau specific use cases:

```html
<!-- Disable all transitions -->
<div class="!transition-none">Content</div>

<!-- Disable specific transition -->
<div class="transition-transform !duration-0">Content</div>
```

## References

- Tailwind transition docs: https://tailwindcss.com/docs/transition-property
- MDN Web Animations: https://developer.mozilla.org/en-US/docs/Web/CSS/animation
- CSS easing functions: https://cubic-bezier.com/
