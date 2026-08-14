# Database Schema

Dokumentasi database schema Ananniti Tattoo Bali — sesuai implementasi migrations.

**Last Updated**: 2026-07-24
**Based on**: v12.0.0 — 21 migration files, 17 custom tables

## Overview

Database menggunakan SQLite (development) dan mendukung MySQL/PostgreSQL (production). Semua schema menggunakan Laravel Migrations. Untuk detail lengkap, lihat `database-review.md`.

## Tables

### users

```
Column            | Type                       | Constraint                 | Notes
------------------|----------------------------|----------------------------|------------------
id                | bigint                     | PK, auto-increment         |
name              | string(255)                | NOT NULL                   |
email             | string(255)                | UNIQUE, NOT NULL           |
email_verified_at | timestamp                  | NULLABLE                   |
password          | string(255)                | NOT NULL                   | bcrypt
role              | enum(admin,staff,customer) | NOT NULL, DEFAULT customer |
phone             | string(20)                 | NULLABLE                   |
avatar            | string(255)                | NULLABLE                   |
is_active         | boolean                    | DEFAULT true               |
last_login_at     | timestamp                  | NULLABLE                   |
created_at        | timestamp                  | NOT NULL                   |
updated_at        | timestamp                  | NOT NULL                   |
deleted_at        | timestamp                  | NULLABLE                   | soft delete
```

### sections

```
Column           | Type        | Constraint          | Notes
-----------------|-------------|---------------------|------
id               | bigint      | PK, auto-increment  |
slug             | string(100) | UNIQUE, NOT NULL    | hero, about, services, gallery, artists, trust, consultation, footer
title            | string(255) | NOT NULL            |
subtitle         | string(255) | NULLABLE            |
description      | text        | NULLABLE            |
image            | string(255) | NULLABLE            |
background_color | string(20)  | NULLABLE            |
display_order    | integer     | DEFAULT 0           |
is_visible       | boolean     | DEFAULT true        |
meta             | json        | NULLABLE            |
created_at       | timestamp   | NOT NULL            |
updated_at       | timestamp   | NOT NULL            |
```

### section_items

```
Column        | Type        | Constraint           | Notes
--------------|-------------|----------------------|------
id            | bigint      | PK, auto-increment   |
section_id    | bigint      | FK → sections.id     | CASCADE on delete/update
type          | string(50)  | NOT NULL             | trust_point, service, highlight
title         | string(255) | NULLABLE             |
description   | text        | NULLABLE             |
icon          | string(100) | NULLABLE             | Lucide icon name
image         | string(255) | NULLABLE             |
display_order | integer     | DEFAULT 0            |
is_visible    | boolean     | DEFAULT true         |
created_at    | timestamp   | NOT NULL             |
updated_at    | timestamp   | NOT NULL             |
```

### categories

```
Column        | Type        | Constraint       | Notes
--------------|-------------|------------------|------
id            | bigint      | PK, auto-increment |
name          | string(100) | NOT NULL         |
slug          | string(100) | UNIQUE, NOT NULL |
description   | text        | NULLABLE         |
image         | string(255) | NULLABLE         |
type          | enum(product, gallery) | NOT NULL |
display_order | integer     | DEFAULT 0        |
is_visible    | boolean     | DEFAULT true     |
created_at    | timestamp   | NOT NULL         |
updated_at    | timestamp   | NOT NULL         |
```

### product_badges

```
Column           | Type        | Constraint     | Notes
-----------------|-------------|----------------|------
id               | bigint      | PK, auto-increment |
name             | string(100) | NOT NULL       | Best Seller, New, Limited, Staff Pick, Artist Pick
slug             | string(100) | UNIQUE, NOT NULL |
background_color | string(20)  | DEFAULT bg-black |
text_color       | string(20)  | DEFAULT text-white |
created_at       | timestamp   | NOT NULL       |
```

### products

