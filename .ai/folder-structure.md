# Struktur Folder

Dokumentasi lengkap struktur folder project Ananniti Tattoo Bali.

**Last Updated**: 2026-07-24
**Based on**: v12.0.0 (Sprint 39 — Tattoo Supply CMS Complete)

## Level Root

```
ananniti-tattoo/
├── .ai/                    # Dokumentasi AI & guidelines
├── .env                    # Environment variables (not committed)
├── .env.example            # Environment template
├── .editorconfig           # Editor configuration
├── .gitattributes          # Git attributes
├── .gitignore              # Git ignore rules
├── app/                    # Application source code
├── bootstrap/              # Application bootstrap
├── config/                 # Configuration files
├── database/               # Database migrations & seeds
├── node_modules/           # NPM dependencies (not committed)
├── public/                 # Public assets
├── resources/              # Frontend resources
├── routes/                 # Route definitions
├── storage/                # Storage (logs, cache, uploads)
├── tests/                  # Test files
├── vendor/                 # Composer dependencies (not committed)
├── artisan                 # Artisan CLI
├── composer.json           # Composer configuration
├── composer.lock           # Composer lock file
├── package.json            # NPM configuration
├── package-lock.json       # NPM lock file
├── phpunit.xml             # PHPUnit configuration
├── README.md               # Project README
└── vite.config.js          # Vite configuration
```

## Folder .ai/ Dokumentasi

