# API Plan

Dokumentasi rencana API endpoints untuk Ananniti Tattoo Bali.

## Overview API

API dirancang dengan RESTful principles untuk mendukung frontend operations dan future mobile app development.

## API Versioning

- Current version: v1
- Base URL: `[TO BE DEFINED]/api/v1`

## Authentication

- [TO BE DEFINED] - Authentication method (JWT, Laravel Sanctum, etc.)
- [TO BE DEFINED] - Token expiration
- [TO BE DEFINED] - Refresh token mechanism

## Response Format

Semua API responses menggunakan format JSON yang konsisten:

```json
{
  "success": true/false,
  "message": "Success message or error message",
  "data": {},
  "errors": [],
  "meta": {
    "page": 1,
    "per_page": 15,
    "total": 100,
    "total_pages": 7
  }
}
```

## HTTP Status Codes

- `200 OK` - Successful GET/PUT/PATCH
- `201 Created` - Successful POST
- `204 No Content` - Successful DELETE
- `400 Bad Request` - Invalid input
- `401 Unauthorized` - Authentication required
- `403 Forbidden` - Authorization failed
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation failed
- `500 Internal Server Error` - Server error

## Rate Limiting

[TO BE DEFINED]

## API Endpoints

### Authentication

- `POST /auth/register` - Register new user
- `POST /auth/login` - Login user
- `POST /auth/logout` - Logout user
- `POST /auth/refresh` - Refresh token
- `GET /auth/me` - Get current user

### User Profile

- `GET /users/:id` - Get user profile
- `PUT /users/:id` - Update user profile
- `DELETE /users/:id` - Delete account

### Portfolio

- `GET /portfolio` - Get all portfolio items
- `GET /portfolio/:id` - Get portfolio item detail
- `POST /portfolio` - Create portfolio item (admin)
- `PUT /portfolio/:id` - Update portfolio item (admin)
- `DELETE /portfolio/:id` - Delete portfolio item (admin)

### Bookings

- `GET /bookings` - Get user bookings
- `POST /bookings` - Create booking
- `GET /bookings/:id` - Get booking detail
- `PUT /bookings/:id` - Update booking
- `DELETE /bookings/:id` - Cancel booking

### Shop/Products

- `GET /products` - Get all products
- `GET /products/:id` - Get product detail
- `POST /products` - Create product (admin)
- `PUT /products/:id` - Update product (admin)
- `DELETE /products/:id` - Delete product (admin)

### Orders

- `GET /orders` - Get user orders
- `POST /orders` - Create order
- `GET /orders/:id` - Get order detail
- `PUT /orders/:id` - Update order status (admin)
- `DELETE /orders/:id` - Cancel order

### Cart

- `GET /cart` - Get shopping cart
- `POST /cart/items` - Add item to cart
- `PUT /cart/items/:id` - Update item quantity
- `DELETE /cart/items/:id` - Remove item from cart
- `DELETE /cart` - Clear cart

### Admin

- `GET /admin/dashboard` - Get dashboard stats
- `GET /admin/users` - Get all users
- `GET /admin/bookings` - Get all bookings
- `GET /admin/orders` - Get all orders

### Public Information

- `GET /services` - Get services list
- `GET /about` - Get about information
- `GET /contact` - Get contact information
- `POST /contact` - Submit contact form

## Pagination

Default pagination: 15 items per page

```
GET /portfolio?page=1&per_page=20
```

## Filtering

[TO BE DEFINED]

## Sorting

[TO BE DEFINED]

## Error Handling

All errors return standardized error response:

```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field_name": ["Error message for field"]
  }
}
```

## Documentation

Detailed API documentation akan tersedia di:
- Postman Collection: [TO BE DEFINED]
- OpenAPI/Swagger: [TO BE DEFINED]
- API Documentation: [TO BE DEFINED]

## CORS Policy

[TO BE DEFINED]

## Webhook Events

[TO BE DEFINED]

## Rate Limiting

[TO BE DEFINED]

## API Security

- Input validation required
- Output escaping required
- SQL injection prevention via Eloquent
- CSRF protection
- Rate limiting (if applicable)
