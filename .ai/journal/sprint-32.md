# Sprint 32 — Performance & Query Optimization

**Date**: 2026-07-23
**Status**: ✅ COMPLETE

## Objective
Audit performa backend dan optimalkan query tanpa mengubah fitur.

## Tasks Completed

### 1. Footer Query Optimization
- **File**: `resources/views/components/layout/footer.blade.php`
- **Sebelum**: 7 individual `Setting::where()` queries per page load
- **Sesudah**: 1 `Setting::whereIn()` query + `pluck('value', 'key')`
- **Queries dihemat**: 6 per halaman

### 2. GalleryController Eager Loading
- **File**: `app/Http/Controllers/GalleryController.php`
- **Perubahan**: Tambah `with(['category'])` pada artist page portfolio query
- **Alasan**: Mencegah N+1 query saat view mengakses `$item->category->name`

## Build Result
```
✓ Build successful (2.46s)
✓ CSS: 110.89 kB
✓ JS: 92.32 kB
✓ Routes: 55
✓ Errors: 0
✓ Warnings: 0
```
