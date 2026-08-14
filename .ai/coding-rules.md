# Aturan Coding

Aturan coding dan best practices untuk project Ananniti Tattoo Bali.

## PHP & Laravel

### Code Style

- Follow PSR-12 coding standard
- Gunakan 4 spaces untuk indentation
- Maximum line length: 120 characters
- Gunakan variable dan function names yang meaningful

### Laravel Best Practices

- Gunakan Eloquent ORM daripada query builder bila memungkinkan
- Gunakan Collections untuk manipulasi data
- Gunakan dependency injection
- Gunakan middleware untuk cross-cutting concerns
- Gunakan service layer untuk business logic
- Gunakan form requests untuk validation
- Gunakan jobs untuk long-running tasks

### Classes & Functions

```php
// Class naming: PascalCase
class UserController {}

// Function naming: camelCase
public function getUserProfile() {}

// Method chaining when possible
$users->where('active', true)->orderBy('name')->get();

// Type hints always
public function store(StoreUserRequest $request): RedirectResponse {}

// Return types always
public function index(): View {}
```

### Comments

- Gunakan comments untuk WHY, bukan WHAT
- Hapus commented-out code
- Gunakan /** */ untuk documentation blocks
- Minimal comments, let code speak for itself

## Blade Templates

### Struktur

- Gunakan semantic HTML
- Keep templates clean dan readable
- Gunakan blade components untuk reusable parts
- Gunakan blade directives dengan benar

### Naming

```
resources/views/
├── layouts/
│   └── app.blade.php          # Main layout
├── pages/
│   ├── home.blade.php         # Page-level templates
│   └── products/index.blade.php
├── partials/
│   ├── header.blade.php       # Shared partials
│   └── footer.blade.php
└── components/
    ├── ui/
    │   ├── button.blade.php
    │   └── card.blade.php
    ├── layout/
    │   └── navigation.blade.php
    └── sections/
        └── hero.blade.php
```

### Blade Best Practices

- Gunakan `@php` sparingly, move logic ke controller
- Gunakan `@forelse` instead of `@foreach` + check
- Gunakan `@csrf` untuk semua forms
- Gunakan named routes: `route('name')`
- Gunakan blade components: `<x-button />`

## Tailwind CSS

### Class Usage

- Gunakan utility classes untuk styling
- Hindari custom CSS kecuali necessary
- Gunakan responsive prefixes: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`
- Gunakan dark mode prefixes: `dark:`

### Organization

```css
/* Gunakan @layer untuk custom components */
@layer components {
    .btn {
        @apply px-4 py-2 rounded font-semibold;
    }
}

/* Keep app.css clean */
```

### Naming Classes

- Gunakan semantic names
- Gunakan kebab-case
- Hindari abbreviations kecuali clear

## JavaScript

### Modules

```javascript
// Gunakan ES modules
import { function } from './utils';
export const myFunction = () => {};

// Vite handles bundling
```

### Alpine.js (if used)

```html
<!-- Gunakan Alpine untuk interactivity -->
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
</div>
```

## File Organization

### Controllers

```
app/Http/Controllers/
├── Admin/
│   ├── DashboardController.php
│   └── ProductController.php
├── Public/
│   ├── HomeController.php
│   └── ProductController.php
└── Api/
    └── ProductController.php
```

### Models

```
app/Models/
├── User.php
├── Product.php
└── Order.php
```

### Services

```
app/Services/
├── ProductService.php
├── OrderService.php
└── PaymentService.php
```

## Database

- Gunakan migrations untuk schema changes
- Gunakan meaningful table names (plural)
- Gunakan meaningful column names
- Gunakan timestamps untuk created_at, updated_at
- Gunakan soft deletes where appropriate
- Add indexes pada frequently queried columns

## Testing

- Tulis tests untuk critical features
- Gunakan descriptive test names
- Test one thing per test
- Gunakan test factories untuk test data
- Mock external dependencies

## Security

- Always validate input
- Gunakan CSRF protection
- Hash passwords
- Gunakan prepared statements (Eloquent)
- Escape output di templates
- Validate file uploads
- Gunakan HTTPS di production
- Never commit secrets ke repository

## Performance

- Gunakan lazy loading when appropriate
- Cache frequently accessed data
- Gunakan query optimization
- Minimize database queries (N+1 prevention)
- Gunakan indexes pada database columns
- Optimize asset sizes

## Git Commits

- Tulis clear, descriptive commit messages
- Gunakan present tense
- Keep commits atomic dan focused
- Reference issues when applicable

Contoh:
```
Tambah user authentication feature

- Implementasikan login/logout functionality
- Tambah password reset flow
- Integrate dengan email service

Fixes #123
```

## Code Review Checklist

- [ ] Code follows style guide
- [ ] Logic is clear dan correct
- [ ] No console.log atau debug statements
- [ ] No commented-out code
- [ ] Tests are written
- [ ] Performance is acceptable
- [ ] Security is considered
- [ ] Documentation is updated

## Blade Component Rules

Semua Blade Component WAJIB menggunakan @props.

Seluruh props opsional harus memiliki default value.

Contoh:

@props([
    'title',
    'subtitle' => null,
    'variant' => 'primary',
    'tag' => 'div',
])

Jangan mengakses variable yang belum didefinisikan.

## Icon Rules

Gunakan Lucide React sebagai satu-satunya sumber icon pada project.

Aturan:

- Jangan menggunakan Heroicons.
- Jangan menggunakan Font Awesome.
- Jangan menggunakan Bootstrap Icons.
- Jangan menggunakan SVG random.

Gunakan icon seminimal mungkin.

Icon hanya digunakan apabila benar-benar membantu UX.

Ukuran icon:

- 20px
- 24px

Icon harus mengikuti warna typography atau button, bukan memiliki warna sendiri.

Jangan memberikan efek berlebihan pada icon.

Seluruh icon harus konsisten dengan filosofi desain premium, minimal, dan editorial.