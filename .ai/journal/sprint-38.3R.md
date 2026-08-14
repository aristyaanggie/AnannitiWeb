# Sprint 38.3R — Rollback & Fix Typography (Strict)

**Date**: 2026-07-24
**Status**: ✅ COMPLETE

## Objective

Rollback seluruh perubahan background/border/hover button dari Sprint 38.3 ke kondisi asli. Hanya fix typography untuk readability.

## Rollback (Background/Border/Hover dikembalikan)

| File | Button | Dikembalikan Ke |
|------|--------|-----------------|
| `home.blade.php` | Hero CTA | `bg-white text-black` |
| `home.blade.php` | Outline button | `hover:bg-white hover:text-black` |
| `home.blade.php` | Gallery CTA | `bg-white text-[#1a1a1a]` |
| `home.blade.php` | Artist CTA | `bg-white text-black` |
| `gallery.blade.php` | CTA | `bg-white text-black` |
| `shop.blade.php` | CTA | `bg-white text-black` |
| `shop-category.blade.php` | CTA | `bg-white text-black` |
| `shop-detail.blade.php` | CTA | `bg-white text-black` |
| `shop-detail.blade.php` | Back to Shop | `border-[#e5e5e5] text-[#1a1a1a]` |
| `artist-profile.blade.php` | CTA | `bg-white text-black` |

## Typography Fix (Footer)

Footer links dikembalikan ke `text-white hover:text-gray-300`:
- Quick Links: 6 links
- Studio: 4 links (address, phone, email, hours)
- Connect: 4 links (Instagram, WhatsApp, TikTok, Facebook)

## Files Changed
- `resources/views/pages/home.blade.php`
- `resources/views/pages/gallery.blade.php`
- `resources/views/pages/shop.blade.php`
- `resources/views/pages/shop-category.blade.php`
- `resources/views/pages/shop-detail.blade.php`
- `resources/views/pages/artist-profile.blade.php`
- `resources/views/components/layout/footer.blade.php`
- `resources/views/components/layout/navbar.blade.php`

## Build Result
```
✅ Build successful (2.49s)
CSS: 112.01 kB (gzip 19.25 kB)
JS: 92.32 kB (gzip 33.89 kB)
```
