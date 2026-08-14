# Checklist Code Review

Checklist untuk melakukan code review pada project Ananniti Tattoo Bali.

## Pre-Review

- [ ] Branch name follows naming convention
- [ ] Commit messages are clear dan descriptive
- [ ] No merge conflicts
- [ ] Pipeline/CI passes
- [ ] No security warnings

## Kualitas Kode

- [ ] Code follows coding-rules.md
- [ ] Code is readable dan maintainable
- [ ] No duplicate code
- [ ] No commented-out code
- [ ] No console.log atau debug statements
- [ ] Variable dan function names are meaningful
- [ ] Functions are reasonably sized
- [ ] Classes have single responsibility
- [ ] Proper error handling
- [ ] No hardcoded values (use config)

## Laravel & PHP

- [ ] Follows PSR-12 standard
- [ ] Uses Eloquent instead of raw queries
- [ ] Proper use of dependency injection
- [ ] Middleware is properly configured
- [ ] Route names are semantic
- [ ] Controllers are not too large
- [ ] Business logic is in services
- [ ] Validation is in form requests

## Blade & Frontend

- [ ] HTML is semantic
- [ ] Tailwind classes are used correctly
- [ ] No inline styles
- [ ] Responsive design is implemented
- [ ] Accessibility is considered
- [ ] Components are reusable

## Security

- [ ] CSRF protection on forms
- [ ] Input validation on all forms
- [ ] Output is escaped in templates
- [ ] No hardcoded credentials
- [ ] No sensitive data in logs
- [ ] File uploads are validated
- [ ] Authorization checks are in place

## Performance

- [ ] No N+1 queries
- [ ] Database queries are optimized
- [ ] Indexes are on frequently queried columns
- [ ] Caching is used where appropriate
- [ ] Asset sizes are reasonable
- [ ] No unnecessary computations in loops

## Testing

- [ ] Tests are written for new features
- [ ] Tests have good coverage
- [ ] Tests are descriptive
- [ ] Tests pass locally
- [ ] No flaky tests

## Database

- [ ] Migrations are properly written
- [ ] Migration naming is clear
- [ ] Down method is implemented
- [ ] Seeders are organized
- [ ] No production data in seeders

## Dokumentasi

- [ ] Code is documented with docblocks
- [ ] Complex logic is explained
- [ ] README is updated if needed
- [ ] API documentation is updated
- [ ] Breaking changes are documented

## Git Hygiene

- [ ] Commits are atomic
- [ ] Commit history is clean
- [ ] No accidental files committed
- [ ] No secrets in commits

## Architecture

- [ ] Changes follow project architecture
- [ ] No circular dependencies
- [ ] Separation of concerns is maintained
- [ ] Design patterns are followed

## Additional Checks

- [ ] Changes are within scope
- [ ] No unnecessary dependencies added
- [ ] Build is successful
- [ ] No warnings in console
- [ ] Deployment considerations are met

## Sign-Off

- [ ] All checks passed
- [ ] Ready for merge
- [ ] Reviewer name: ___________
- [ ] Date: ___________