```
.ai/
├── ai-rules.md             # Aturan development AI
├── README.md               # Panduan dokumentasi
├── project.md              # Overview project
├── design.md               # Design system (finalized)
├── architecture.md         # Arsitektur sistem
├── roadmap.md              # Roadmap product
├── coding-rules.md         # Coding standards
├── folder-structure.md     # File ini
├── review-checklist.md     # Checklist code review
├── tech-stack.md           # Detail technology stack
├── ui-components.md        # Inventory UI components
├── flowchart.md            # Flowchart aplikasi
├── erd.md                  # Entity relationship diagrams
├── database-schema.md      # Database schema docs
├── database-review.md      # Database architecture review (FINAL)
├── api-plan.md             # Dokumentasi API plan
├── deployment.md           # Panduan deployment
│
├── context/
│   ├── design-system.md    # Detail design system
│   ├── spacing.md          # Panduan spacing
│   ├── typography.md       # Standar typography
│   ├── animation.md        # Panduan animation
│   ├── assets.md           # Asset management
│   ├── responsive.md       # Responsive design
│   ├── copywriting.md      # Panduan copywriting
│   ├── reusable-components.md
│   ├── naming-convention.md
│   ├── ui-philosophy.md
│   └── visual-reference.md
│
├── todos/
│   ├── 01-design-foundation.md # Setup checklist
│   └── progress.md         # Progress tracking
│
└── journal/
    ├── sprint-00.md        # Project initialization
    ├── sprint-01.md        # Design foundation
    ├── sprint-02.md        # Landing page & navbar
    ├── sprint-02.1.md      # Navbar QA revision
    ├── sprint-03.md        # Hero section
    ├── sprint-03-analysis-revision.md
    ├── sprint-03-revision.md
    ├── sprint-03-revision-final.md
    ├── sprint-03-pixel-perfect-analysis.md
    ├── sprint-03-pixel-perfect-final.md
    ├── sprint-03-visual-reference-alignment.md
    ├── sprint-04-analysis.md
    ├── sprint-04-final.md
    ├── sprint-05-analysis.md
    ├── sprint-05-revision-analysis.md
    ├── sprint-05-revision-final.md
    ├── sprint-05-final-revision-analysis.md
    ├── sprint-05-final-revision-report.md
    ├── sprint-05-final.md
    ├── sprint-05-visual-polish-final.md
    ├── sprint-05-ux-refinement-analysis.md
    ├── sprint-05-ux-refinement-final.md
    ├── sprint-06-analysis.md
    ├── sprint-06-final.md
    ├── sprint-07.md        # Gallery
    ├── sprint-07.1.md      # Gallery refinement
    ├── sprint-08.md        # Artists
    ├── sprint-08-editorial.md
    ├── sprint-09.md        # Consultation CTA
    ├── sprint-10.md        # Testimonials
    ├── sprint-10.1.md      # Testimonials refinement
    ├── sprint-10r.md       # Client Stories redesign
    ├── sprint-10x.md       # Trust Section redesign
    ├── sprint-11.md        # Footer
    ├── sprint-11.5.md      # Final polish & UX audit
    ├── sprint-11.6.md      # Art direction refinement
    ├── sprint-11.6.1.md    # Final art direction pre-lock
    ├── sprint-11.9.md      # Final art direction final
    ├── sprint-11.10.md     # Final art direction production
    ├── sprint-11.11.md     # Final art direction QA
    ├── sprint-12.0.md      # Shop foundation
    ├── sprint-12.1.md      # Product card system
    ├── sprint-12.2.md      # Category filter system
    ├── sprint-12.3.md      # Editorial product grid
    ├── sprint-12.4.md      # Product detail foundation
    ├── sprint-12.5.md      # Product gallery experience
    ├── sprint-12.6.md      # Shop discovery experience
    ├── sprint-12.7.md      # Shop UX polish & pagination
    ├── sprint-12.8.md      # Shop UX redesign
    ├── sprint-12.X.md      # Shop experience redesign final
    ├── sprint-13.0.md      # Shop architecture redesign
    ├── sprint-13.1.md      # Category page redesign
    ├── sprint-13.2.md      # Shop editorial showroom
    ├── sprint-13.3.md      # Product discoverability
    ├── sprint-14.1.md      # Database final refinement
    ├── sprint-14.2.md      # Database migration foundation
    ├── sprint-14.3.md      # Eloquent models & relationships
    ├── sprint-14.4.md      # Database seeder foundation
    ├── sprint-14.5.md      # Repository & service foundation
    ├── sprint-14.6.md      # Admin authentication
    ├── sprint-14.7.md      # Admin dashboard
    ├── sprint-14.8.md      # Admin product management
    ├── sprint-14.9.md      # Admin product CRUD
    ├── sprint-14.10.md     # Product CRUD backend
    ├── sprint-14.11.md     # Product delete & status
    ├── sprint-14.12.md     # Product image upload
    ├── sprint-14.13.md     # Landing page CMS
    ├── sprint-14.14.md     # Portfolio management
    ├── sprint-14.15.md     # Booking management
    ├── sprint-14.16.md     # Booking detail & status
    ├── sprint-17.md        # Public shop & product detail
    ├── sprint-17.1.md      # Shop category & WhatsApp
    ├── sprint-18.md        # Gallery experience & portfolio
    ├── sprint-19.md        # Final QA & production readiness
    ├── sprint-19.1.md      # UX, navigation & conversion finalization
    ├── sprint-20.md        # Database finalization & production foundation
    ├── sprint-21.md        # Admin CMS finalization & content management polish
    ├── sprint-31.md        # Project stabilization
    ├── sprint-32.md        # Performance & query optimization
    ├── sprint-33.md        # Admin Category CRUD
    ├── sprint-34.md        # Studio Settings + Single Artist
    ├── sprint-34.1.md      # Manual QA
    ├── sprint-35.md        # Production content & brand audit
    ├── sprint-35.1.md      # Single artist cleanup
    ├── sprint-35.2.md      # Single artist runtime cleanup
    ├── sprint-35.3.md      # Final single artist runtime fix
    ├── sprint-36.md        # Brand Assets CMS
    ├── sprint-36.1.md      # Brand Assets runtime fix
    ├── sprint-37.md        # Admin polish preparation (read only)
    ├── sprint-38.1.md      # Public UI typography & gallery contrast
    ├── sprint-38.2.md      # Global public UI contrast & color consistency
    ├── sprint-38.3.md      # Final public CTA & footer typography fix
    ├── sprint-38.3R.md     # Rollback & fix typography (strict)
    ├── sprint-39.md        # Landing page tattoo supply CMS
    ├── change-log.md       # Change history
    ├── decision-log.md     # Major decisions
    ├── known-issues.md     # Issues & workarounds
    ├── component-verification.md
    └── cta-update.md
```

## Folder app/ Application Code

