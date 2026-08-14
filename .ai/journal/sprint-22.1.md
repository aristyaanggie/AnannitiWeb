# Sprint 22.1 — QA Manual Fixes (Production Blocking)

**Date**: 2026-07-20
**Status**: ✅ COMPLETE
**Version**: v9.3.0

## Objective

Memperbaiki seluruh temuan QA agar website benar-benar production ready. Bukan membuat fitur baru.

## Critical Fixes

### Task 7 — Review Star Bug (CRITICAL)
- **Root Cause**: Homepage hardcoded "4.9" and always rendered 5 gold stars
- **Fix**: `HomeController` now computes `$averageRating`. Stars use `$i <= $review->rating` for gold/gray
- **Result**: Rating=3 shows ★★★☆☆, Rating=4 shows ★★★★☆

### Task 10 — Settings Audit
- **Root Cause**: Footer had hardcoded address, email, hours, Google Maps, Instagram, TikTok, Facebook
- **Fix**: Footer now queries `Setting` table for all values with production-ready fallbacks

## All Tasks

| Task | Description | Status |
|------|-------------|--------|
| 1 | Shop Category Auto Scroll — hash anchors | ✅ |
| 2 | Admin Form Placeholder Readability — #999999 → #777777 | ✅ |
| 3 | Product Gallery 50+ — file size 5MB→20MB (max:5120→max:20480) | ✅ |
| 4 | Product Gallery UX — count display added | ✅ |
| 5 | Footer Readability — white/80→white/90 | ✅ |
| 6 | CTA Standardization — full audit (no changes needed, done in S22) | ✅ |
| 7 | Review Star Bug — dynamic from DB | ✅ |
| 8 | Section Gradient — already fixed in S22 | ✅ |
| 9 | Country Field Audit — recommended to keep as-is | ✅ |
| 10 | Settings Audit — footer fully dynamic | ✅ |

## Files Changed (15 files)
- `home.blade.php`, `HomeController.php`, `footer.blade.php`
- `StoreProductRequest.php`, `UpdateProductRequest.php`
- 8 admin form files (placeholder color)
- `shop.blade.php` (scroll-mt-20)

## Build Result
```
✓ npm run build:          0 errors, 0 warnings
✓ php artisan optimize:   config ✓ events ✓ routes ✓ views ✓
```
