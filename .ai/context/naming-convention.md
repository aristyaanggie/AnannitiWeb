# Context - Naming Convention

Naming conventions untuk kode di Ananniti Tattoo Bali.

## Folder & File Naming

### Controllers
```
PascalCase + "Controller" suffix

Contoh:
- HomeController.php
- ProductController.php
- BookingController.php
- AdminDashboardController.php
```

### Models
```
PascalCase, singular

Contoh:
- User.php
- Product.php
- Booking.php
- PortfolioItem.php
```

### Migrations
```
timestamp_snake_case_action_table_name

Contoh:
- 2024_07_10_120000_create_users_table.php
- 2024_07_10_120100_add_phone_to_users_table.php
- 2024_07_10_120200_create_bookings_table.php
```

### Views (Blade)
```
kebab-case.blade.php

Contoh:
- home.blade.php
- product-list.blade.php
- booking-form.blade.php
- admin-dashboard.blade.php
```

### Components
```
kebab-case.blade.php (component files)
<x-component-name /> (usage)

Contoh:
- button.blade.php → <x-button />
- card.blade.php → <x-card />
- hero-section.blade.php → <x-hero-section />
```

### CSS/SCSS Files
```
kebab-case.css

Contoh:
- app.css
- main.css
- components.css
```

### JavaScript Files
```
camelCase.js atau kebab-case.js

Contoh:
- app.js
- bootstrap.js
- helpers.js
- api-client.js
```

## Variable Naming

### PHP Variables
```
camelCase

Contoh:
$userName
$productId
$bookingStatus
$isActive
```

### PHP Constants
```
UPPER_SNAKE_CASE

Contoh:
define('MAX_UPLOAD_SIZE', 5242880);
const API_TIMEOUT = 30;
```

### Database Tables
```
snake_case, plural

Contoh:
- users
- products
- bookings
- portfolio_items
- order_items
```

### Database Columns
```
snake_case

Contoh:
- user_id (foreign key)
- created_at (timestamp)
- booking_status (status field)
- tattoo_style (enum/string)
```

### Database Foreign Keys
```
singular_id

Contoh:
- user_id
- artist_id
- product_id
- category_id
```

### Database Indexes
```
idx_table_column atau idx_table_column1_column2

Contoh:
- idx_users_email
- idx_bookings_user_id
- idx_orders_user_id_date
```

### Database Unique Constraints
```
uq_table_column

Contoh:
- uq_users_email
- uq_products_sku
```

## Class Naming

### Service Classes
```
PascalCase + "Service" suffix

Contoh:
- UserService.php
- ProductService.php
- BookingService.php
- PaymentService.php
```

### Repository Classes
```
PascalCase + "Repository" suffix

Contoh:
- UserRepository.php
- ProductRepository.php
- BookingRepository.php
```

### Request Classes
```
PascalCase + "Request" suffix

Contoh:
- StoreUserRequest.php
- UpdateProductRequest.php
- CreateBookingRequest.php
```

### Event Classes
```
PascalCase + past tense atau description

Contoh:
- UserCreated.php
- BookingConfirmed.php
- OrderShipped.php
```

### Job Classes
```
PascalCase + "Job" suffix

Contoh:
- ProcessBookingJob.php
- SendEmailJob.php
- GenerateReportJob.php
```

### Middleware Classes
```
PascalCase + optional "Middleware" suffix

Contoh:
- Authenticate.php
- CheckRole.php
- VerifyToken.php
```

## Method Naming

### Action Methods (Controllers)
```
camelCase, descriptive verb

Contoh:
- index()      // List all
- show()       // Show single
- create()     // Show creation form
- store()      // Save to database
- edit()       // Show edit form
- update()     // Update in database
- destroy()    // Delete from database
```

### Query Methods
```
camelCase, starts with "get" atau similar

Contoh:
- getActiveUsers()
- findUserByEmail()
- countTotalBookings()
- getBookingsByDate()
```

### Accessor Methods
```
camelCase, "get" prefix (optional di Laravel)

Contoh:
- getFullName()
- getFormattedDate()
- isBookingActive()
```

### Boolean Methods
```
camelCase, starts dengan "is" atau "has"

Contoh:
- isActive()
- hasPermission()
- canEdit()
- isAdmin()
```

## JavaScript/Frontend Naming

### Vue/React Components
```
PascalCase

Contoh:
- Button.vue
- ProductCard.vue
- HeroSection.vue
- NavBar.vue
```

### JavaScript Functions
```
camelCase

Contoh:
- formatDate()
- calculateTotal()
- handleClick()
- validateEmail()
```

### JavaScript Constants
```
UPPER_SNAKE_CASE

Contoh:
const MAX_ITEMS = 100;
const API_BASE_URL = 'https://api.example.com';
const DEFAULT_TIMEOUT = 5000;
```

### JavaScript Variables
```
camelCase

Contoh:
let isLoading = false;
const userData = {};
var count = 0;
```

### Event Handlers
```
camelCase, starts dengan "handle"

Contoh:
- handleClick()
- handleSubmit()
- handleInputChange()
- handleFormSubmit()
```

### CSS Classes
```
kebab-case, BEM methodology (optional)

Contoh:
- btn-primary
- card__header
- product-list__item
- is-active
- has-error
```

## API Naming

### Endpoints
```
kebab-case, RESTful

Contoh:
- GET /api/v1/users
- POST /api/v1/users
- GET /api/v1/users/:id
- PUT /api/v1/users/:id
- DELETE /api/v1/users/:id
```

### Query Parameters
```
camelCase

Contoh:
- ?sortBy=name
- ?filterBy=status
- ?page=1&perPage=20
- ?searchQuery=tattoo
```

## Branch Naming

```
kebab-case dengan descriptive prefix

Contoh:
- feature/user-authentication
- bugfix/booking-validation
- hotfix/payment-issue
- refactor/optimize-queries
- docs/api-documentation
```

## Commit Messages

```
Imperative mood, lowercase, no period

Contoh:
- add user authentication
- fix booking date validation
- update product pricing
- refactor query builder
- remove deprecated code
```

## File Organization

```
/app/Services/UserService.php
/app/Repositories/UserRepository.php
/app/Models/User.php
/app/Http/Controllers/UserController.php
/app/Http/Requests/StoreUserRequest.php
/resources/views/users/index.blade.php
/resources/views/users/show.blade.php
/resources/views/components/user-card.blade.php
```

## Consistency

- Be consistent across the entire project
- Follow framework conventions
- Gunakan singular/plural appropriately
- Hindari abbreviations kecuali standard
- Keep names descriptive namun concise