```
Column            | Type                                    | Constraint           | Notes
------------------|-----------------------------------------|----------------------|------
id                | bigint                                  | PK, auto-increment   |
category_id       | bigint                                  | FK → categories.id   | RESTRICT on delete, CASCADE on update
name              | string(255)                             | NOT NULL             |
slug              | string(255)                             | UNIQUE, NOT NULL     |
description       | text                                    | NULLABLE             |
short_description | string(500)                             | NULLABLE             |
price             | decimal(12,2)                           | DEFAULT 0            |
compare_price     | decimal(12,2)                           | NULLABLE             | sale display
sku               | string(100)                             | UNIQUE, NULLABLE     |
thumbnail         | string(255)                             | NULLABLE             | primary display image
stock_quantity    | integer                                 | DEFAULT 0            |
stock_status      | enum(in_stock, out_of_stock, pre_order) | DEFAULT in_stock     |
minimum_stock     | integer                                 | DEFAULT 5            | alert threshold
published_at      | timestamp                               | NULLABLE             | scheduled publishing
badge_id          | bigint                                  | FK → product_badges.id | SET NULL on delete
is_featured       | boolean                                 | DEFAULT false        |
is_visible        | boolean                                 | DEFAULT true         |
meta_title        | string(255)                             | NULLABLE             | SEO
meta_description  | text                                    | NULLABLE             | SEO
display_order     | integer                                 | DEFAULT 0            |
created_at        | timestamp                               | NOT NULL             |
updated_at        | timestamp                               | NOT NULL             |
deleted_at        | timestamp                               | NULLABLE             | soft delete

Indexes: category_id, badge_id, is_visible, is_featured, display_order, published_at, stock_quantity
Composite: [category_id, is_visible, display_order], [is_featured, is_visible, display_order]
```

### product_galleries

```
Column        | Type        | Constraint           | Notes
--------------|-------------|----------------------|------
id            | bigint      | PK, auto-increment   |
product_id    | bigint      | FK → products.id     | CASCADE on delete/update
image         | string(255) | NOT NULL             |
alt_text      | string(255) | NULLABLE             |
display_order | integer     | DEFAULT 0            |
is_primary    | boolean     | DEFAULT false        |
created_at    | timestamp   | NOT NULL             |
```

### artist_profiles

```
Column           | Type        | Constraint        | Notes
-----------------|-------------|-------------------|------
id               | bigint      | PK, auto-increment |
user_id          | bigint      | FK → users.id     | NULLABLE, SET NULL on delete
name             | string(255) | NOT NULL          |
slug             | string(255) | UNIQUE, NOT NULL  |
photo            | string(255) | NOT NULL          |
biography        | text        | NULLABLE          |
specialization   | string(255) | NULLABLE          | Blackwork, Realism, etc.
experience_years | integer     | NULLABLE          |
instagram        | string(255) | NULLABLE          |
display_order    | integer     | DEFAULT 0         |
is_featured      | boolean     | DEFAULT false     |
is_visible       | boolean     | DEFAULT true      |
created_at       | timestamp   | NOT NULL          |
updated_at       | timestamp   | NOT NULL          |
```

### portfolio_items

```
Column        | Type        | Constraint           | Notes
--------------|-------------|----------------------|------
id            | bigint      | PK, auto-increment   |
category_id   | bigint      | FK → categories.id   | NULLABLE, SET NULL on delete
artist_id     | bigint      | FK → artist_profiles.id | NULLABLE, SET NULL on delete
title         | string(255) | NOT NULL             |
slug          | string(255) | UNIQUE, NOT NULL     | added via migration
description   | text        | NULLABLE             |
image         | string(255) | NOT NULL             |
tattoo_style  | string(100) | NULLABLE             |
placement     | string(100) | NULLABLE             |
session_hours | integer     | NULLABLE             |
is_featured   | boolean     | DEFAULT false        |
display_order | integer     | DEFAULT 0            |
is_visible    | boolean     | DEFAULT true         |
created_at    | timestamp   | NOT NULL             |
updated_at    | timestamp   | NOT NULL             |

Indexes: category_id, artist_id, is_featured, display_order
Composite: [category_id, is_visible, display_order]
```

### bookings

