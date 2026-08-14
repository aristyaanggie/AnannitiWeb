# Known Issues

Dokumentasi known issues dan workarounds Ananniti Tattoo Bali.

**Last Updated**: 2026-07-18
**Total Issues**: 0 active, 8 resolved (Sprint 19)

## Resolved Issues (Sprint 19)

### BUG-001: Homepage Shop Category Links
- **Severity**: Medium
- **Status**: ✅ Fixed (2026-07-18)
- **File**: `resources/views/pages/home.blade.php`
- **Problem**: Shop links used `?category=` query param instead of named route path
- **Fix**: Changed to `{{ route('shop.category', 'machine') }}` (5 links)

### BUG-002: Booking WhatsApp Number
- **Severity**: High
- **Status**: ✅ Fixed (2026-07-18)
- **File**: `app/Http/Controllers/BookingController.php`
- **Problem**: `$validated['whatsapp_number']` failed because field wasn't validated
- **Fix**: Changed to `$request->input('whatsapp_number')`

### BUG-007: Delete Modal Hardcoded Label
- **Severity**: Low
- **Status**: ✅ Fixed (2026-07-18)
- **File**: `resources/views/components/ui/delete-modal.blade.php`
- **Problem**: "Delete Product" label was hardcoded for all delete actions
- **Fix**: Added `actionLabel` prop, replaced hardcoded text

### BUG-009: Currency Symbol
- **Severity**: Medium
- **Status**: ✅ Fixed (2026-07-18)
- **Files**: `components/shop/product-card.blade.php`, `admin/products/index.blade.php`
- **Problem**: Currency symbol was `$` instead of `Rp`
- **Fix**: Changed to `{{ config('ananniti.payment.currency_symbol', 'Rp') }}{{ number_format($price, 0, ',', '.') }}`

### BUG-010: PortfolioService Wrong DI
- **Severity**: Low
- **Status**: ✅ Fixed (2026-07-18)
- **File**: `app/Services/PortfolioService.php`
- **Problem**: `SectionRepositoryInterface` injected in constructor but unused
- **Fix**: Removed unused dependency

### BUG-012: formatWhatsAppNumber Duplication
- **Severity**: Low
- **Status**: ✅ Fixed (2026-07-18)
- **Files**: `ShopController`, `BookingController`, `GalleryController`
- **Problem**: `formatWhatsAppNumber()` method duplicated 3 times
- **Fix**: Created `app/Concerns/FormatsWhatsAppNumber.php` trait, applied to all 3 controllers

### BUG-013: Bookings View Link
- **Severity**: High
- **Status**: ✅ Fixed (2026-07-18)
- **File**: `resources/views/admin/bookings/index.blade.php`
- **Problem**: "View" button linked to `admin.dashboard` instead of booking detail
- **Fix**: Changed to `route('admin.bookings.show', $booking)`

### False Positives (Not Bugs)
| Bug | Reason |
|-----|--------|
| BUG-003 (Products empty state) | Already had `@if($products->isEmpty())` |
| BUG-004 (Portfolio empty state) | Already had `@if($portfolios->isEmpty())` |
| BUG-005 (Bookings empty state) | Already had `@if($bookings->isEmpty())` |
| BUG-006 (Reviews empty state) | Already had `@if($reviews->isEmpty())` |
| BUG-008 (Booking form errors) | Already had `@error` directives |
| BUG-011 (Contact redundant column) | Minor, no functional impact |

---

## Common Workarounds

### 1. PowerShell Command Issues
**Issue**: `&&` operator tidak bekerja di PowerShell 5.1
**Workaround**: Gunakan `;` untuk command separation atau gunakan Git Bash
**Status**: Known limitation

### 2. Path dengan Spaces
**Issue**: File paths dengan spaces perlu special handling
**Workaround**: Always gunakan quotes untuk paths
**Status**: Known limitation

## Issue Tracking

Issues di-track menggunakan format di atas. Setiap issue harus memiliki:
- Clear description
- Root cause analysis
- Workaround (if available)
- Permanent fix plan
- Status tracking

## Priority Levels

- **Critical**: Blocks development, data loss, security issue
- **High**: Major feature broken, significant performance impact
- **Medium**: Minor feature broken, workaround available
- **Low**: Nice to have fix, cosmetic issue

---

**Status**: All systems operational — 0 active issues
