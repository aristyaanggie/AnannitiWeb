# Flowchart

Flowchart dan user journey untuk Ananniti Tattoo Bali.

## User Journey Map

### Customer Journey

```
[Landing Page]
     ↓
[Browse Portfolio]
     ↓
[View Services]
     ↓
[Make Decision]
     ├─→ [Browse Shop]
     │    ↓
     │   [Add to Cart]
     │    ↓
     │   [Checkout]
     │    ↓
     │   [Payment]
     │    ↓
     │   [Order Confirmation]
     │
     └─→ [Book Appointment]
          ↓
         [Select Date/Time]
          ↓
         [Fill Booking Form]
          ↓
         [Review & Confirm]
          ↓
         [Booking Confirmation]
```

## Authentication Flow

```
[User]
  ↓
[Login Page]
  ├─→ [Email & Password]
  │    ↓
  │  [Validate Credentials]
  │    ├─→ [Invalid] → [Error Message]
  │    └─→ [Valid]
  │         ↓
  │      [Generate Token]
  │         ↓
  │      [Redirect to Dashboard]
  │
  └─→ [Register Page]
       ↓
      [Fill Registration Form]
       ↓
      [Validate Input]
       ├─→ [Invalid] → [Show Errors]
       └─→ [Valid]
            ↓
           [Create User Account]
            ↓
           [Auto Login]
            ↓
           [Redirect to Dashboard]
```

## Booking Flow

```
[Booking Page]
  ↓
[Select Tattoo Artist]
  ↓
[Select Date & Time]
  ↓
[Select Service Type]
  ↓
[Enter Design Details]
  ↓
[Review Booking]
  ↓
[Confirm Booking]
  ├─→ [Payment Required]
  │    ↓
  │   [Process Payment]
  │    ├─→ [Payment Failed] → [Error]
  │    └─→ [Payment Success]
  │         ↓
  │      [Send Confirmation Email]
  │         ↓
  │      [Booking Confirmed]
  │
  └─→ [Free Booking]
       ↓
      [Send Confirmation Email]
       ↓
      [Booking Confirmed]
```

## Shop/Purchase Flow

```
[Product Page]
  ↓
[Select Product]
  ↓
[Choose Options/Variants]
  ↓
[Add to Cart]
  ↓
[Continue Shopping?]
  ├─→ [Yes] → [Back to Products]
  └─→ [No]
       ↓
      [View Cart]
       ↓
      [Review Items]
       ↓
      [Proceed to Checkout]
       ↓
      [Enter Shipping Address]
       ↓
      [Select Shipping Method]
       ↓
      [Enter Payment Info]
       ↓
      [Review Order]
       ↓
      [Place Order]
       ├─→ [Payment Failed] → [Retry]
       └─→ [Payment Success]
            ↓
           [Order Confirmation]
            ↓
           [Send Confirmation Email]
            ↓
           [Update Order Status]
```

## Admin Workflow

```
[Admin Dashboard]
  ├─→ [Manage Users]
  │    ├─→ [View All Users]
  │    ├─→ [Edit User]
  │    └─→ [Delete User]
  │
  ├─→ [Manage Portfolio]
  │    ├─→ [View Gallery]
  │    ├─→ [Upload Image]
  │    ├─→ [Edit Details]
  │    └─→ [Delete Image]
  │
  ├─→ [Manage Bookings]
  │    ├─→ [View All Bookings]
  │    ├─→ [Confirm Booking]
  │    ├─→ [Update Status]
  │    └─→ [Cancel Booking]
  │
  ├─→ [Manage Products]
  │    ├─→ [Add Product]
  │    ├─→ [Edit Product]
  │    ├─→ [Manage Inventory]
  │    └─→ [Delete Product]
  │
  ├─→ [Manage Orders]
  │    ├─→ [View Orders]
  │    ├─→ [Update Status]
  │    ├─→ [Print Invoice]
  │    └─→ [Process Refund]
  │
  └─→ [Analytics & Reports]
       ├─→ [Sales Dashboard]
       ├─→ [Booking Stats]
       └─→ [Traffic Analytics]
```

## Page Structure Flow

```
[Home Page]
  ├─→ [Navigation Bar]
  ├─→ [Hero Section]
  ├─→ [Portfolio Preview]
  ├─→ [Services Overview]
  ├─→ [About Section]
  ├─→ [Testimonials]
  ├─→ [Shop Preview]
  ├─→ [CTA Section]
  ├─→ [Contact Section]
  └─→ [Footer]

[Portfolio Page]
  ├─→ [Navigation Bar]
  ├─→ [Page Header]
  ├─→ [Filter Section]
  ├─→ [Gallery Grid]
  │    └─→ [Portfolio Items]
  │         └─→ [Detail Modal/Page]
  ├─→ [Pagination]
  └─→ [Footer]

[Booking Page]
  ├─→ [Navigation Bar]
  ├─→ [Page Header]
  ├─→ [Booking Form]
  │    ├─→ [Artist Selection]
  │    ├─→ [Date/Time Picker]
  │    ├─→ [Service Selection]
  │    ├─→ [Design Details]
  │    └─→ [Submit]
  └─→ [Footer]

[Shop Page]
  ├─→ [Navigation Bar]
  ├─→ [Page Header]
  ├─→ [Sidebar - Categories]
  ├─→ [Product Grid]
  │    └─→ [Product Cards]
  ├─→ [Pagination]
  └─→ [Footer]

[Checkout Page]
  ├─→ [Cart Summary]
  ├─→ [Shipping Address]
  ├─→ [Shipping Method]
  ├─→ [Payment Method]
  ├─→ [Order Review]
  ├─→ [Place Order Button]
  └─→ [Footer]
```

## Error Handling Flow

```
[User Action]
  ↓
[Validate Input]
  ├─→ [Invalid]
  │    ↓
  │  [Display Error Message]
  │    ↓
  │  [Highlight Error Fields]
  │    ↓
  │  [User Corrects Input]
  │    ↓
  │  [Retry]
  │
  └─→ [Valid]
       ↓
      [Process Action]
       ├─→ [Success]
       │    ↓
       │   [Display Success Message]
       │    ↓
       │   [Redirect/Update]
       │
       └─→ [Error]
            ↓
           [Display Error Message]
            ↓
           [Log Error]
            ↓
           [User Retries or Contacts Support]
```

## Data Flow

```
[User Interface]
     ↓
[Frontend (Blade + HTMX/JS)]
     ↓
[Laravel Route]
     ↓
[Controller]
     ↓
[Validation/Authorization]
     ├─→ [Unauthorized/Invalid] → [Error Response]
     └─→ [Valid]
          ↓
         [Service Layer]
          ↓
         [Database Query/Update]
          ↓
         [Response]
          ↓
     [Return to Controller]
          ↓
     [Return JSON/View]
          ↓
     [Display to User]
```

## Notes

- [TO BE DEFINED] - Additional flowchart details
- [TO BE DEFINED] - State management flow
- [TO BE DEFINED] - Notification flow
