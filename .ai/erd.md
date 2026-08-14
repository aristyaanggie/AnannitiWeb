# Entity Relationship Diagram

Dokumentasi ERD Ananniti Tattoo Bali — sesuai implementasi.

**Last Updated**: 2026-07-19
**Based on**: v9.0.0 (Sprint 20 — Database Finalization)
**MySQL Compatible**: ✅ YES
**Audit Status**: ✅ PRODUCTION READY

## ERD Overview

Database menggunakan 16 tabel custom (dari 20 migration files) dengan relasi berikut.

## Entities & Relationships

### Core Entities

#### users (16 columns)
- id, name, email (UNIQUE), email_verified_at, password, role, phone, avatar, is_active, last_login_at, created_at, updated_at, deleted_at (soft delete)

**Relationships**:
- hasMany → bookings
- hasOne → artist_profiles (optional, via user_id)

#### sections (11 columns)
- id, slug (UNIQUE), title, subtitle, description, image, background_color, display_order, is_visible, meta (JSON), timestamps

**Relationships**:
- hasMany → section_items

#### section_items (11 columns)
- id, section_id (FK → sections), type, title, description, icon, image, display_order, is_visible, timestamps

**Relationships**:
- belongsTo → sections

#### categories (9 columns)
- id, name, slug (UNIQUE), description, image, type (product|gallery), display_order, is_visible, timestamps

**Relationships**:
- hasMany → products
- hasMany → portfolio_items

#### products (24 columns)
- id, category_id (FK), name, slug (UNIQUE), description, short_description, price, compare_price, sku (UNIQUE), thumbnail, stock_quantity, stock_status, minimum_stock, published_at, badge_id (FK), is_featured, is_visible, meta_title, meta_description, display_order, timestamps, deleted_at (soft delete)

**Relationships**:
- belongsTo → categories
- belongsTo → product_badges (optional)
- hasMany → product_galleries
- hasMany → reviews

#### product_badges (7 columns)
- id, name, slug (UNIQUE), background_color, text_color, created_at

**Relationships**:
- hasMany → products

#### artist_profiles (14 columns)
- id, user_id (FK → users, nullable), name, slug (UNIQUE), photo, biography, specialization, experience_years, instagram, display_order, is_featured, is_visible, timestamps

**Relationships**:
- belongsTo → users (optional)
- hasMany → portfolio_items
- hasMany → bookings
- hasMany → reviews

#### portfolio_items (16 columns)
- id, category_id (FK, nullable), artist_id (FK, nullable), title, slug (UNIQUE), description, image, tattoo_style, placement, session_hours, is_featured, display_order, is_visible, timestamps

**Relationships**:
- belongsTo → categories (optional)
- belongsTo → artist_profiles (optional)

#### bookings (17 columns)
- id, user_id (FK, nullable), artist_id (FK, nullable), service_type, name, email, phone, booking_date, booking_time, design_description, placement, size, status, whatsapp_sent_at, notes, timestamps

**Relationships**:
- belongsTo → users (optional)
- belongsTo → artist_profiles (optional)
- hasMany → booking_services

#### booking_services (6 columns)
- id, booking_id (FK), service_name, price, duration, created_at

**Relationships**:
- belongsTo → bookings

#### reviews (14 columns)
- id, product_id (FK, nullable), artist_id (FK, nullable), name, country, tattoo_style, rating, content, photo, is_featured, display_order, is_visible, timestamps

**Relationships**:
- belongsTo → products (optional)
- belongsTo → artist_profiles (optional)

#### contacts (11 columns)
- id, name, email, phone, subject, message, status, is_read, timestamps

**Relationships**: standalone

#### settings (6 columns)
- id, key (UNIQUE), value, group, type, timestamps

**Relationships**: standalone

#### audit_logs (11 columns)
- id, user_id (FK, nullable), action, model_type, model_id, old_values (JSON), new_values (JSON), ip_address, user_agent, created_at

**Relationships**:
- belongsTo → users (optional)

#### whatsapp_templates (6 columns)
- id, name, type, template, is_active, timestamps

**Relationships**: standalone

## ERD Diagram (ASCII)

```
users ─────────────┬───────────────────────────┐
  │                │                           │
  │ 1:N            │ 1:1 (optional)            │ 1:N (optional)
  │                │                           │
  ▼                ▼                           ▼
bookings      artist_profiles ─────────── portfolio_items
  │ 1:N         │ 1:N    │ 1:N              │ N:1 (optional)
  │             │        │                   │
  ▼             │        │                   ▼
booking_services│        │               categories
                │        │               │ 1:N
                ▼        ▼               │
            reviews      │               ▼
            │ N:1 (opt)  │           products
            ▼            │           │ 1:N    │ N:1 (optional)
          products       │           │        ▼
                         │           ▼    product_badges
                         │    product_galleries

sections ────────────────┐
  │ 1:N                  │
  ▼                      │
section_items            │
                         │
contacts (standalone)    │
settings (standalone)    │
audit_logs → users (opt) │
whatsapp_templates (standalone)
```

## Foreign Keys (Complete)

