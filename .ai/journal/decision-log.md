# Decision Log

Dokumentasi keputusan penting yang dibuat selama pengembangan Ananniti Tattoo Bali.

## Sprint 40 Decision

### Decision 40-1: Workflow Change — Desktop UI Final First
**Date**: 2026-08-05
**Decision**: Responsive Implementation (Sprint 40.5.x) di-STOP sementara / ARCHIVED / ON HOLD. Mulai fase PHASE 1 — Desktop UI Final dengan urutan wajib: Hero → About → Services → Tattoo Supply → Portfolio → Artist → Consultation → Footer. Setelah Landing Page 100%, lanjut Phase 2 Shop, Phase 3 Gallery, Phase 4 Admin, baru Phase 5 Responsive Optimization.
**Rationale**: 
- Responsive dikerjakan setelah seluruh UI desktop final agar tidak terjadi perubahan berulang dan layout conflict
- Setiap sprint hanya satu section desktop
- Tidak mengubah section lain, DB, route, controller, model, migration, logic, CMS yang sudah aman
**Status**: Active
**Impact**: Sprint 40.5.x diarsipkan (code KEPT, tidak di-rollback). Semua code responsive 40.5.1.x tetap aman dan dipertahankan.

## Sprint 00 Decisions

### Decision 1: Documentation First Approach
**Date**: 2026-07-10
**Decision**: Prioritas utama adalah membuat dokumentasi lengkap sebelum any coding
**Rationale**: 
- Memastikan semua stakeholder aligned pada direction
- Mengurangi miscommunication di phase berikutnya
- Documentation serves as single source of truth
- AI dapat reference documentation untuk consistency
**Impact**: Added ~1 hour to setup, saves significant time in development
**Owner**: Project Lead

### Decision 2: Placeholder Strategy
**Date**: 2026-07-10
**Decision**: Gunakan [TO BE DEFINED] untuk semua items yang belum finalized
**Rationale**:
- Documentation complete namun flexible
- Tidak memaksa decisions yang belum siap
- Mudah untuk update di kemudian hari
- Clear indication tentang apa yang masih perlu di-decide
**Impact**: Documentation lebih maintainable
**Owner**: Documentation Lead

### Decision 3: Laravel + Blade + Tailwind
**Date**: [When project initiated]
**Decision**: Gunakan Laravel 12, Blade templates, dan Tailwind CSS 4.0
**Rationale**:
- Laravel is mature dan production-ready
- Blade is powerful templating engine
- Tailwind provides utility-first CSS
- Good ecosystem dan community support
**Impact**: Clean, maintainable tech stack
**Owner**: Tech Lead

### Decision 4: API Versioning Strategy
**Date**: 2026-07-10
**Decision**: Plan untuk API v1 dari the start
**Rationale**:
- Future-proof jika mobile app needed
- Allows untuk backward compatibility
- Standard practice untuk production APIs
**Impact**: API endpoints planned dengan versioning in mind
**Owner**: Architecture Lead

### Decision 5: Folder Structure
**Date**: 2026-07-10
**Decision**: Follow Laravel conventions dengan additional structure untuk components
**Rationale**:
- Team familiar dengan Laravel conventions
- Clear separation of concerns
- Scalable untuk growing project
- Easy onboarding untuk new developers
**Impact**: Organized codebase dari day one
**Owner**: Architecture Lead

### Decision 6: Component-Based UI
**Date**: 2026-07-10
**Decision**: Build UI dengan Blade components untuk reusability
**Rationale**:
- Reduces code duplication
- Improves consistency
- Easier to maintain
- Better testing
**Impact**: More maintainable UI codebase
**Owner**: Frontend Lead

## Pending Decisions

### 1. Database System
**Question**: SQLite (dev) vs MySQL/PostgreSQL (prod)?
**Status**: Pending specification
**Impacts**: Schema design, migration strategy, performance optimization

### 2. Authentication Method
**Question**: Laravel Sanctum vs Breeze vs Custom JWT?
**Status**: Pending decision
**Impacts**: API auth, user sessions, security implementation

### 3. Payment Gateway
**Question**: Stripe vs Midtrans vs alternative?
**Status**: Pending decision
**Impacts**: Shop functionality, order processing, security

### 4. Email Service
**Question**: SMTP service provider?
**Status**: Pending decision
**Impacts**: Notification system, booking confirmations

### 5. Image Storage
**Question**: Local storage vs S3/Cloud storage?
**Status**: Pending decision
**Impacts**: Portfolio images, merchandise images, performance

### 6. CDN Strategy
**Question**: Use CDN untuk static assets?
**Status**: Pending decision
**Impacts**: Performance, cost, caching strategy

### 7. Analytics Tool
**Question**: Google Analytics vs alternative?
**Status**: Pending decision
**Impacts**: Tracking, reporting, user insights

### 8. Error Tracking
**Question**: Sentry vs alternative?
**Status**: Pending decision
**Impacts**: Debugging, production monitoring, alerts

## Decision Template

Untuk future decisions, gunakan format ini:

```
### Decision N: [Title]
**Date**: YYYY-MM-DD
**Decision**: [What was decided]
**Rationale**: 
- [Reason 1]
- [Reason 2]
- [Reason 3]
**Impacts**: [What changes because of this]
**Alternatives Considered**: [Other options looked at]
**Trade-offs**: [Pros and cons]
**Owner**: [Who made the decision]
**Status**: [Completed/Pending/Under Review]
```

## Decision Process

1. Identify the decision needed
2. Research alternatives
3. Document pros dan cons
4. Get stakeholder input
5. Make dan document decision
6. Communicate ke team
7. Update documentation

## Review Schedule

- Weekly: Review pending decisions
- Monthly: Review decision log untuk trends
- Quarterly: Major decisions review

---

**Last Updated**: 2026-08-05
**Total Decisions**: 7 completed, 8 pending
