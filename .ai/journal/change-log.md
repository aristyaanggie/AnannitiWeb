# Change Log

Dokumentasi perubahan dan versioning untuk Ananniti Tattoo Bali.

## Version History

### v13.0.0 — Landing Page UI Retouch (Sprint 40.4.x)
**Date**: 2026-08-04
**Status**: Production Ready (Landing Page Visual Polish Complete)

**What's New**:
- Sprint 40.2: Full Landing Page QA audit (8 sections, 3 breakpoints, 15 check items)
- Sprint 40.4.1: Gallery mobile spacing improvement (gap-1→gap-2)
- Sprint 40.4.2: Consultation CTA padding standardization (px-5→px-6)
- Sprint 40.4.3: Hero CTA first pass retouch (bg-white/20→40)
- Sprint 40.4.4: Hero & About final retouch (gradients, text hierarchy)
- Sprint 40.4.5: Final micro retouch (CTA semi-solid, About alignment)

**UI Changes**:
- Hero CTA "View Our Works": `bg-white/80 text-black shadow-sm` — immediate visibility, not glass
- Hero bottom gradient: `h-32 to-[#0a0a0a]` — seamless transition into About
- About→Services: h-28 md:h-32 vertical gradient (smooth dark→white)
- About text hierarchy: subtitle `/60`, heading full white, paragraph `/80`
- About image: explicit `self-center` alignment on both grid children
- Gallery mobile: `gap-2` (8px) — proportional card spacing
- Consultation CTA: `px-6 py-3` — matches site primary CTA standard

**Files Modified**:
- `resources/views/pages/home.blade.php` (6 sprints, multiple sections)

