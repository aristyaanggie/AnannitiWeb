# Sprint 14.3 — Eloquent Models & Relationships

**Date**: 2026-07-16
**Status**: ✅ COMPLETE

## Objective

Implementasikan seluruh Eloquent Model berdasarkan migration FINAL.

## Models Created (16 total)

| # | Model | Table | SoftDeletes | Relationships |
|---|-------|-------|-------------|---------------|
| 1 | User | users | YES | hasOne ArtistProfile, hasMany Bookings, hasMany AuditLogs |
| 2 | Section | sections | NO | hasMany SectionItems |
| 3 | SectionItem | section_items | NO | belongsTo Section |
| 4 | Category | categories | NO | hasMany Products, hasMany PortfolioItems |
| 5 | Product | products | YES | belongsTo Category, belongsTo ProductBadge, hasMany ProductGalleries, hasMany Reviews |
| 6 | ProductGallery | product_galleries | NO | belongsTo Product |
| 7 | ProductBadge | product_badges | NO | hasMany Products |
| 8 | ArtistProfile | artist_profiles | NO | belongsTo User, hasMany PortfolioItems, hasMany Bookings, hasMany Reviews |
| 9 | PortfolioItem | portfolio_items | NO | belongsTo Category, belongsTo ArtistProfile |
| 10 | Booking | bookings | NO | belongsTo User, belongsTo ArtistProfile, hasMany BookingServices |
| 11 | BookingService | booking_services | NO | belongsTo Booking |
| 12 | Review | reviews | NO | belongsTo Product, belongsTo ArtistProfile |
| 13 | Contact | contacts | NO | (standalone) |
| 14 | Setting | settings | NO | (standalone) |
| 15 | AuditLog | audit_logs | NO | belongsTo User |
| 16 | WhatsappTemplate | whatsapp_templates | NO | (standalone) |

## Validation

```
✓ php artisan optimize — Framework cached successfully
✓ php artisan migrate:fresh — 18 migrations, 0 errors
✓ Build successful (2.44s)
✓ CSS: 101.47 kB
✓ JS: 92.32 kB
✓ Errors: 0
✓ Warnings: 0
```

## Fillable

All 16 models have `$fillable` arrays defined. No `guarded` usage.

## Casts

All models have proper casts:
- `boolean` for is_active, is_visible, is_featured, is_read, is_primary, is_active
- `datetime` for timestamps (email_verified_at, last_login_at, published_at, whatsapp_sent_at)
- `date` for booking_date
- `decimal:2` for price fields
- `integer` for stock_quantity, minimum_stock, display_order, rating, experience_years, session_hours, duration
- `array` for meta, old_values, new_values

## Relationships Summary

- User ↔ ArtistProfile: one-to-one
- User → Bookings: one-to-many
- User → AuditLogs: one-to-many
- Section → SectionItems: one-to-many
- Category → Products: one-to-many
- Category → PortfolioItems: one-to-many
- Product → ProductGalleries: one-to-many
- Product → Reviews: one-to-many
- Product → ProductBadge: many-to-one (nullable)
- ArtistProfile → PortfolioItems: one-to-many
- ArtistProfile → Bookings: one-to-many
- ArtistProfile → Reviews: one-to-many
- ArtistProfile → User: many-to-one (nullable)
- Booking → BookingServices: one-to-many
- Booking → User: many-to-one (nullable)
- Booking → ArtistProfile: many-to-one (nullable)
- Review → Product: many-to-one (nullable)
- Review → ArtistProfile: many-to-one (nullable)
- AuditLog → User: many-to-one (nullable)
