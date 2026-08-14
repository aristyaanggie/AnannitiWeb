# Sprint 35.2 — Single Artist Runtime Cleanup

**Date**: 2026-07-23
**Status**: ✅ COMPLETE

## Objective
Convert dari multi-artist ke single-artist tanpa reset database.

## Files Diubah (5)
1. `AdminPortfolioController.php` — Hapus dropdown, auto-assign ArtistProfile::first()
2. `admin/portfolio/form.blade.php` — Hidden input artist_id
3. `AdminReviewController.php` — Hapus dropdown, auto-assign ArtistProfile::first()
4. `admin/reviews/form.blade.php` — Hidden input artist_id
5. `admin/reviews/index.blade.php` — Hapus artist filter

## Seeder Diupdate (2)
1. `ArtistProfileSeeder.php` — 3 artist → 1 artist Gus Tut
2. `PortfolioItemSeeder.php` — Semua artist_slug → gus-tut

## Data Migration Dibuat (1)
- `2026_07_23_000002_reassign_artists_to_single_artist.php`
- Reassign portfolio_items + reviews ke artist pertama
- Hapus artist lain

## Result
- Sebelum: 3 artists, 2 artist_ids di portfolio
- Sesudah: 1 artist, 1 artist_id di portfolio
- Build: 0 errors, 0 warnings
