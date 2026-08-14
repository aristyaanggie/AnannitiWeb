# Sprint 40.4.3 — Hero CTA Retouch (First Pass)

**Date**: 2026-08-04
**Status**: ✅ Complete
**Type**: UI Retouch Only

## Objective

Improve readability of Hero CTA button "View Our Works" before hover.

## Problem

Button used `bg-white/10 border-white/90` — too transparent on busy hero image. Text barely visible before hover.

## Solution

Increased background opacity and border visibility:
- `bg-white/10` → `bg-white/20` (stronger glass background)
- `border-white/90` → `border-white` (crisp, fully opaque border)

## Changes

| File | Line | Before | After |
|------|------|--------|-------|
| `resources/views/pages/home.blade.php` | 32 | `border-white/90 bg-white/10` | `border-white bg-white/20` |

## Build

```
✓ npm run build — success (2.60s)
✓ CSS: 115.40 kB
✓ JS: 92.32 kB
```

## Section Touched

Hero section ONLY. No other sections modified.
