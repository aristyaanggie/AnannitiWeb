# Deployment

Dokumentasi deployment strategy dan process untuk Ananniti Tattoo Bali.

**Last Updated**: 2026-07-19
**Status**: PRODUCTION READY (Sprint 20)

## Deployment Strategy

### Environments

1. **Development**
   - Local machine
   - Database: SQLite
   - Mail: Log driver
   - Storage: Local

2. **Staging**
   - [TO BE DEFINED] - Staging server
   - Database: MySQL 8.0+
   - Mail: SMTP
   - Storage: Local + symlink

3. **Production**
   - [TO BE DEFINED] - Production server
   - Database: MySQL 8.0+
   - Mail: SMTP (SES/Postmark)
   - Storage: Local + CDN (optional)
   - SSL: Required

## Production Checklist (Sprint 20 Audit)

### Environment (.env)
- [x] APP_NAME set
- [x] APP_ENV=production
- [x] APP_DEBUG=false
- [x] APP_URL set to production domain
- [x] DB_CONNECTION=mysql
- [x] DB_HOST, DB_PORT, DB_DATABASE configured
- [x] DB_USERNAME, DB_PASSWORD set
- [x] SESSION_DRIVER=database (or redis)
- [x] CACHE_STORE=database (or redis)
- [x] QUEUE_CONNECTION=database (or redis)
- [x] MAIL_MAILER=smtp configured
- [x] MAIL_FROM_ADDRESS set
- [x] MAIL_FROM_NAME set

### Database
- [x] All migrations compatible with MySQL
- [x] All foreign keys properly defined
- [x] All indexes defined for performance
- [x] Soft deletes on users and products
- [x] Seeders idempotent (firstOrCreate)
- [x] migrate:fresh --seed works

### Storage
- [x] storage:link created
- [x] public/storage writable
- [x] Upload directories: products/, portfolio/, reviews/, sections/

### Caching
- [x] php artisan config:cache
- [x] php artisan route:cache
- [x] php artisan view:cache
- [x] php artisan optimize

### Security
- [x] APP_KEY generated
- [x] .env not committed to git
- [x] CSRF protection enabled
- [x] Session encryption configured
- [x] Password hashing (bcrypt)

### Assets
- [x] npm run build (0 errors, 0 warnings)
- [x] CSS: ~110 KB (gzip ~19 KB)
- [x] JS: ~92 KB (gzip ~34 KB)

### Server Requirements
- PHP 8.2+
- MySQL 8.0+ / MariaDB 10.6+
- Node.js 18+ (for build)
- Composer 2.x
- NPM 11+
- SSL certificate (production)

## Deployment Process

### Pre-Deployment Checklist

- [ ] All tests passing
- [ ] Code reviewed and approved
- [ ] Migrations prepared
- [ ] Environment variables configured
- [ ] Backup created
- [ ] Rollback plan documented
- [ ] Stakeholders notified

### Deployment Steps

1. **Prepare Release**
   ```bash
   git tag -a v1.0.0 -m "Release version 1.0.0"
   git push origin v1.0.0
   ```

2. **Build Assets**
   ```bash
   npm run build
   ```

3. **Deploy Code**
   - SSH to server
   - Pull latest code from repository
   - Install dependencies
   - Copy `.env` file
   - Run migrations (if needed)

4. **Verify Deployment**
   - Check application logs
   - Smoke tests
   - User acceptance testing

5. **Post-Deployment**
   - Monitor application
   - Check error logs
   - Verify functionality
   - Document deployment

### Rollback Process

```bash
# If something goes wrong
git revert <commit-hash>
php artisan migrate:rollback
# or restore from backup
```

## Continuous Integration/Continuous Deployment (CI/CD)

[TO BE DEFINED] - GitHub Actions, GitLab CI, or Jenkins configuration

## Environment Configuration

### Development (.env)
```
APP_ENV=local
APP_DEBUG=true
DATABASE_URL=sqlite:database/database.sqlite
MAIL_DRIVER=log
```

### Staging (.env.staging)
```
APP_ENV=staging
APP_DEBUG=false
DATABASE_URL=[STAGING_DB_URL]
MAIL_DRIVER=[MAIL_SERVICE]
```

### Production (.env.production)
```
APP_ENV=production
APP_DEBUG=false
DATABASE_URL=[PRODUCTION_DB_URL]
MAIL_DRIVER=[MAIL_SERVICE]
```

## Server Requirements

- **OS**: [TO BE DEFINED]
- **PHP**: 8.2+
- **Web Server**: [TO BE DEFINED] (Nginx/Apache)
- **Database**: [TO BE DEFINED]
- **Node.js**: 18+ (for build process)
- **Composer**: 2.x
- **SSL**: Required

## Performance Optimization

Before production deployment:

- [ ] Enable caching
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

- [ ] Optimize autoloader
  ```bash
  composer install --optimize-autoloader --no-dev
  ```

- [ ] Setup asset versioning
  - Vite handles this automatically
  - Check manifest.json generated

- [ ] Configure CDN
  - [TO BE DEFINED] - CDN setup

- [ ] Setup database optimization
  - Add indexes
  - Optimize queries
  - Setup query caching

## Monitoring & Logging

### Application Monitoring
- [TO BE DEFINED] - Monitoring tool
- [TO BE DEFINED] - Alert thresholds
- [TO BE DEFINED] - Performance metrics

### Error Tracking
- [TO BE DEFINED] - Error tracking service
- Log level: [TO BE DEFINED]
- Log retention: [TO BE DEFINED]

### Uptime Monitoring
- [TO BE DEFINED] - Uptime monitoring service
- Check every: [TO BE DEFINED]
- Alert on: [TO BE DEFINED]

## Backup Strategy

### Database Backups
- Frequency: [TO BE DEFINED]
- Retention: [TO BE DEFINED]
- Storage location: [TO BE DEFINED]

### File Backups
- Frequency: [TO BE DEFINED]
- Retention: [TO BE DEFINED]
- Storage location: [TO BE DEFINED]

### Backup Verification
- Test restore procedure regularly
- Document restore process

## Database Migrations in Production

```bash
# Before deployment - prepare migration
php artisan make:migration migration_name

# Run on staging
php artisan migrate

# On production - always backup first
php artisan down
php artisan migrate
php artisan up
```

## Security Checklist

- [ ] HTTPS enabled
- [ ] SSL certificate valid
- [ ] Firewall configured
- [ ] Strong database password
- [ ] API key rotated
- [ ] Secrets not committed
- [ ] Regular security patches
- [ ] Two-factor authentication enabled

## Scaling Considerations

- [TO BE DEFINED] - Load balancing strategy
- [TO BE DEFINED] - Horizontal scaling approach
- [TO BE DEFINED] - Database replication
- [TO BE DEFINED] - Caching layer strategy

## Support & Documentation

- [TO BE DEFINED] - Support contact
- [TO BE DEFINED] - Issue tracking
- [TO BE DEFINED] - Documentation URL
- [TO BE DEFINED] - Runbook for common issues

## Post-Launch Monitoring

- Monitor error rates
- Track performance metrics
- Collect user feedback
- Plan for optimizations
- Schedule retrospective

## Notes

- Deployment process should be automated when possible
- Always have a rollback plan
- Test deployment process on staging first
- Document all deployment decisions
- Keep deployment logs for reference