| FK | From | To | On Delete | On Update |
|----|------|----|-----------|-----------|
| section_items.section_id | section_items | sections | CASCADE | CASCADE |
| products.category_id | products | categories | RESTRICT | CASCADE |
| products.badge_id | products | product_badges | SET NULL | CASCADE |
| product_galleries.product_id | product_galleries | products | CASCADE | CASCADE |
| artist_profiles.user_id | artist_profiles | users | SET NULL | CASCADE |
| portfolio_items.category_id | portfolio_items | categories | SET NULL | CASCADE |
| portfolio_items.artist_id | portfolio_items | artist_profiles | SET NULL | CASCADE |
| bookings.user_id | bookings | users | SET NULL | CASCADE |
| bookings.artist_id | bookings | artist_profiles | SET NULL | CASCADE |
| booking_services.booking_id | booking_services | bookings | CASCADE | CASCADE |
| reviews.product_id | reviews | products | SET NULL | CASCADE |
| reviews.artist_id | reviews | artist_profiles | SET NULL | CASCADE |
| audit_logs.user_id | audit_logs | users | SET NULL | CASCADE |

## Normalization

Database dinormalisasi hingga 3NF (Third Normal Form):
- 1NF: Atomic columns, no repeating groups
- 2NF: All non-key columns depend on full primary key
- 3NF: No transitive dependencies

Denormalization applied:
- bookings menyimpan name, email, phone langsung (guest booking)
- reviews menyimpan name, country langsung (non-registered clients)
- products memiliki thumbnail terpisah dari product_galleries (performance)

## Cardinality Matrix

| Entity A | Relationship | Entity B | Cardinality | FK Column | Nullable |
|----------|-------------|----------|-------------|-----------|----------|
| users | hasMany | bookings | 1:N | bookings.user_id | YES |
| users | hasOne | artist_profiles | 1:1 | artist_profiles.user_id | YES |
| users | hasMany | audit_logs | 1:N | audit_logs.user_id | YES |
| sections | hasMany | section_items | 1:N | section_items.section_id | NO |
| categories | hasMany | products | 1:N | products.category_id | NO |
| categories | hasMany | portfolio_items | 1:N | portfolio_items.category_id | YES |
| product_badges | hasMany | products | 1:N | products.badge_id | YES |
| products | hasMany | product_galleries | 1:N | product_galleries.product_id | NO |
| products | hasMany | reviews | 1:N | reviews.product_id | YES |
| artist_profiles | hasMany | portfolio_items | 1:N | portfolio_items.artist_id | YES |
| artist_profiles | hasMany | bookings | 1:N | bookings.artist_id | YES |
| artist_profiles | hasMany | reviews | 1:N | reviews.artist_id | YES |
| bookings | hasMany | booking_services | 1:N | booking_services.booking_id | NO |

## Audit Findings (Sprint 20)

| Check | Status | Notes |
|-------|--------|-------|
| Foreign Keys | ✅ | 13 FK constraints, all correctly defined |
| Cascade Rules | ✅ | RESTRICT on categories (prevents orphan products), CASCADE on children, SET NULL on optional parents |
| Nullable | ✅ | Optional FKs are nullable, required FKs are NOT NULL |
| Unique | ✅ | email, slugs, sku, settings.key all UNIQUE |
| Indexes | ✅ | 23+ performance indexes, 5 composite indexes |
| Soft Delete | ✅ | users, products use softDeletes |
| Timestamps | ✅ | All main tables have timestamps; junction tables (booking_services, product_galleries, audit_logs) use only created_at |
| MySQL Compatible | ✅ | All column types, enums, JSON, foreign keys work with MySQL 5.7+ |
| Normalization | ✅ | 3NF with intentional denormalization for performance |
| Redundant Relations | ✅ | None found |

## Indexes

### Primary Indexes
- Semua tabel: id — PRIMARY KEY, AUTO_INCREMENT

### Unique Indexes
- users.email, products.slug, products.sku, categories.slug, artist_profiles.slug, settings.key, portfolio_items.slug

### Performance Indexes (23+)
| Table | Column(s) | Type |
|-------|-----------|------|
| products | category_id, badge_id, is_visible, is_featured, display_order, published_at, stock_quantity | INDEX |
| portfolio_items | category_id, artist_id, is_featured, display_order | INDEX |
| bookings | user_id, artist_id, status, booking_date | INDEX |
| reviews | product_id, artist_id, is_featured, rating | INDEX |
| section_items | section_id | INDEX |
| audit_logs | user_id, [model_type, model_id] | INDEX/COMPOSITE |
| contacts | status | INDEX |

### Composite Indexes (5)
| Table | Columns | Reason |
|-------|---------|--------|
| products | [category_id, is_visible, display_order] | Category listing |
| products | [is_featured, is_visible, display_order] | Featured products |
| portfolio_items | [category_id, is_visible, display_order] | Gallery listing |
| bookings | [status, booking_date] | Calendar query |
| reviews | [is_visible, is_featured, display_order] | Display query |

## Notes

- Semua relationships diimplementasikan di Eloquent models
- Gunakan migrations untuk schema management
- ERD visual dapat dibuat menggunakan dbdiagram.io atau Lucidchart
