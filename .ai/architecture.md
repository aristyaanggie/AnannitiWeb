# Arsitektur

Dokumen ini mendeskripsikan arsitektur sistem Ananniti Tattoo Bali.

**Last Updated**: 2026-07-24
**Based on**: v12.0.0 (Sprint 39 — Tattoo Supply CMS Complete)

## Arsitektur Aplikasi

### Level Tinggi

```
[Browser Client]
    ↓
[Vite Dev Server / Laravel Server]
    ↓
[Blade Templates + Tailwind CSS + Alpine.js]
    ↓
[Aplikasi Laravel]
    ↓
[Database]
```

### Layer

1. **Presentation Layer**
   - Blade templates (43+ files)
   - Styling Tailwind CSS 4.0
   - JavaScript: Alpine.js (interactivity) + Axios (HTTP)
   - Vite 7.x bundling

2. **Application Layer**
   - Controllers (15 total: 4 public + 9 admin + 1 base + 1 auth)
   - Service classes (11 services)
   - Middleware (AdminMiddleware)
   - Form Requests (10 request classes)

3. **Domain Layer**
   - Models (17 Eloquent models)
   - Business logic (in Services)
   - Validation rules (in Form Requests)
   - Concerns (FormatsWhatsAppNumber trait)

4. **Data Layer**
   - Repositories (6 implementations + 6 contracts)
   - Database queries (Eloquent ORM)
   - Migrations (21 files, 17 custom tables)

## Struktur Direktori

```
app/
├── Concerns/                    # Shared traits
│   └── FormatsWhatsAppNumber.php
├── Console/                     # Artisan commands
│   └── Kernel.php
├── Exceptions/                  # Custom exceptions
│   └── Handler.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/               # 8 admin controllers
│   │   │   ├── AdminAuthController.php
│   │   │   ├── AdminBookingController.php
│   │   │   ├── AdminContactController.php
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── AdminPortfolioController.php
│   │   │   ├── AdminProductController.php
│   │   │   ├── AdminReviewController.php
│   │   │   └── AdminSectionController.php
│   │   ├── BookingController.php
│   │   ├── Controller.php
│   │   ├── GalleryController.php
│   │   ├── HomeController.php
│   │   └── ShopController.php
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Requests/                # 8 form request classes
│       ├── StorePortfolioRequest.php
│       ├── StoreProductRequest.php
│       ├── StoreReviewRequest.php
│       ├── UpdateBookingRequest.php
│       ├── UpdatePortfolioRequest.php
│       ├── UpdateProductRequest.php
│       ├── UpdateReviewRequest.php
│       └── UpdateSectionRequest.php
├── Models/                      # 16 Eloquent models
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
│   ├── User.php
│   └── WhatsappTemplate.php
├── Providers/
│   └── AppServiceProvider.php   # Repository bindings
├── Repositories/                 # 6 implementations
│   ├── BookingRepository.php
│   ├── CategoryRepository.php
│   ├── ProductRepository.php
│   ├── ReviewRepository.php
│   ├── SectionRepository.php
│   ├── SettingRepository.php
│   └── Contracts/               # 6 interfaces
│       ├── BookingRepositoryInterface.php
│       ├── CategoryRepositoryInterface.php
│       ├── ProductRepositoryInterface.php
│       ├── ReviewRepositoryInterface.php
│       ├── SectionRepositoryInterface.php
│       └── SettingRepositoryInterface.php
└── Services/                    # 11 service classes
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

resources/
├── css/
│   └── app.css                  # Tailwind + custom animations + design tokens
├── js/
│   ├── app.js                   # Main JS entry
│   └── bootstrap.js             # Alpine.js + Axios setup
└── views/
    ├── admin/                   # 16 admin blade files
    ├── auth/                    # login.blade.php
    ├── components/              # 16 reusable components
    │   ├── icon/ (3), layout/ (5), shop/ (3), ui/ (5)
    ├── layouts/                 # admin.blade.php, app.blade.php
    └── pages/                   # 8 public page templates

database/
├── migrations/                  # 20 migration files
├── seeders/                     # 8 seeder files
└── factories/                   # Model factories

config/
└── ananniti.php                 # Studio info, contact, social, hours, payment

routes/
└── web.php                      # ~50 active routes (all in one file)
```

## Alur Data

### Alur Page Request

1. User request halaman
2. Laravel router match route (routes/web.php)
3. Middleware check (auth, admin)
4. Controller diinvoke
5. Controller fetch data dari Service/Repository/Model
6. Data passed ke Blade template
7. Template render HTML dengan Tailwind CSS + Alpine.js
8. Vite bundle CSS dan JS
9. Response dikirim ke browser

### Alur Form Submission

1. User submit form
2. FormRequest validate data (StoreProductRequest, UpdateBookingRequest, dll)
3. Controller process request
4. Service handle business logic (ProductService, BookingService, dll)
5. Repository access data (ProductRepository, BookingRepository, dll)
6. Model persist data ke database
7. Flash message + redirect

## Stack Teknologi

- **Backend Framework**: Laravel 12.63.0
- **PHP Version**: 8.2+
- **Frontend Templating**: Blade
- **Styling**: Tailwind CSS 4.0.0
- **Build Tool**: Vite 7.0.7
- **JavaScript**: Alpine.js 3.13.0, Axios 1.11.0
- **Icons**: Lucide React 0.396.0
- **Code Formatter**: Laravel Pint 1.24
- **Testing**: PHPUnit 11.5.50

## Design Patterns

### Implemented

- **MVC Pattern**: Controllers → Services → Models → Database
- **Repository Pattern**: 6 repositories dengan contracts (interfaces) untuk data access abstraction
- **Service Layer Pattern**: 11 services untuk business logic separation
- **Dependency Injection**: AppServiceProvider binds repository interfaces ke implementations
- **Form Request Pattern**: 8 form request classes untuk validation
- **Trait Pattern**: FormatsWhatsAppNumber shared across 3 controllers
- **Middleware Pattern**: AdminMiddleware untuk role-based access control

### Dependency Injection (AppServiceProvider)

```php
// Repository bindings
ProductRepositoryInterface → ProductRepository
CategoryRepositoryInterface → CategoryRepository
BookingRepositoryInterface → BookingRepository
ReviewRepositoryInterface → ReviewRepository
SectionRepositoryInterface → SectionRepository
SettingRepositoryInterface → SettingRepository
```

## Pertimbangan Skalabilitas

- Database: SQLite (dev) → MySQL/PostgreSQL (production)
- Repository pattern memudahkan testing dan migration
- Service layer memudahkan refactoring tanpa mengubah controller
- Soft delete pada users dan products menjaga data integrity
- Indexes pada columns yang sering di-query
- Composite indexes untuk query filtering + sorting