```
Column             | Type                                           | Constraint                | Notes
-------------------|------------------------------------------------|---------------------------|------
id                 | bigint                                          | PK, auto-increment        |
user_id            | bigint                                          | FK → users.id             | NULLABLE, SET NULL on delete
artist_id          | bigint                                          | FK → artist_profiles.id   | NULLABLE, SET NULL on delete
service_type       | enum(studio, home_service, consultation)        | NOT NULL                  |
name               | string(255)                                     | NOT NULL                  | guest name
email              | string(255)                                     | NULLABLE                  |
phone              | string(20)                                      | NOT NULL                  |
booking_date       | date                                            | NOT NULL                  |
booking_time       | time                                            | NULLABLE                  |
design_description | text                                            | NULLABLE                  |
placement          | string(100)                                     | NULLABLE                  |
size               | string(100)                                     | NULLABLE                  |
status             | enum(pending, confirmed, completed, cancelled)   | DEFAULT pending           |
whatsapp_sent_at   | timestamp                                       | NULLABLE                  | WA notification tracking
notes              | text                                            | NULLABLE                  | admin notes
created_at         | timestamp                                       | NOT NULL                  |
updated_at         | timestamp                                       | NOT NULL                  |

Indexes: user_id, artist_id, status, booking_date
Composite: [status, booking_date]
```

### booking_services

```
Column       | Type          | Constraint           | Notes
-------------|---------------|----------------------|------
id           | bigint        | PK, auto-increment   |
booking_id   | bigint        | FK → bookings.id     | CASCADE on delete/update
service_name | string(255)   | NOT NULL             |
price        | decimal(12,2) | NULLABLE             |
duration     | integer       | NULLABLE             | in minutes
created_at   | timestamp     | NOT NULL             |
```

### reviews

```
Column        | Type        | Constraint           | Notes
--------------|-------------|----------------------|------
id            | bigint      | PK, auto-increment   |
product_id    | bigint      | FK → products.id     | NULLABLE, SET NULL on delete
artist_id     | bigint      | FK → artist_profiles.id | NULLABLE, SET NULL on delete
name          | string(255) | NOT NULL             | client name
country       | string(100) | NULLABLE             |
tattoo_style  | string(100) | NULLABLE             |
rating        | integer     | NOT NULL             | CHECK 1-5
content       | text        | NOT NULL             |
photo         | string(255) | NULLABLE             | client photo
is_featured   | boolean     | DEFAULT false        |
display_order | integer     | DEFAULT 0            |
is_visible    | boolean     | DEFAULT true         |
created_at    | timestamp   | NOT NULL             |
updated_at    | timestamp   | NOT NULL             |

Indexes: product_id, artist_id, is_featured, rating
Composite: [is_visible, is_featured, display_order]
```

### contacts

```
Column     | Type        | Constraint     | Notes
-----------|-------------|----------------|------
id         | bigint      | PK, auto-increment |
name       | string(255) | NOT NULL       |
email      | string(255) | NOT NULL       |
phone      | string(20)  | NULLABLE       |
subject    | string(255) | NULLABLE       |
message    | text        | NOT NULL       |
status     | string(20)  | DEFAULT unread | unread, read, replied (added via migration)
is_read    | boolean     | DEFAULT false  |
created_at | timestamp   | NOT NULL       |
updated_at | timestamp   | NOT NULL       |

Indexes: status
```

### settings

```
Column     | Type        | Constraint       | Notes
-----------|-------------|------------------|------
id         | bigint      | PK, auto-increment |
key        | string(100) | UNIQUE, NOT NULL | brand_name, wa_number, etc.
value      | text        | NULLABLE         |
group      | string(50)  | NOT NULL         | brand, social, seo, business
type       | string(20)  | DEFAULT text     | text, image, textarea, json
created_at | timestamp   | NOT NULL         |
updated_at | timestamp   | NOT NULL         |
```

### audit_logs

```
Column     | Type        | Constraint     | Notes
-----------|-------------|----------------|------
id         | bigint      | PK, auto-increment |
user_id    | bigint      | FK → users.id  | NULLABLE, SET NULL on delete
action     | string(100) | NOT NULL       | created, updated, deleted
model_type | string(100) | NOT NULL       |
model_id   | bigint      | NULLABLE       |
old_values | json        | NULLABLE       |
new_values | json        | NULLABLE       |
ip_address | string(45)  | NULLABLE       |
user_agent | text        | NULLABLE       |
created_at | timestamp   | NOT NULL       |

Indexes: user_id, [model_type, model_id]
```