```
app/
├── Concerns/
│   └── FormatsWhatsAppNumber.php    # Shared trait (Sprint 19)
├── Console/
│   └── Kernel.php
├── Exceptions/
│   └── Handler.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── AdminAuthController.php
│   │   │   ├── AdminBookingController.php
│   │   │   ├── AdminContactController.php
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── AdminPortfolioController.php
│   │   │   ├── AdminProductController.php
│   │   │   ├── AdminReviewController.php
│   │   │   ├── AdminSectionController.php
│   │   │   └── AdminTattooSupplyController.php
│   │   ├── BookingController.php
│   │   ├── Controller.php
│   │   ├── GalleryController.php
│   │   ├── HomeController.php
│   │   └── ShopController.php
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Requests/
│       ├── StorePortfolioRequest.php
│       ├── StoreProductRequest.php
│       ├── StoreReviewRequest.php
│       ├── StoreTattooSupplyRequest.php
│       ├── UpdateBookingRequest.php
│       ├── UpdatePortfolioRequest.php
│       ├── UpdateProductRequest.php
│       ├── UpdateReviewRequest.php
│       ├── UpdateSectionRequest.php
│       └── UpdateTattooSupplyRequest.php
├── Models/
│   ├── ArtistProfile.php
│   ├── AuditLog.php
│   ├── Booking.php
│   ├── BookingService.php
│   ├── Category.php
│   ├── Contact.php
│   ├── PortfolioItem.php
│   ├── Product.php
│   ├── ProductBadge.php
│   ├── ProductGallery.php
│   ├── Review.php
│   ├── Section.php
│   ├── SectionItem.php
│   ├── Setting.php
│   ├── TattooSupply.php
│   ├── User.php
│   └── WhatsappTemplate.php
├── Providers/
│   └── AppServiceProvider.php
├── Repositories/
│   ├── BookingRepository.php
│   ├── CategoryRepository.php
│   ├── ProductRepository.php
│   ├── ReviewRepository.php
│   ├── SectionRepository.php
│   ├── SettingRepository.php
│   └── Contracts/
│       ├── BookingRepositoryInterface.php
│       ├── CategoryRepositoryInterface.php
│       ├── ProductRepositoryInterface.php
│       ├── ReviewRepositoryInterface.php
│       ├── SectionRepositoryInterface.php
│       └── SettingRepositoryInterface.php
└── Services/
    ├── BookingManagementService.php
    ├── BookingService.php
    ├── ContactManagementService.php
    ├── DashboardService.php
    ├── LandingPageService.php
    ├── PortfolioService.php
    ├── ProductService.php
    ├── ReviewManagementService.php
    ├── ReviewService.php
    ├── SectionService.php
    └── SettingService.php
```

## Folder resources/ Frontend Resources

```
resources/
├── css/
│   └── app.css             # Main CSS (Tailwind + custom animations + design tokens)
│
├── js/
│   ├── app.js              # Main JS entry
│   └── bootstrap.js        # Alpine.js + Axios setup
│
└── views/
    ├── admin/
    │   ├── bookings/
    │   │   ├── index.blade.php       # Booking list (summary cards + table)
    │   │   └── show.blade.php        # Booking detail + status + WhatsApp
    │   ├── contacts/
    │   │   ├── index.blade.php       # Contact inbox
    │   │   └── show.blade.php        # Contact detail
    │   ├── content/
    │   │   ├── form.blade.php        # Section edit form
    │   │   └── index.blade.php       # Content list (9 sections)
    │   ├── dashboard.blade.php       # Admin dashboard (stats + recent bookings)
    │   ├── home.blade.php            # Admin home redirect
    │   ├── portfolio/
    │   │   ├── form.blade.php        # Portfolio create/edit form
    │   │   └── index.blade.php       # Portfolio list
    │   ├── products/
    │   │   ├── form.blade.php        # Product create/edit form
    │   │   └── index.blade.php       # Product list (summary cards + table)
    │   ├── reviews/
    │   │   ├── form.blade.php        # Review create/edit form
    │   │   └── index.blade.php       # Review list
    │   ├── tattoo-supplies/
    │   │   ├── form.blade.php        # Tattoo supply create/edit form
    │   │   └── index.blade.php       # Tattoo supply list
    ├── auth/
    │   └── login.blade.php           # Admin login page
    ├── components/
    │   ├── icon/
    │   │   ├── instagram.blade.php
    │   │   ├── message-circle.blade.php
    │   │   └── whatsapp.blade.php
    │   ├── layout/
    │   │   ├── container.blade.php   # max-w-6xl responsive container
    │   │   ├── footer.blade.php      # Reusable footer (4-column editorial)
    │   │   ├── navbar.blade.php      # Sticky dark navbar + Alpine.js mobile
    │   │   ├── section-title.blade.php # Section title component
    │   │   └── section.blade.php     # Section spacing wrapper
    │   ├── shop/
    │   │   ├── category-filter.blade.php  # Alpine.js category filter
    │   │   ├── loading-skeleton.blade.php # Loading skeleton
    │   │   └── product-card.blade.php     # Reusable product card
    │   └── ui/
    │       ├── button-with-icon.blade.php # Button + Lucide icon
    │       ├── button.blade.php           # Primary/secondary button
    │       ├── delete-modal.blade.php     # Delete confirmation modal
    │       ├── link.blade.php             # Styled link
    │       └── status-badge.blade.php     # Status badge component
    ├── layouts/
    │   ├── admin.blade.php          # Admin layout (sidebar + content)
    │   └── app.blade.php            # Public layout (navbar + content + footer)
    ├── pages/
    │   ├── artist-profile.blade.php # Artist profile + portfolio masonry
    │   ├── booking.blade.php        # Public booking form (WhatsApp)
    │   ├── gallery.blade.php        # Editorial masonry gallery + filter
    │   ├── home.blade.php           # Landing page (9 sections)
    │   ├── portfolio-detail.blade.php # Portfolio detail + artist card
    │   ├── shop-category.blade.php  # Shop category page
    │   ├── shop-detail.blade.php    # Product detail (editorial layout)
    │   └── shop.blade.php           # Shop showroom (editorial sections)
    └── welcome.blade.php            # Laravel default welcome
```

