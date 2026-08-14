# Sprint 14.13 — Landing Page CMS Foundation

**Date**: 2026-07-16
**Status**: ✅ COMPLETE

## Objective

Membangun Content Management System (CMS) untuk Landing Page sehingga konten dapat dikelola oleh owner melalui Admin Panel.

## Files Created/Modified

| File | Action |
|------|--------|
| `app/Services/SectionService.php` | Created |
| `app/Http/Requests/UpdateSectionRequest.php` | Created |
| `app/Http/Controllers/Admin/AdminSectionController.php` | Created |
| `resources/views/admin/content/index.blade.php` | Created |
| `resources/views/admin/content/form.blade.php` | Created |
| `resources/views/layouts/admin.blade.php` | Updated (sidebar) |
| `routes/web.php` | Updated (3 new routes) |

## Routes

| Method | URI | Name |
|--------|-----|------|
| GET | `/admin/content` | `admin.content.index` |
| GET | `/admin/content/{section}/edit` | `admin.content.edit` |
| PUT | `/admin/content/{section}` | `admin.content.update` |

## Features

### Content List
- Editorial table with all 9 sections
- Section image/icon display
- Last updated timestamp
- Visibility status (Visible/Hidden)
- Edit button per section

### Edit Section
- Dynamic title based on section
- Section info card (slug, title)
- Title, Subtitle, Description fields
- Image upload with preview
- Visibility toggle (Visible/Hidden)
- Flash messages
- Validation errors

### Image Upload
- Drag & drop + click to browse
- Live preview
- Replace old image on upload
- Storage cleanup

### Sidebar
- Content Management link added
- Active state support
- Replaced old Landing Page link

## Validation

```
✓ php artisan route:list — 23 routes registered
✓ php artisan optimize — Cached successfully
✓ Build successful (3.81s)
✓ CSS: 106.70 kB
✓ JS: 92.32 kB
✓ Errors: 0
✓ Warnings: 0
```