### whatsapp_templates

```
Column     | Type                                            | Constraint     | Notes
-----------|------------------------------------------------|----------------|------
id         | bigint                                          | PK, auto-increment |
name       | string(100)                                     | NOT NULL       | Studio Booking, Home Service, Consultation, Shop Product
type       | enum(booking, home_service, consultation, shop)  | NOT NULL       |
template   | text                                            | NOT NULL       | Message template with placeholders
is_active  | boolean                                         | DEFAULT true   |
created_at | timestamp                                       | NOT NULL       |
updated_at | timestamp                                       | NOT NULL       |
```

### tattoo_supplies

```
Column        | Type        | Constraint           | Notes
--------------|-------------|----------------------|------
id            | bigint      | PK, auto-increment   |
title         | varchar(255)| NOT NULL             | Card title
subtitle      | varchar(255)| NULLABLE             | Card subtitle
image         | varchar(255)| NOT NULL             | Image path in storage
link          | varchar(500)| NULLABLE             | URL to link to
display_order | unsigned int| DEFAULT 0            | Sort order
is_visible    | boolean     | DEFAULT true         | Show/hide toggle
created_at    | timestamp   | NOT NULL             |
updated_at    | timestamp   | NOT NULL             |
```

## Migration Files

| # | File | Table | Action |
|---|------|-------|--------|
| 1 | 0001_01_01_000000_create_users_table.php | users, password_reset_tokens, sessions | CREATE |
| 2 | 0001_01_01_000001_create_cache_table.php | cache, cache_locks | CREATE |
| 3 | 0001_01_01_000002_create_jobs_table.php | jobs, job_batches, failed_jobs | CREATE |
| 4 | 2026_07_16_000001_create_sections_table.php | sections | CREATE |
| 5 | 2026_07_16_000002_create_section_items_table.php | section_items | CREATE |
| 6 | 2026_07_16_000003_create_categories_table.php | categories | CREATE |
| 7 | 2026_07_16_000004_create_product_badges_table.php | product_badges | CREATE |
| 8 | 2026_07_16_000005_create_products_table.php | products | CREATE |
| 9 | 2026_07_16_000006_create_product_galleries_table.php | product_galleries | CREATE |
| 10 | 2026_07_16_000007_create_artist_profiles_table.php | artist_profiles | CREATE |
| 11 | 2026_07_16_000008_create_portfolio_items_table.php | portfolio_items | CREATE |
| 12 | 2026_07_16_000009_create_bookings_table.php | bookings | CREATE |
| 13 | 2026_07_16_000010_create_booking_services_table.php | booking_services | CREATE |
| 14 | 2026_07_16_000011_create_reviews_table.php | reviews | CREATE |
| 15 | 2026_07_16_000012_create_contacts_table.php | contacts | CREATE |
| 16 | 2026_07_16_000013_create_settings_table.php | settings | CREATE |
| 17 | 2026_07_16_000014_create_audit_logs_table.php | audit_logs | CREATE |
| 18 | 2026_07_16_000015_create_whatsapp_templates_table.php | whatsapp_templates | CREATE |
| 19 | 2026_07_17_043338_add_status_to_contacts_table.php | contacts | ADD COLUMN status |
| 20 | 2026_07_17_101524_add_slug_to_portfolio_items_table.php | portfolio_items | ADD COLUMN slug |
| 21 | 2026_07_25_000001_create_tattoo_supplies_table.php | tattoo_supplies | CREATE |

## Migrations Command

```bash
php artisan migrate                    # Run pending migrations
php artisan migrate:rollback          # Rollback last batch
php artisan migrate:fresh --seed      # Reset + seed (development)
```

## Seeders

```bash
php artisan db:seed                    # Run all seeders
php artisan db:seed --class=UserSeeder # Run specific seeder
```

Seeder list: UserSeeder, ArtistProfileSeeder, CategorySeeder, ProductBadgeSeeder, SectionSeeder, SettingSeeder, WhatsappTemplateSeeder