## Folder database/ Database

```
database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php      # Users + roles + soft delete
│   ├── 0001_01_01_000001_create_cache_table.php      # Cache
│   ├── 0001_01_01_000002_create_jobs_table.php       # Jobs queue
│   ├── 2026_07_16_000001_create_sections_table.php   # Landing page sections
│   ├── 2026_07_16_000002_create_section_items_table.php # Section content blocks
│   ├── 2026_07_16_000003_create_categories_table.php # Shop + gallery categories
│   ├── 2026_07_16_000004_create_product_badges_table.php # Product badges
│   ├── 2026_07_16_000005_create_products_table.php   # Shop products
│   ├── 2026_07_16_000006_create_product_galleries_table.php # Product images
│   ├── 2026_07_16_000007_create_artist_profiles_table.php # Artist info
│   ├── 2026_07_16_000008_create_portfolio_items_table.php # Gallery artwork
│   ├── 2026_07_16_000009_create_bookings_table.php   # Tattoo bookings
│   ├── 2026_07_16_000010_create_booking_services_table.php # Service types
│   ├── 2026_07_16_000011_create_reviews_table.php    # Customer reviews
│   ├── 2026_07_16_000012_create_contacts_table.php   # Contact submissions
│   ├── 2026_07_16_000013_create_settings_table.php   # Website config
│   ├── 2026_07_16_000014_create_audit_logs_table.php # Admin activity
│   ├── 2026_07_16_000015_create_whatsapp_templates_table.php # WA messages
│   ├── 2026_07_17_043338_add_status_to_contacts_table.php   # Contact status
│   ├── 2026_07_17_101524_add_slug_to_portfolio_items_table.php # Portfolio slug
│   ├── 2026_07_23_000001_add_social_fields_to_artist_profiles_table.php # Artist social
│   ├── 2026_07_23_000002_reassign_artists_to_single_artist.php # Single artist
│   └── 2026_07_25_000001_create_tattoo_supplies_table.php # Tattoo supply CMS
│
├── seeders/
│   ├── ArtistProfileSeeder.php      # Sample artist profiles
│   ├── CategorySeeder.php           # 6 product categories
│   ├── DatabaseSeeder.php           # Master seeder (calls all)
│   ├── ProductBadgeSeeder.php       # 6 product badges
│   ├── SectionSeeder.php            # 9 landing page sections
│   ├── SettingSeeder.php            # 13 website configuration items
│   ├── TattooSupplySeeder.php       # 6 tattoo supply cards
│   ├── UserSeeder.php               # Admin user account
│   └── WhatsappTemplateSeeder.php   # 4 WhatsApp message templates
│
└── factories/                       # Model factories (for testing)
```

## Folder config/ Configuration

```
config/
├── ananniti.php       # Studio info, contact, social, hours, maps, payment
├── app.php            # Laravel application config
├── auth.php           # Authentication config
├── cache.php          # Cache config
├── database.php       # Database config
├── filesystems.php    # File storage config
├── logging.php        # Logging config
├── mail.php           # Mail config
├── queue.php          # Queue config
├── services.php       # Third-party services config
└── session.php        # Session config
```