**Build**: CSS 116.02 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.2.md`
- `.ai/journal/sprint-40.4.1.md`
- `.ai/journal/sprint-40.4.2.md`
- `.ai/journal/sprint-40.4.3.md`
- `.ai/journal/sprint-40.4.4.md`
- `.ai/journal/sprint-40.4.5.md`

---

### v13.0.10 — About Final Layout — Keep Original Section Size (Sprint 40.6.4, Phase 1 Desktop)
**Date**: 2026-08-05
**Status**: Production Ready (Desktop UI Final)

**What's New**:
- Sprint 40.6.4: Kembalikan tinggi About — frame desktop `md:aspect-[4/5]` (tinggi kolom drive tinggi section), hapus `bg-[#1a1a1a]` (foto = frame, tanpa card effect). Mobile tetap in-flow (`w-full h-auto`). Root cause empty-frame: foto storefront landscape dengan langit gelap ±40% di atas + bg surface

**Files Modified**:
- `resources/views/pages/home.blade.php` (About photo column — frame)

**Build**: CSS 117.60 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.6.4.md`

---

### v13.0.9 — About Image Final — Remove Empty Frame (Sprint 40.6.3, Phase 1 Desktop)
**Date**: 2026-08-05
**Status**: Production Ready (Desktop UI Final)

**What's New**:
- Sprint 40.6.3: Hapus empty frame mobile — mobile memakai image in-flow (`w-full h-auto`, tinggi mengikuti gambar natural), desktop tetap `md:absolute md:inset-0 md:h-full md:object-cover`. Tanpa aspect-ratio fixed → tanpa card/letterbox/ruang kosong

**Files Modified**:
- `resources/views/pages/home.blade.php` (About photo column — frame & image)

**Build**: CSS 117.56 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.6.3.md`

---

### v13.0.8 — About Image Layout Rework (Sprint 40.6.2, Phase 1 Desktop)
**Date**: 2026-08-05
**Status**: Production Ready (Desktop UI Final)

**What's New**:
- Sprint 40.6.2: Frame foto About dibuat layout-driven — desktop `md:aspect-auto md:h-full` (tinggi = tinggi blok teks), mobile `aspect-[4/5]`. Image `absolute inset-0 object-cover` memenuhi penuh → tanpa kotak/letterbox/ruang mati untuk semua orientasi foto CMS

**Files Modified**:
- `resources/views/pages/home.blade.php` (About photo column)

**Build**: CSS 117.41 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.6.2.md`

---

### v13.0.7 — About Layout Architecture CMS-Safe (Sprint 40.6.1, Phase 1 Desktop)
**Date**: 2026-08-05
**Status**: Production Ready (Desktop UI Final)

**What's New**:
- Sprint 40.6.1: About photo frame dibuat content-independent — frame `relative aspect-[4/5]` + surface `bg-[#1a1a1a]`, image `absolute inset-0 object-cover`
- Ukuran layout 100% independen dari gambar CMS (portrait/landscape/square/resolusi apapun) — tanpa tuning per-foto, tanpa magic number

**Files Modified**:
- `resources/views/pages/home.blade.php` (About photo column — frame & img)

**Build**: CSS 117.37 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.6.1.md`

---

### v13.0.6 — About Final Polish (Sprint 40.6.0, Phase 1 Desktop)
**Date**: 2026-08-05
**Status**: Production Ready (Desktop UI Final)

**What's New**:
- Sprint 40.6.0: About desktop polish — photo alignment dipaksa center (equal-height columns + inner `justify-center`), gradient About→Services multi-stop halus (hitam→abu→putih, 6 stop, h-32/md:h-40)
- Hanya section About + transisinya yang diubah; mobile/tablet tidak rusak (`md:` guard)

**Files Modified**:
- `resources/views/pages/home.blade.php` (About section lines 55, 56, 65 + transition 81–82)

**Build**: CSS 117.37 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.6.0.md`

---

### v13.0.5 — Hero Responsive Architecture Final (Sprint 40.5.1.3)
**Date**: 2026-08-05
**Status**: Production Ready (Final UI Retouch)

**What's New**:
- Sprint 40.5.1.3: Navbar mobile dibuat self-contained — Alpine `x-data` inline (tanpa fungsi eksternal), link menu mobile memakai class Tailwind `text-white` eksplisit (bukan class `<style scoped>` yang tak terkompilasi)
- Hero architecture diverifikasi: tanpa grid, overlay structure, gradient dipertahankan — tidak diubah
- Desktop navbar (`.nav-link`) & hero tetap identik

**UI Changes**:
- Navbar: `x-data="navbarData()"` → `x-data="{ menuOpen: false }"`, hapus `@pushOnce('scripts')`, link mobile `block nav-link-mobile` → `block py-3 text-sm font-medium text-white`

**Files Modified**:
- `resources/views/components/layout/navbar.blade.php`

**Build**: CSS 117.00 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.5.1.3.md`

---

### v13.0.4 — Hero Responsive Final Fix (Sprint 40.5.1.2)
**Date**: 2026-08-05
**Status**: Production Ready (Final UI Retouch)

**What's New**:
- Sprint 40.5.1.2: fix navbar Alpine — tambah `@stack('scripts')` di `layouts/app.blade.php` sehingga script navbar ter-render, hero konsisten di semua device

**Files Modified**:
- `resources/views/layouts/app.blade.php` (+@stack('scripts'))

**Build**: CSS 117.00 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.5.1.2.md`

---

### v13.0.3 — Hero Responsive Fix (Revision Sprint 40.5.1.1)
**Date**: 2026-08-05
**Status**: Production Ready (Final UI Retouch)

**What's New**:
- Sprint 40.5.1.1: Revisi Hero responsive — background selalu mengisi penuh (tanpa blank space abu/putih), gradient tepat di bawah Hero, vertical rhythm mobile khusus
- Desktop layout tetap identik (semua perubahan dibungkus `sm:`)

**UI Changes**:
- Hero section: +`bg-[#0a0a0a]` fallback gelap permanen — hero tidak pernah putih/abu saat image gagal/loading
- Gradient: `h-20 sm:h-32` — band transisi lebih pendek di mobile
- Mobile vertical rhythm: eyebrow/sub `mb-4 sm:mb-5`, h1 `mb-5 sm:mb-6`, paragraph `mb-8 sm:mb-10`, CTA `mb-10 sm:mb-14`, trust `gap-x-3 sm:gap-x-4`

**Files Modified**:
- `resources/views/pages/home.blade.php` (Hero section only — lines 12, 23–27, 36, 49)

**Build**: CSS 117.00 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.5.1.1.md`

---

### v13.0.2 — Hero Responsive Polish (Sprint 40.5.1)
**Date**: 2026-08-05
**Status**: Production Ready (Final UI Retouch)

**What's New**:
- Sprint 40.5.1: Hero responsive polish dari audit 40.5.0 — trust row tidak lagi overflow/clipped di mobile, eyebrow fit 1 line di 320–360, CTA full-width di mobile
- Desktop layout tetap identik (semua fix dibungkus `sm:` responsive variant)

**UI Changes**:
- Trust row: `flex-wrap gap-x-4 gap-y-2` + divider `hidden sm:inline-block` (H1)
- Eyebrow: `tracking-[0.2em] sm:tracking-[0.3em]` (L1)
- CTA: `w-full sm:w-auto` — full-width stacked mobile, auto desktop (L5)

**Files Modified**:
- `resources/views/pages/home.blade.php` (Hero section only — lines 23, 28, 32, 36, 41, 43)

**Build**: CSS 116.66 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.5.1.md`

---

### v13.0.1 — About Photo Alignment Final (Sprint 40.4.6)
**Date**: 2026-08-05
**Status**: Production Ready (Final UI Retouch)

**What's New**:
- Sprint 40.4.6: About photo alignment refactor — grid `items-center` + `self-center` → flex `md:items-center` + `md:flex-1`
- Photo & text block kini berbagi vertical center yang sama (container-level alignment, single source of truth)
- Foto selalu tepat di tengah terhadap keseluruhan tinggi block text di desktop/tablet/mobile

**Files Modified**:
- `resources/views/pages/home.blade.php` (About section only — lines 55, 56, 65)

**Build**: CSS 116.47 kB, JS 92.32 kB, 0 errors, 0 warnings

**Sprint Journals**:
- `.ai/journal/sprint-40.4.6.md`

---

### v12.0.0 — Tattoo Supply CMS + Typography Polish
**Date**: 2026-07-24
**Status**: Production Ready (Tattoo Supply CMS Complete)

**What's New**:
- Sprint 39: Tattoo Supply CMS — Full CRUD untuk tattoo supply cards di landing page
- Sprint 38.1: Public UI Typography & Gallery Contrast Polish — Gallery dark editorial
- Sprint 38.2: Global Public UI Contrast & Color Consistency — Gold removal, typography fixes
- Sprint 38.3R: Rollback & Fix Typography — Revert button styles, fix footer hover

**New Features**:
- Tattoo Supply CMS (admin CRUD for landing page shop cards)
- New database table: `tattoo_supplies`
- New admin controller, form requests, views
- Admin sidebar link for Tattoo Supply

**UI Changes**:
- Gallery section: dark editorial background (#0a0a0a)
- Footer links: `text-white hover:text-gray-300`
- Typography contrast improvements across all pages

**Files Created**:
- `database/migrations/2026_07_25_000001_create_tattoo_supplies_table.php`
- `app/Models/TattooSupply.php`
- `app/Http/Controllers/Admin/AdminTattooSupplyController.php`
- `app/Http/Requests/StoreTattooSupplyRequest.php`
- `app/Http/Requests/UpdateTattooSupplyRequest.php`
- `resources/views/admin/tattoo-supplies/index.blade.php`
- `resources/views/admin/tattoo-supplies/form.blade.php`
- `database/seeders/TattooSupplySeeder.php`

**Files Modified**:
- `app/Http/Controllers/HomeController.php`
- `resources/views/pages/home.blade.php`
- `resources/views/layouts/admin.blade.php`
- `routes/web.php`
- `database/seeders/DatabaseSeeder.php`
- Multiple blade files for typography fixes

**Build**: CSS 112.01 kB, JS 92.32 kB, 0 errors, 0 warnings

---

### v9.6.0 — Product Gallery Final Fix + Shop Category Navigation Final Fix
**Date**: 2026-07-20
**Status**: Production Ready (QA Complete)

**What's New**:
- Sprint 22.4: Full architecture audit confirms unlimited gallery support across all 10 layers
- Sprint 22.3: Gallery file accumulation fixed — all batches submitted together via FormData fetch
- Sprint 22.2: Gallery UX redesign — unlimited photos, 6-col grid, add more, clear all
- Sprint 22.1: 11 QA fixes including critical review star bug, settings audit, CTA standardization
- Sprint 22: UI polish — CTA standardization, footer readability, gradient transitions

**Architecture Verified**:
- StoreProductRequest → Controller → Service → Database → Storage → Edit → Delete
- ALL layers support unlimited gallery images (verified in Sprint 22.4 audit)

**Critical Fixes**:
- Review stars now read from database (was hardcoded ★★★★★)
- Gallery file accumulation (was losing previous batches)
- Footer now fully dynamic from Settings table

**Changes**:
- See `.ai/todos/progress.md` — "Hari Ini (2026-07-20)" for full file list

---

### v9.5.0 — Product Gallery Architecture + Homepage Shop Navigation Final Fix
**Date**: 2026-07-20
**Status**: Production Ready

**What's New**:
- Sprint 22.3: Gallery file accumulation via FormData fetch
- submitProductForm handler injects all accumulated File objects
- Layout restructured: Upload → Counter → Add More → Clear All → Grid
- Shop navigation verified: all 6 categories use hash anchors + scroll-mt-20

**Build**: 0 errors, 0 warnings

---

### v9.4.0 — Product Gallery UX Refactor + Shop Navigation Fix
**Date**: 2026-07-20
**Status**: Production Ready

**What's New**:
- Sprint 22.2: Complete gallery UX redesign
- Unlimited photos (no frontend/backend limit)
- Responsive grid: 2/4/6 columns
- "X Photos Selected" counter
- Red × remove button on each thumbnail
- Clear All button
- Add More Images button
- Drag & drop support
- Shop: hash-based navigation + scroll-mt-20

**Build**: 0 errors, 0 warnings

---

### v9.3.0 — QA Manual Fixes (Production Blocking)
**Date**: 2026-07-20
**Status**: Production Ready

**What's New**:
- Sprint 22.1: 11 QA tasks completed
- Shop category auto-scroll (hash anchors)
- Admin form placeholder readability (#999999 → #777777)
- Product gallery: file size 5MB → 20MB, count display
- Review star bug fixed (★ from database, not hardcoded)
- Footer: all values dynamic from Settings table
- CTA standardization across all pages (audit complete)
- Gradient transitions smoothed

**Build**: 0 errors, 0 warnings

---

### v9.2.0 — Production Content Readiness & UI Polish
**Date**: 2026-07-20
**Status**: Beta (UI Polish Complete)

**What's New**:
- Sprint 22: Production Content Readiness & UI Polish
- CTA Standardization: editorial premium style across all pages
- Footer readability improved (text/70→/80, copyright/40→/50)
- Gradient transitions smoothed (h-16→h-20, via/70→via/80)
- Artist image fallback (onerror monogram)
- Product price spacing (Rp → Rp )
- Gallery masonry supports mixed portrait+landscape
- WhatsApp single source via Settings table

**Build**: 0 errors, 0 warnings

### v9.1.0 — Admin CMS Finalization & Content Management Polish
**Date**: 2026-07-19
**Status**: Beta (Admin CMS Finalized)

**What's New**:
- Sprint 20–21: Database finalization, form fixes, homepage reviews, admin polish
- Dashboard Quick Actions fixed (link to correct pages)
- Currency symbol standardized (Rp) across all admin forms
- Autofocus added to first field of all admin forms
- Homepage reviews now dynamic from database
- Review field mismatch fixed (customer_name → name)
- Upload area z-index fix (relative wrapper)
- Single Artist consistency (wording audit)

**Changes**:
- Fixed `admin/dashboard.blade.php` (Quick Action links)
- Fixed `admin/products/form.blade.php` (currency + autofocus)
- Fixed `admin/portfolio/form.blade.php` (autofocus)
- Fixed `admin/reviews/form.blade.php` (autofocus)
- Fixed `admin/content/form.blade.php` (autofocus)
- Fixed `app/Http/Controllers/HomeController.php` (dynamic reviews)
- Fixed `app/Http/Controllers/Admin/AdminReviewController.php` (field name)
- Fixed `resources/views/pages/home.blade.php` (dynamic reviews section)
- Added `.ai/journal/sprint-21.md`

---

### v9.0.0 — Database Finalization & Production Foundation
**Date**: 2026-07-19
**Status**: Beta (Production Foundation Complete)

**What's New**:
- Sprint 20: 11 backend audit tasks completed
- Database audit: 16 tables, 13 FKs, 23+ indexes verified
- Model audit: 16 models verified (fillable, casts, relations)
- Form request fixes: customer_name → name, added missing validation rules
- Seeder audit: All 7 seeders idempotent (firstOrCreate)
- MySQL compatibility: All migrations verified
- ERD readiness: Cardinality matrix added
- Production checklist: .env.example updated with MySQL config
- Storage audit: All upload/delete operations verified

**Changes**:
- Fixed `app/Http/Requests/StoreReviewRequest.php` (field name fix)
- Fixed `app/Http/Requests/UpdateReviewRequest.php` (field name fix)
- Updated `app/Http/Requests/StorePortfolioRequest.php` (added validation)
- Updated `.env.example` (MySQL configuration)
- Updated `.ai/erd.md` (cardinality, MySQL audit)
- Updated `.ai/database-review.md` (v3.0)
- Updated `.ai/deployment.md` (production checklist)
- Added `.ai/journal/sprint-20.md`

---

### v8.3.0 — UX, Navigation & Conversion Finalization
**Date**: 2026-07-19
**Status**: Beta (UX Finalization Complete)

**What's New**:
- Sprint 19.1: 11 UX/navigation tasks completed
- Hero secondary button visibility improved
- Service CTAs redesigned (smaller, editorial)
- Landing page shop category links fixed (no more 404)
- Shop category navigation chips added
- Product inquiry requires Name + Country before WhatsApp
- Navbar uses named routes (works from any page)
- WhatsApp number fetched from database (navbar, footer, shop-category)
- Button focus states added to all CTAs
- Currency symbols fixed (Rp instead of $)

**Changes**:
- Updated `resources/views/pages/home.blade.php` (secondary button, service CTAs, shop links)
- Updated `resources/views/pages/shop.blade.php` (category chips, currency)
- Updated `resources/views/pages/shop-detail.blade.php` (inquiry validation, currency)
- Rewritten `resources/views/components/layout/navbar.blade.php` (named routes, dynamic WA)
- Updated `resources/views/components/layout/footer.blade.php` (dynamic WA number)
- Updated `resources/views/pages/shop-category.blade.php` (dynamic WA number)
- Updated `resources/views/auth/login.blade.php` (focus states)
- Updated `resources/views/pages/booking.blade.php` (focus states)
- Added `.ai/journal/sprint-19.1.md`

---

### v8.2.0 — Final QA & Production Readiness
**Date**: 2026-07-18
**Status**: Beta (Stabilization Complete)

**What's New**:
- Sprint 19: Full 10-step audit (42 blade files, 16 models, 11 services)
- Sprint 19.1: 8 bugs fixed across public & admin pages
- Created `FormatsWhatsAppNumber` shared trait
- Currency symbol now uses config (Rp)
- Delete modal now supports dynamic action label

**Changes**:
- Fixed 5 homepage shop links (BUG-001)
- Fixed booking WhatsApp number source (BUG-002)
- Fixed delete modal hardcoded label (BUG-007)
- Fixed currency symbol from $ to Rp (BUG-009)
- Fixed PortfolioService wrong DI (BUG-010)
- Extracted formatWhatsAppNumber to trait (BUG-012)
- Fixed bookings view link (BUG-013)
- Created `app/Concerns/FormatsWhatsAppNumber.php`
- Added `.ai/journal/sprint-19.md`

---

### v8.1.0 — Global Navigation & CTA Consistency
**Date**: 2026-07-17
**Status**: Beta (Navigation Rollback)

**What's New**:
- Sprint 18.1: Global Navigation & CTA Consistency
- Navbar updated with named routes
- CTA consistency across all pages
- Rollback to pre-Sprint 18.1 state

**Changes**:
- Updated `resources/views/components/layout/navbar.blade.php`
- Added `.ai/journal/sprint-18.md`

---

### v8.0.0 — Gallery Experience & Portfolio Detail
**Date**: 2026-07-17
**Status**: Beta (Gallery Complete)

**What's New**:
- Sprint 18: Gallery Experience & Portfolio Detail
- Public Gallery page with masonry grid
- Filter by tattoo style (dynamic)
- Search by title/style/artist (Alpine.js)
- Portfolio detail page with artist card
- Artist profile page with portfolio
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Http/Controllers/GalleryController.php`
- Created `resources/views/pages/gallery.blade.php`
- Created `resources/views/pages/portfolio-detail.blade.php`
- Created `resources/views/pages/artist-profile.blade.php`
- Updated `routes/web.php` (+3 routes)
- Updated `resources/views/pages/home.blade.php` (gallery links)
- Added `.ai/journal/sprint-18.md`

---

### v7.1.0 — Shop Category Experience & Product WhatsApp
**Date**: 2026-07-17
**Status**: Beta (Shop Complete)

**What's New**:
- Sprint 17.1: Shop Category Experience & Product WhatsApp
- All categories display (including empty)
- Empty category: "Products Coming Soon" + CTA
- Quantity selector on product detail
- Customer info fields
- Product WhatsApp format (different from booking)
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Http/Controllers/ShopController.php`
- Updated `resources/views/pages/shop.blade.php`
- Updated `resources/views/pages/shop-detail.blade.php`
- Added `.ai/journal/sprint-17.1.md`

---

### v7.0.0 — Public Shop & Product Detail
**Date**: 2026-07-17
**Status**: Beta (Shop Dynamic)

**What's New**:
- Sprint 17: Public Shop & Product Detail
- Shop page dynamic from database
- Product detail page editorial layout
- Gallery with Alpine.js thumbnails
- Breadcrumb, related products, SEO
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Http/Controllers/ShopController.php`
- Updated `resources/views/pages/shop.blade.php`
- Updated `resources/views/pages/shop-detail.blade.php`
- Added `.ai/journal/sprint-17.md`

---

### v6.2.0 — Booking CTA Visual Polish
**Date**: 2026-07-17
**Status**: Beta (Booking Polish)

**What's New**:
- Sprint 16.2: Booking CTA Visual Polish
- All CTAs standardized: px-5 py-2.5 text-sm font-medium rounded-lg
- Focus rings added for accessibility
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/home.blade.php`

---

### v6.1.0 — Booking CTA Optimization & WhatsApp Fix
**Date**: 2026-07-17
**Status**: Beta (WhatsApp Fixed)

**What's New**:
- Sprint 16.1: Booking CTA Optimization & WhatsApp Fix
- WhatsApp number format fixed (08 → 628)
- Pre-selected service via query parameter
- CTAs added to Services section
- Footer CTA updated
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Http/Controllers/BookingController.php`
- Updated `resources/views/pages/booking.blade.php`
- Updated `resources/views/pages/home.blade.php`
- Updated `resources/views/components/layout/footer.blade.php`

---

### v6.0.0 — Booking Flow & WhatsApp Integration
**Date**: 2026-07-17
**Status**: Beta (Booking Complete)

**What's New**:
- Sprint 16: Booking Flow & WhatsApp Integration
- Public booking form
- WhatsApp message generation
- Studio Tattoo + Home Service
- Location fields for Home Service
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Http/Controllers/BookingController.php`
- Created `resources/views/pages/booking.blade.php`
- Updated `routes/web.php` (+2 routes)
- Updated `resources/views/pages/home.blade.php` (CTA links)

---

### v4.9.0 — Booking Detail & Status Management
**Date**: 2026-07-16
**Status**: Beta (Booking Detail Complete)

**What's New**:
- Sprint 14.16: Booking Detail & Status Management
- Booking detail page with client info, booking info, internal notes
- Status update (Pending/Confirmed/Completed/Cancelled)
- WhatsApp actions (Open, Copy Template, Mark Sent)
- Timeline visualization
- UpdateBookingRequest
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Services/BookingManagementService.php`
- Created `app/Http/Requests/UpdateBookingRequest.php`
- Updated `app/Http/Controllers/Admin/AdminBookingController.php`
- Created `resources/views/admin/bookings/show.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.16.md`

---

### v4.8.0 — Booking Management Dashboard
**Date**: 2026-07-16
**Status**: Beta (Booking Management Complete)

**What's New**:
- Sprint 14.15: Booking Management Dashboard
- BookingManagementService with stats
- AdminBookingController (index)
- Booking index with summary cards, filters, table
- Status badges (Pending/Confirmed/Completed/Cancelled)
- Desktop table + mobile cards
- Sidebar updated with Bookings link
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Services/BookingManagementService.php`
- Created `app/Http/Controllers/Admin/AdminBookingController.php`
- Created `resources/views/admin/bookings/index.blade.php`
- Updated `resources/views/layouts/admin.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.15.md`

---

### v4.7.0 — Portfolio Management (Admin CMS)
**Date**: 2026-07-16
**Status**: Beta (Portfolio CRUD Complete)

**What's New**:
- Sprint 14.14: Full Portfolio CRUD
- PortfolioService with image upload/delete
- StorePortfolioRequest + UpdatePortfolioRequest
- AdminPortfolioController (index, create, store, edit, update, destroy)
- Portfolio index with summary cards + search
- Portfolio form with image upload preview
- Sidebar updated with Portfolio link
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Services/PortfolioService.php`
- Created `app/Http/Requests/StorePortfolioRequest.php`
- Created `app/Http/Requests/UpdatePortfolioRequest.php`
- Created `app/Http/Controllers/Admin/AdminPortfolioController.php`
- Created `resources/views/admin/portfolio/index.blade.php`
- Created `resources/views/admin/portfolio/form.blade.php`
- Updated `resources/views/layouts/admin.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.14.md`

---

### v4.6.0 — Landing Page CMS Foundation
**Date**: 2026-07-16
**Status**: Beta (Landing Page CMS Complete)

**What's New**:
- Sprint 14.13: Landing Page CMS Foundation
- SectionService with image upload
- UpdateSectionRequest with validation
- AdminSectionController (index, edit, update)
- Content list page (9 sections)
- Content edit form (title, subtitle, description, image, visibility)
- Image upload with preview and cleanup
- Sidebar updated with Content link
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Services/SectionService.php`
- Created `app/Http/Requests/UpdateSectionRequest.php`
- Created `app/Http/Controllers/Admin/AdminSectionController.php`
- Created `resources/views/admin/content/index.blade.php`
- Created `resources/views/admin/content/form.blade.php`
- Updated `resources/views/layouts/admin.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.13.md`

---

### v4.5.0 — Product Image Upload System
**Date**: 2026-07-16
**Status**: Beta (Image Upload Complete)

**What's New**:
- Sprint 14.12: Thumbnail & Gallery image upload
- Drag & drop + click to browse
- Live preview (thumbnail + gallery)
- Multiple gallery upload
- Gallery image delete
- File cleanup on replace/delete
- Storage link configured
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Http/Requests/StoreProductRequest.php`
- Updated `app/Http/Requests/UpdateProductRequest.php`
- Updated `app/Services/ProductService.php` (upload, delete, gallery)
- Updated `app/Http/Controllers/Admin/AdminProductController.php`
- Updated `resources/views/admin/products/form.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.12.md`

---

### v4.4.0 — Product CRUD Backend (Delete + Status Management)
**Date**: 2026-07-16
**Status**: Beta (Product CRUD Complete)

**What's New**:
- Sprint 14.11: Soft Delete, Status Toggle, Bulk Actions, Audit Log
- StatusBadge reusable component
- DeleteModal editorial component
- Audit logging on create/update/delete/restore/publish/unpublish
- Trash counter in summary cards
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Repositories/Contracts/ProductRepositoryInterface.php`
- Updated `app/Repositories/ProductRepository.php`
- Updated `app/Services/ProductService.php` (audit logging)
- Updated `app/Http/Controllers/Admin/AdminProductController.php`
- Created `resources/views/components/ui/status-badge.blade.php`
- Created `resources/views/components/ui/delete-modal.blade.php`
- Updated `resources/views/admin/products/index.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.11.md`

---

### v4.3.0 — Product CRUD Backend (Store & Update)
**Date**: 2026-07-16
**Status**: Beta (Product CRUD Complete)

**What's New**:
- Sprint 14.10: Store & Update backend for products
- Form Requests: StoreProductRequest, UpdateProductRequest
- Slug auto-generation with unique check
- Flash messages on success
- Validation errors displayed under fields
- Old input preserved on validation failure
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Http/Requests/StoreProductRequest.php`
- Created `app/Http/Requests/UpdateProductRequest.php`
- Updated `app/Services/ProductService.php` (slug generation)
- Updated `app/Http/Controllers/Admin/AdminProductController.php`
- Updated `resources/views/admin/products/form.blade.php`
- Updated `resources/views/admin/products/index.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.10.md`

---

### v4.2.0 — Admin Product CRUD (Create & Edit Foundation)
**Date**: 2026-07-16
**Status**: Beta (Admin Product Form Complete)

**What's New**:
- Sprint 14.9: Create & Edit Product form pages
- Shared form view (form.blade.php) for create and edit
- 6 form sections: Basic Info, Pricing, Description, Images, Status, SEO
- Upload area placeholders (dropzone style)
- Editorial design, max-width 900px
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Http/Controllers/Admin/AdminProductController.php` (create, edit)
- Created `resources/views/admin/products/form.blade.php`
- Updated `resources/views/admin/products/index.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.9.md`

---

### v4.1.0 — Admin Product Management (Index)
**Date**: 2026-07-16
**Status**: Beta (Admin Product Index Complete)

**What's New**:
- Sprint 14.8: Admin Product Management Index page
- Product list with summary cards (Total, Published, Draft, Low Stock)
- Desktop table + mobile cards
- Status badges, Low Stock indicator
- Empty state with illustration
- Sidebar active state for Products
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Http/Controllers/Admin/AdminProductController.php`
- Created `resources/views/admin/products/index.blade.php`
- Updated `routes/web.php`
- Updated `resources/views/layouts/admin.blade.php`
- Added `.ai/journal/sprint-14.8.md`

---

### v4.0.0 — Admin Dashboard Foundation
**Date**: 2026-07-16
**Status**: Beta (Admin Dashboard Complete)

**What's New**:
- Sprint 14.7: Admin Dashboard with sidebar, stats, bookings table, quick actions
- DashboardService with dependency injection
- Sidebar navigation with Lucide icons
- Stats grid: 6 cards (Products, Categories, Portfolio, Artists, Bookings, Reviews)
- Recent Bookings table (5 rows max)
- Quick Actions (4 buttons)
- Responsive layout (390px → 1920px)
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Services/DashboardService.php`
- Created `app/Http/Controllers/Admin/AdminDashboardController.php`
- Updated `resources/views/layouts/admin.blade.php` (full sidebar layout)
- Created `resources/views/admin/dashboard.blade.php`
- Updated `routes/web.php`
- Added `.ai/journal/sprint-14.7.md`

---

### v3.9.0 — Admin Authentication Foundation
**Date**: 2026-07-16
**Status**: Beta (Admin Auth Complete)

**What's New**:
- Sprint 14.6: Laravel Session-based authentication
- AdminMiddleware for role-based access control
- Login page with editorial branding
- Logout with session invalidation
- CSRF protection, session regeneration
- Route group: /admin with auth + admin middleware
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Http/Middleware/AdminMiddleware.php`
- Created `app/Http/Controllers/Admin/AdminAuthController.php`
- Created `resources/views/layouts/admin.blade.php`
- Created `resources/views/auth/login.blade.php`
- Created `resources/views/admin/home.blade.php`
- Updated `routes/web.php` (admin routes)
- Updated `bootstrap/app.php` (middleware alias)
- Added `.ai/journal/sprint-14.6.md`

---

### v3.8.0 — Repository & Service Foundation
**Date**: 2026-07-16
**Status**: Beta (Backend Architecture Complete)

**What's New**:
- Sprint 14.5: Repository Pattern + Service Layer foundation
- 6 Repository Interfaces with contracts
- 6 Repository Implementations using Eloquent
- 5 Services with business logic
- AppServiceProvider bindings for dependency injection
- PSR-12, strict types, return types, DI
- Build: 0 error, 0 warning

**Changes**:
- Created `app/Repositories/Contracts/` (6 interfaces)
- Created `app/Repositories/` (6 implementations)
- Created `app/Services/` (5 services)
- Updated `app/Providers/AppServiceProvider.php`
- Added `.ai/journal/sprint-14.5.md`

---

### v3.7.0 — Database Seeder Foundation
**Date**: 2026-07-16
**Status**: Beta (Seeders Complete)

**What's New**:
- Sprint 14.4: 6 database seeders with 39 records
- Categories: 6 product categories
- Badges: 6 product badges
- Sections: 9 landing page sections
- Settings: 13 website configuration items
- WhatsApp Templates: 4 message templates
- User: 1 admin account
- migrate:fresh --seed — 0 errors, 0 warnings
- Build: 0 error, 0 warning

**Changes**:
- Created 6 seeder files (CategorySeeder, ProductBadgeSeeder, SectionSeeder, SettingSeeder, WhatsappTemplateSeeder, UserSeeder)
- Updated `database/seeders/DatabaseSeeder.php`
- Added `.ai/journal/sprint-14.4.md`

---

### v3.6.0 — Eloquent Models & Relationships
**Date**: 2026-07-16
**Status**: Beta (Models Complete)

**What's New**:
- Sprint 14.3: 16 Eloquent Models with fillable, casts, and relationships
- User model updated with role, phone, avatar, is_active, soft deletes
- All relationships implemented (belongsTo, hasMany, hasOne)
- All casts properly defined (boolean, datetime, decimal, array)
- migrate:fresh + optimize — 0 errors, 0 warnings
- Build: 0 error, 0 warning

**Changes**:
- Updated `app/Models/User.php` (added role, phone, avatar, is_active, soft deletes, relationships)
- Created 15 new model files (Section → WhatsappTemplate)
- Added `.ai/journal/sprint-14.3.md`

---

### v3.5.0 — Database Migration Foundation
**Date**: 2026-07-16
**Status**: Beta (Database Migrations Complete)

**What's New**:
- Sprint 14.2: 16 database tables implemented via Laravel Migrations
- All foreign keys, indexes, soft deletes implemented
- migrate:fresh — 0 errors, 0 warnings
- 18 migration files total (3 Laravel default + 15 custom)
- Build: 0 error, 0 warning

**Changes**:
- Updated `database/migrations/0001_01_01_000000_create_users_table.php` (added role, phone, avatar, is_active, last_login_at, softDeletes)
- Created 15 new migration files (sections → whatsapp_templates)
- Added `.ai/journal/sprint-14.2.md`

---

### v3.4.0 — Database Architecture FINAL
**Date**: 2026-07-16
**Status**: Beta (Database Design Complete)

**What's New**:
- Sprint 14.0: Database Architecture Foundation (15 tables designed)
- Sprint 14.1: Database Final Refinement — Pre-Migration Lock
- 16 tables final (added whatsapp_templates)
- Products: +thumbnail, +stock_quantity, +minimum_stock, +published_at
- Reviews: +artist_id (tattoo studio business model)
- WhatsApp Templates: new table for booking/shop notifications
- 23+ performance indexes, 5 composite indexes
- Soft delete audit: users, products (soft), rest (hard)
- Foreign key audit: all chains max 2 levels, no dangerous cascades
- Final Score: 93/100
- Build: 0 error, 0 warning

**Changes**:
- Updated `.ai/database-review.md` (v2.0 — FINAL)
- Added `.ai/journal/sprint-14.0.md`
- Added `.ai/journal/sprint-14.1.md`

---

### v3.3.0 — Shop Editorial Showroom + Discoverability
**Date**: 2026-07-16
**Status**: Beta (Shop Complete — Editorial Showroom)

**What's New**:
- Sprint 12.0–12.8: Shop Foundation, Product Card, Category Filter, Editorial Grid, Product Detail, Gallery Experience, UX Polish
- Sprint 13.0–13.3: Shop Architecture Redesign, Category Redesign, Editorial Showroom, Discoverability
- Shop redesigned as single-page Editorial Showroom (no category pages)
- 5 editorial sections: Machines (image left), Ink (horizontal), Needles (image right), Furniture (featured), Others (grid)
- Product badges: Best Seller, New, Limited, Staff Pick, Artist Pick
- "View All (N)" links with product counts for scalability
- Reusable components: Product Card, Category Filter, Loading Skeleton, Footer
- Product Detail: Thumbnail gallery, highlights, horizontal editorial "Why Artists"
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/shop.blade.php` (editorial showroom)
- Created `resources/views/pages/shop-detail.blade.php`
- Created `resources/views/pages/shop-category.blade.php`
- Created `resources/views/components/shop/product-card.blade.php`
- Created `resources/views/components/shop/category-filter.blade.php`
- Created `resources/views/components/shop/loading-skeleton.blade.php`
- Created `resources/views/components/layout/footer.blade.php`
- Updated `app/Http/Controllers/ShopController.php`
- Updated `routes/web.php`
- Updated `resources/views/pages/home.blade.php` (footer component)
- Added `.ai/journal/sprint-12.0.md` through `sprint-13.3.md`

---

### v2.6.0 — Final Art Direction QA (Production Lock Candidate)
**Date**: 2026-07-15
**Status**: Beta (Landing Page v1.0 PRODUCTION LOCK CANDIDATE)

**What's New**:
- Sprint 11.11: Final Art Direction QA (7 tasks)
- Background flow: Hero→About→Services→Shop [WHITE] → Gallery→Artists [BLACK] → Trust [WHITE] → Consultation→Footer [BLACK]
- Services & Shop moved to white chapter with subtle card depth
- Gallery: editorial asymmetric grid (5:7 column ratio, varied heights)
- Artist: moved to dark chapter
- Consultation → Footer separator: subtle white/8% gradient
- All CTAs solid, all text readable, all headings clear
- Final Score: 96/100
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `.ai/journal/sprint-11.11.md`

---

### v2.5.0 - Final Art Direction — Production Candidate
**Date**: 2026-07-15
**Status**: Beta (Landing Page v1.0 FINAL LOCK)

**What's New**:
- Sprint 11.10: Final art direction — 7 tasks
- Chapter-based background flow (White→Dark→White→Dark)
- Footer: Heading opacity 80%, body 70%, all info clearly readable
- Trust: 4.9 rating header + social proof tags + review metadata
- Consultation: Complete redesign → single centered white card
- Shop: Moved to dark chapter (bg-[#0a0a0a])
- CTAs: All solid, no transparency
- Readability: Full audit, all sections clear
- Responsive: QA at 390/430/768/1024/1440/1920px
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `.ai/journal/sprint-11.10.md`

---

### v2.4.0 - Final Art Direction (Final Before Shop)
**Date**: 2026-07-17
**Status**: Beta (Landing Page v1.0 Final Lock Candidate)

**What's New**:
- Sprint 11.9: Final art direction refinement (13 tasks)
- Background rhythm: Feather transitions (h-px gradient lines)
- Typography: All opacity minimum 60%, body text 70-85%
- CTA buttons: All solid, high contrast
- Gallery: CSS masonry columns, varied heights, 16px radius
- Services: Lucide Storefront icon, text opacity 70%
- Shop: Stronger gradient (black/80)
- Consultation: 2-column layout, solid white card
- Reviews: Editorial layout, gold stars #D4AF37, 2+3 grid
- Navbar: Solid black, center nav
- Footer: Clickable address (Google Maps), link opacity 60%
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `.ai/journal/sprint-11.9.md`

---

### v2.3.0 - Landing Page Final Art Direction (Pre-Production Lock)
**Date**: 2026-07-16
**Status**: Beta (Landing Page v1.0 Pre-Production Lock)

**What's New**:
- Sprint 11.6.1: Final art direction refinement (12 tasks)
- Background rhythm: Feather transitions, alternating white/black
- Hero: Overlay dikurangi (bg-black/50 → bg-black/30), foto lebih terbaca
- CTA buttons: Semua solid, kontras tinggi (bukan ghost/transparent)
- Services: Icon storefront untuk Studio, icon representatif
- Shop: Gradient lebih subtle
- Gallery: CSS masonry editorial layout (variasi tinggi gambar)
- Artist: Background putih bersih
- CTA: Solid black (#0a0a0a), focus point
- Reviews: Editorial layout (2 besar + 3 kecil), bintang gold #D4AF37
- Footer: Alamat clickable ke Google Maps
- Build: 0 error, 0 warning

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `.ai/journal/sprint-11.6.1.md`

---

### v2.2.0 - Landing Page Art Direction Refinement (FINAL)
**Date**: 2026-07-15
**Status**: Beta (Landing Page v1.0 Lock Candidate)

**What's New**:
- Sprint 11.6: Complete art direction refinement (12 tasks)
- Navbar: True center navigation, flex-1 layout
- Hero: Identity label "Est. MMXII — Bali, Indonesia"
- Hero: CTA buttons direct links (bukan component)
- Services: Bug fix state independen + editorial visual
- Shop: Editorial asymmetric grid (large + small + wide)
- Gallery: Editorial photography exhibition (mixed aspect ratios)
- Artist: Image dominance 45%, two-line dramatic name
- Trust: Complete redesign — editorial list, bukan card grid
- CTA: Centered headline dominant, whitespace sangat lega
- Visual Rhythm: Section backgrounds bervariasi (white → #fafafa → #111 → #0a0a0a)
- Animation: Duration 250ms (dari 300ms)
- Final Score: 94.1 / 100

**Changes**:
- Updated `resources/views/components/layout/navbar.blade.php` (complete rewrite)
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Updated `resources/css/app.css` (animation duration)
- Added `.ai/journal/sprint-11.6.md` (audit report)

**Known Issues**: None

**Next**: Sprint 12 — Tattoo Supply Shop

---

### v2.1.0 - Landing Page Final Polish & UX Audit
**Date**: 2026-07-15
**Status**: Beta (Landing Page Final Polish)

**What's New**:
- Sprint 11.5: Landing Page Final Polish & UX Audit (14 audits)
- Services cards: Added `relative` for top accent line rendering
- Hero CTA: Changed to white button for visibility on dark overlay
- Hero Secondary: Changed to ghost button (transparent + border)
- Section titles: Standardized to `size="sm"` for Services & Supply
- Gallery/Supply links: Added `cursor-pointer` for consistency
- Services aria-controls: Removed invalid ARIA references
- Button hover: Added scale effect (1.02 hover, 0.98 active)
- CSS transitions: Standardized to 200ms for responsiveness
- Final Landing Page Score: 91.5 / 100

**Changes**:
- Updated `resources/views/pages/home.blade.php` (10 fixes)
- Updated `resources/css/app.css` (3 improvements)
- Added `.ai/journal/sprint-11.5.md` (audit report)

**Known Issues**: None

**Next**: Manual QA Review → v2.2.0 (Shop Page)

---

### v2.0.0 - Footer + Landing Page Complete
**Date**: 2026-07-15
**Status**: Beta (Landing Page Complete)

**What's New**:
- Footer editorial luxury (4 kolom, responsive)
- Brand section (logo + nama + description)
- Quick Links (6 anchor links)
- Studio Information (address, hours, phone, email)
- Connect (Instagram, WhatsApp, TikTok, Facebook)
- Bottom Bar (copyright + "Made with passion in Bali")
- LANDING PAGE SELESAI (Hero hingga Footer)

**Changes**:
- Updated `resources/views/pages/home.blade.php` (Footer implementation)
- Added `.ai/journal/sprint-11.md`

**Known Issues**: None

**Next**: Final Landing Page Review & QA

---

### v1.9.0 - Trust Section (Complete Redesign)
**Date**: 2026-07-15
**Status**: Beta (Landing Page Update)

**What's New**:
- Trust Section complete redesign dari Client Stories
- Section Header: Eyebrow + Heading + Description
- Trust Overview: 4 metrics placeholder (Google Rating, Total Reviews, Years Experience, Countries Served)
- Featured Reviews: 6 review cards dengan foto tattoo (3×2 grid)
- Trust Sources: Google Reviews, Instagram Community, Returning Clients
- Closing Statement

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `public/images/reviews/` (6 placeholder SVGs)
- Added `.ai/journal/sprint-10x.md`

**Known Issues**: None

**Next Version**: v2.0.0 - Footer Section

---

### v1.8.0 - Client Stories (Complete Redesign)
**Date**: 2026-07-15
**Status**: Beta (Landing Page Update)

**What's New**:
- Client Stories complete redesign dari Testimonials
- One Hero Per Section (hanya 1 testimonial tampil)
- Review sebagai HERO (text-xl/2xl/3xl, italic)
- Alpine.js navigation (avatar dots + nama)
- Transisi halus (opacity + translateY, 250ms)
- Whitespace sangat lega (py-32/48/64)
- Tidak ada card, grid, border, shadow

**Changes**:
- Updated `resources/views/pages/home.blade.php` (complete rewrite)
- Added `.ai/journal/sprint-10r.md`

**Known Issues**: None

**Next Version**: v1.9.0 - Footer Section

---

### v1.7.1 - Testimonials Refinement
**Date**: 2026-07-15
**Status**: Beta (Landing Page Update)

**What's New**:
- Testimonials refinement berdasarkan QA findings
- Card feeling dihilangkan (editorial, bukan e-commerce)
- Visual hierarchy: Stars → Review → Client → Country
- Review menjadi elemen paling dominan
- Placeholder .jpeg (SVG dihapus)
- Spacing lebih lega (breathing room)
- Hover sangat halus (hanya border)

**Changes**:
- Updated `resources/views/pages/home.blade.php` (Testimonials refinement)
- Removed `public/images/testimonials/*.svg`

**Known Issues**: None

**Next Version**: v1.8.0 - Footer Section

---

### v1.7.0 - Testimonials Section
**Date**: 2026-07-15
**Status**: Beta (Landing Page Update)

**What's New**:
- Testimonials section dengan 3 client reviews
- Dark theme (bg-[#0a0a0a]) konsisten dengan Artists & CTA
- Card styling: border tipis, radius kecil, hover subtle
- Star rating (white, bukan gold)
- Responsive: 3 desktop, 2 tablet, 1 mobile

**Changes**:
- Updated `resources/views/pages/home.blade.php` (Testimonials section)
- Added `public/images/testimonials/` (3 placeholder SVGs)
- Added `.ai/journal/sprint-10.md`

**Known Issues**: None

**Next Version**: v1.8.0 - Footer Section

---

### v1.6.0 - Consultation CTA
**Date**: 2026-07-14
**Status**: Beta (Landing Page Update)

**What's New**:
- Consultation CTA section sebagai penutup sebelum Testimonials
- Black background dengan centered layout
- WhatsApp CTA dengan MessageCircle icon
- Whitespace sangat lega untuk premium feel

**Changes**:
- Updated `resources/views/pages/home.blade.php` (CTA section)
- Added `.ai/journal/sprint-09.md`

**Known Issues**: None

**Next Version**: v1.7.0 - Testimonials Section

---

### v1.5.0 - Artists Editorial
**Date**: 2026-07-13
**Status**: Beta (Landing Page Update)

**What's New**:
- Gallery section dengan 6 portfolio items
- Artists section dengan featured artist editorial layout

**Changes**:
- Updated `resources/views/pages/home.blade.php` (Gallery + Artists)
- Added placeholder images for gallery and artists

**Known Issues**: None

---

### v0.0.1 - Initial Setup
**Date**: 2026-07-10
**Status**: Alpha (Project Initialization)

**What's New**:
- Initial project setup dengan Laravel 12
- Documentation structure (.ai folder)
- Environment verification complete
- Vite build process working
- Tailwind CSS integrated

**Changes**:
- Created 31 documentation files
- Created .ai folder structure
- Verified all dependencies

**Known Issues**: None

**Next Version**: v0.1.0 - Landing Page & Navigation

---

## Version Naming

Format: `v[Major].[Minor].[Patch]`

- **Major**: Significant feature release atau major refactor
- **Minor**: New features, minor changes
- **Patch**: Bug fixes, documentation updates

## Release Schedule

- Beta: When first MVP features complete
- RC (Release Candidate): When ready untuk testing
- Production: When fully tested dan approved

## Deprecation Policy

Features deprecated akan:
1. Marked as @deprecated di code
2. Documented di release notes
3. Supported untuk minimum 2 major versions
4. Removed di 3rd major version

## Breaking Changes

Breaking changes akan:
1. Clearly documented
2. Only di major versions
3. Accompanied by migration guide
4. Announced di advance

## Changelog Format

Setiap version harus include:

```
### v[Version] - [Release Date]
**Status**: [Alpha/Beta/RC/Stable]

**Features**:
- [New feature 1]
- [New feature 2]

**Improvements**:
- [Improvement 1]
- [Improvement 2]

**Bug Fixes**:
- [Bug fix 1]
- [Bug fix 2]

**Breaking Changes**:
- [Breaking change 1]

**Migration Guide**:
[How to upgrade]

**Known Issues**:
- [Known issue 1]

**Dependencies**:
- [Updated dependencies]
```

## Release Process

1. Create release branch
2. Update version numbers
3. Update changelog
4. Run full test suite
5. Create release tag
6. Generate release notes
7. Deploy jika applicable
8. Announce release

## Rollback Process

Jika issues found di production:
1. Revert ke previous version
2. Fix issue di separate branch
3. Create hotfix release
4. Deploy hotfix

## Documentation Updates

- Update documentation untuk setiap release
- Keep API documentation current
- Update README dengan new features
- Archive old documentation jika needed

## Version Tracking

Current version: **v13.0.0**

```
Legend:
✅ = Completed
🔄 = In Progress
⏳ = Planned
🚫 = Cancelled
```

## Release Timeline

| Version | Target Date | Status | Notes |
|---------|------------|--------|-------|
| v0.0.1  | 2026-07-10 | ✅ Complete | Initial setup |
| v1.5.0  | 2026-07-13 | ✅ Complete | Landing page (Hero, About, Services, Supply, Gallery, Artists) |
| v1.6.0  | 2026-07-14 | ✅ Complete | Consultation CTA |
| v1.7.0  | 2026-07-15 | ✅ Complete | Testimonials Section |
| v1.7.1  | 2026-07-15 | ✅ Complete | Testimonials Refinement |
| v1.8.0  | 2026-07-15 | ✅ Complete | Client Stories (Complete Redesign) |
| v1.9.0  | 2026-07-15 | ✅ Complete | Trust Section (Complete Redesign) |
| v2.0.0  | 2026-07-15 | ✅ Complete | Footer + Landing Page Complete |
| v2.1.0  | 2026-07-15 | ✅ Complete | Landing Page Final Polish & UX Audit (91.5/100) |
| v2.2.0  | 2026-07-15 | ✅ Complete | Art Direction Refinement (v1.0 Lock Candidate) |
| v2.3.0  | 2026-07-16 | ✅ Complete | Final Art Direction — Pre-Production Lock |
| v2.4.0  | 2026-07-17 | ✅ Complete | Final Art Direction — Final Before Shop (95/100) |
| v2.5.0  | 2026-07-15 | ✅ Complete | Final Art Direction — Production Candidate |
| v2.6.0  | 2026-07-15 | ✅ Complete | Final Art Direction QA — Production Lock (96/100) |
| v3.0.0  | 2026-07-16 | ✅ Complete | Shop Foundation + Product Card + Category Filter |
| v3.1.0  | 2026-07-16 | ✅ Complete | Product Detail + Editorial Grid |
| v3.2.0  | 2026-07-16 | ✅ Complete | Shop Architecture Redesign (Collection-First) |
| v3.3.0  | 2026-07-16 | ✅ Complete | Shop Editorial Showroom + Discoverability |
| v3.4.0  | 2026-07-16 | ✅ Complete | Database Architecture FINAL (93/100) |
| v3.5.0  | 2026-07-16 | ✅ Complete | Database Migration Foundation (16 tables) |
| v3.6.0  | 2026-07-16 | ✅ Complete | Eloquent Models & Relationships (16 models) |
| v3.7.0  | 2026-07-16 | ✅ Complete | Database Seeder Foundation (6 seeders, 39 records) |
| v3.8.0  | 2026-07-16 | ✅ Complete | Repository & Service Foundation (6 repos, 5 services) |
| v3.9.0  | 2026-07-16 | ✅ Complete | Admin Authentication Foundation |
| v4.0.0  | 2026-07-16 | ✅ Complete | Admin Dashboard Foundation |
| v4.1.0  | 2026-07-16 | ✅ Complete | Admin Product Management (Index) |
| v4.2.0  | 2026-07-16 | ✅ Complete | Admin Product CRUD (Create & Edit Foundation) |
| v4.3.0  | 2026-07-16 | ✅ Complete | Product CRUD Backend (Store & Update) |
| v4.4.0  | 2026-07-16 | ✅ Complete | Product CRUD Backend (Delete + Status Management) |
| v4.5.0  | 2026-07-16 | ✅ Complete | Product Image Upload System |
| v4.6.0  | 2026-07-16 | ✅ Complete | Landing Page CMS Foundation |
| v4.7.0  | 2026-07-16 | ✅ Complete | Portfolio Management (Admin CMS) |
| v4.8.0  | 2026-07-16 | ✅ Complete | Booking Management Dashboard |
| v4.9.0  | 2026-07-16 | ✅ Complete | Booking Detail & Status Management |
| v5.0.0  | 2026-07-17 | ✅ Complete | Review Management CMS |
| v5.1.0  | 2026-07-17 | ✅ Complete | Contact Inbox Management |
| v5.2.0  | 2026-07-17 | ✅ Complete | Admin Auth Fix |
| v5.3.0  | 2026-07-17 | ✅ Complete | Database Schema & Admin CRUD Stabilization |
| v5.4.0  | 2026-07-17 | ✅ Complete | Admin UX Polish |
| v6.0.0  | 2026-07-17 | ✅ Complete | Booking Flow & WhatsApp Integration |
| v6.1.0  | 2026-07-17 | ✅ Complete | Booking CTA Optimization & WhatsApp Fix |
| v6.2.0  | 2026-07-17 | ✅ Complete | Booking CTA Visual Polish |
| v7.0.0  | 2026-07-17 | ✅ Complete | Public Shop & Product Detail (Dynamic) |
| v7.1.0  | 2026-07-17 | ✅ Complete | Shop Category Experience & Product WhatsApp |
| v8.0.0  | 2026-07-17 | ✅ Complete | Gallery Experience & Portfolio Detail |
| v8.1.0  | 2026-07-17 | ✅ Complete | Global Navigation & CTA Consistency |
| v8.2.0  | 2026-07-18 | ✅ Complete | Final QA & Production Readiness (8 bugs fixed) |
| v8.3.0  | 2026-07-19 | ✅ Complete | UX, Navigation & Conversion Finalization |
| v9.0.0  | 2026-07-19 | ✅ Complete | Database Finalization & Production Foundation |
| v9.1.0  | 2026-07-19 | ✅ Complete | Admin CMS Finalization & Content Management Polish |
| v9.2.0  | 2026-07-20 | ✅ Complete | Production Content Readiness & UI Polish |
| v9.3.0  | 2026-07-20 | ✅ Complete | QA Manual Fixes (Production Blocking) |
| v9.4.0  | 2026-07-20 | ✅ Complete | Product Gallery UX Refactor + Shop Navigation Fix |
| v9.5.0  | 2026-07-20 | ✅ Complete | Product Gallery Architecture + Shop Navigation Final Fix |
| v9.6.0  | 2026-07-20 | ✅ Complete | Product Gallery Final Fix + Shop Category Navigation Final Fix |
| v13.0.0 | 2026-08-04 | ✅ Complete | Landing Page UI Retouch (Hero CTA, About gradients, Gallery spacing, CTA consistency) |
| v13.0.1 | 2026-08-05 | ✅ Complete | About Photo Alignment Final (Sprint 40.4.6) |
| v13.0.2 | 2026-08-05 | ✅ Complete | Hero Responsive Polish (Sprint 40.5.1) |
| v13.0.3 | 2026-08-05 | ✅ Complete | Hero Responsive Fix — Revision (Sprint 40.5.1.1) |
| v13.0.4 | 2026-08-05 | ✅ Complete | Hero Responsive Final Fix (Sprint 40.5.1.2) |
| v13.0.5 | 2026-08-05 | ✅ Complete | Hero Responsive Architecture Final (Sprint 40.5.1.3) |
| v13.0.6 | 2026-08-05 | ✅ Complete | About Final Polish — Desktop (Sprint 40.6.0) |
| v13.0.7 | 2026-08-05 | ✅ Complete | About Layout Architecture CMS-Safe (Sprint 40.6.1) |
| v13.0.8 | 2026-08-05 | ✅ Complete | About Image Layout Rework (Sprint 40.6.2) |
| v13.0.9 | 2026-08-05 | ✅ Complete | About Image Final — Remove Empty Frame (Sprint 40.6.3) |
| v13.0.10 | 2026-08-05 | ✅ Complete | About Final Layout — Keep Original Section Size (Sprint 40.6.4) |

## Semantic Versioning

Project ini follow Semantic Versioning 2.0.0:

- **MAJOR** version ketika membuat incompatible API changes
- **MINOR** version ketika add functionality di backward compatible manner
- **PATCH** version ketika membuat backward compatible bug fixes

## Commit Messages untuk Changes

Setiap commit harus reference version-nya:

```
v0.1.0: Add landing page hero section
v0.1.0: Fix responsive navigation menu
v0.2.0: Add portfolio gallery component
```

---

**Last Updated**: 2026-08-05
**Current Version**: v13.0.10
**Status**: PRODUCTION READY (Final UI Retouch)
**Next**: Payment Integration → MySQL Migration → Deployment