## Routes Summary

```
GET  /                           → HomeController@index (home)
GET  /shop                       → ShopController@index (shop showroom)
GET  /shop/{category}            → ShopController@category (category page)
GET  /shop/product/{slug}        → ShopController@show (product detail)
GET  /booking                    → BookingController@create (booking form)
POST /booking                    → BookingController@store (submit booking)
GET  /gallery                    → GalleryController@index (gallery)
GET  /gallery/{slug}             → GalleryController@show (portfolio detail)
GET  /artists/{slug}             → GalleryController@artist (artist profile)

GET  /admin/login                → AdminAuthController@showLogin (guest)
POST /admin/login                → AdminAuthController@login (guest)
POST /admin/logout               → AdminAuthController@logout (auth+admin)

GET  /admin                      → AdminDashboardController@index
GET  /admin/products             → AdminProductController@index
GET  /admin/products/create      → AdminProductController@create
POST /admin/products             → AdminProductController@store
GET  /admin/products/{id}/edit   → AdminProductController@edit
PUT  /admin/products/{id}        → AdminProductController@update
DELETE /admin/products/{id}      → AdminProductController@destroy
POST /admin/products/{id}/toggle-status → AdminProductController@toggleStatus
POST /admin/products/{id}/restore      → AdminProductController@restore
DELETE /admin/products/gallery/{id}    → AdminProductController@destroyGalleryImage

GET  /admin/content              → AdminSectionController@index
GET  /admin/content/{id}/edit    → AdminSectionController@edit
PUT  /admin/content/{id}         → AdminSectionController@update

GET  /admin/portfolio            → AdminPortfolioController@index
GET  /admin/portfolio/create     → AdminPortfolioController@create
POST /admin/portfolio            → AdminPortfolioController@store
GET  /admin/portfolio/{id}/edit  → AdminPortfolioController@edit
PUT  /admin/portfolio/{id}       → AdminPortfolioController@update
DELETE /admin/portfolio/{id}     → AdminPortfolioController@destroy

GET  /admin/reviews              → AdminReviewController@index
GET  /admin/reviews/create       → AdminReviewController@create
POST /admin/reviews              → AdminReviewController@store
GET  /admin/reviews/{id}/edit    → AdminReviewController@edit
PUT  /admin/reviews/{id}         → AdminReviewController@update
DELETE /admin/reviews/{id}       → AdminReviewController@destroy
POST /admin/reviews/{id}/toggle-status    → AdminReviewController@toggleStatus
POST /admin/reviews/{id}/toggle-featured  → AdminReviewController@toggleFeatured

GET  /admin/contacts             → AdminContactController@index
GET  /admin/contacts/{id}        → AdminContactController@show
POST /admin/contacts/{id}/mark-read     → AdminContactController@markRead
POST /admin/contacts/{id}/mark-replied  → AdminContactController@markReplied
DELETE /admin/contacts/{id}      → AdminContactController@destroy

GET  /admin/bookings             → AdminBookingController@index
GET  /admin/bookings/{id}        → AdminBookingController@show
PUT  /admin/bookings/{id}        → AdminBookingController@update

Total: ~50 active routes
```

## Component Inventory

### UI Components (5)
- `button.blade.php` — Primary/secondary button (sm/md/lg)
- `button-with-icon.blade.php` — Button + Lucide icon
- `link.blade.php` — Styled link with focus states
- `delete-modal.blade.php` — Delete confirmation modal (dynamic actionLabel)
- `status-badge.blade.php` — Status badge component

### Layout Components (5)
- `navbar.blade.php` — Sticky dark navbar + Alpine.js mobile menu
- `footer.blade.php` — 4-column editorial luxury footer
- `container.blade.php` — max-w-6xl responsive container
- `section.blade.php` — Section spacing wrapper (sm/md/lg)
- `section-title.blade.php` — Section title + subtitle + alignment

### Shop Components (3)
- `product-card.blade.php` — Reusable product card (image, title, category, price, badge)
- `category-filter.blade.php` — Alpine.js category filter (horizontal scroll)
- `loading-skeleton.blade.php` — Loading skeleton placeholder

### Icon Components (3)
- `message-circle.blade.php` — Lucide MessageCircle icon
- `whatsapp.blade.php` — WhatsApp icon
- `instagram.blade.php` — Instagram icon
