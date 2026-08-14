# Context - Reusable Components

Dokumentasi pattern untuk reusable components di Ananniti Tattoo Bali.

## Component Architecture

### Structure

```
resources/views/components/
├── ui/                    # Basic UI components
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── input.blade.php
│   └── ...
├── layout/                # Layout components
│   ├── navigation.blade.php
│   ├── footer.blade.php
│   └── ...
└── sections/              # Section components
    ├── hero.blade.php
    ├── about.blade.php
    └── ...
```

## Component Naming

### Naming Convention

- Gunakan descriptive names
- Gunakan kebab-case di file names
- Gunakan PascalCase di component usage
- Namespace dengan folder structure

**Contoh**:
```blade
<!-- File: resources/views/components/ui/button.blade.php -->
<x-ui.button />

<!-- File: resources/views/components/layout/header.blade.php -->
<x-layout.header />

<!-- File: resources/views/components/sections/hero-section.blade.php -->
<x-sections.hero-section />
```

## Component Slots

Blade components support multiple slots:

```blade
<!-- Component definition -->
<div class="card">
  <div class="card-header">
    {{ $slot }}
  </div>
  <div class="card-body">
    {{ $body }}
  </div>
</div>

<!-- Usage -->
<x-card>
  Card Title
  <x-slot:body>
    Card content here
  </x-slot:body>
</x-card>
```

## Props Pattern

Pass data via component attributes:

```blade
<!-- Component definition -->
<button 
  class="btn btn-{{ $variant }}"
  {{ $attributes }}
>
  {{ $slot }}
</button>

<!-- Usage -->
<x-button variant="primary" class="w-full">
  Click Me
</x-button>
```

## Component Guidelines

### Single Responsibility
- Each component does one thing
- Easy to understand
- Easy to test
- Easy to maintain

### Flexibility
- Accept props untuk customization
- Support slot composition
- Allow attribute merging
- Provide sensible defaults

### Consistency
- Follow naming conventions
- Gunakan consistent prop names
- Maintain visual consistency
- Document usage

### Performance
- Minimize nesting
- Hindari unnecessary components
- Gunakan slots over props when possible
- Keep components small

## Common Component Types

### Presentation Components

Display data, no business logic:

```blade
<!-- Button component -->
<button class="btn btn-{{ $variant }}">
  {{ $slot }}
</button>

<!-- Card component -->
<div class="card">
  <div class="card-title">{{ $title }}</div>
  <div class="card-content">{{ $slot }}</div>
</div>
```

### Container Components

Handle logic dan state:

```blade
<!-- Product list dengan filtering -->
<div>
  @forelse($products as $product)
    <x-product-card :product="$product" />
  @empty
    <p>No products found</p>
  @endforelse
</div>
```

### Layout Components

Structure page layout:

```blade
<!-- Main layout -->
<div class="layout">
  <x-layout.header />
  <main class="content">
    {{ $slot }}
  </main>
  <x-layout.footer />
</div>
```

## Prop Conventions

### Naming
- camelCase untuk prop names
- Descriptive names
- Hindari abbreviations
- Indicate type di name when unclear

**Contoh**:
```blade
<!-- Good -->
<x-button :disabled="$isDisabled" />
<x-card :image-url="$imageUrl" />
<x-form-field :error-message="$error" />

<!-- Bad -->
<x-button :dis="true" />
<x-card :img="$image" />
<x-form-field :err="$error" />
```

### Prop Types

```blade
<!-- String -->
<x-button label="Click Me" />

<!-- Boolean -->
<x-button :disabled="true" />

<!-- Array/Collection -->
<x-select :options="$categories" />

<!-- Object/Model -->
<x-user-card :user="$user" />

<!-- Callback -->
<x-button :on-click="$handleClick" />
```

## Slot Usage

### Default Slot

```blade
<!-- Component -->
<div class="card">
  {{ $slot }}
</div>

<!-- Usage -->
<x-card>
  Card content
</x-card>
```

### Named Slots

```blade
<!-- Component -->
<div class="card">
  <div class="header">
    {{ $header }}
  </div>
  <div class="body">
    {{ $slot }}
  </div>
  <div class="footer">
    {{ $footer }}
  </div>
</div>

<!-- Usage -->
<x-card>
  <x-slot:header>
    Card Header
  </x-slot:header>
  
  Main content
  
  <x-slot:footer>
    Card Footer
  </x-slot:footer>
</x-card>
```

## Attribute Binding

Pass multiple attributes:

```blade
<!-- Component -->
<button {{ $attributes->merge(['class' => 'btn']) }}>
  {{ $slot }}
</button>

<!-- Usage -->
<x-button class="w-full" id="submit-btn" data-action="submit">
  Submit
</x-button>
```

## Conditional Rendering

```blade
<!-- Component -->
@if($showIcon)
  <span class="icon">{{ $icon }}</span>
@endif

<!-- Usage -->
<x-button :show-icon="true" icon="check" />
```

## Looping di Components

```blade
<!-- Component -->
<ul class="list">
  @forelse($items as $item)
    <li>{{ $item->name }}</li>
  @empty
    <li class="empty">No items</li>
  @endforelse
</ul>

<!-- Usage -->
<x-item-list :items="$items" />
```

## Component Props Documentation

Document setiap component:

```blade
{{-- 
  Button Component
  
  Props:
  - variant (string): 'primary', 'secondary', 'danger' [default: 'primary']
  - size (string): 'sm', 'md', 'lg' [default: 'md']
  - disabled (boolean): Disable button [default: false]
  - type (string): Button type 'submit', 'button' [default: 'button']
  
  Slots:
  - default: Button text content
  
  Contoh:
  <x-button variant="primary" size="lg">Click Me</x-button>
--}}

<button class="btn btn-{{ $variant }} btn-{{ $size }}" 
  {{ $disabled ? 'disabled' : '' }}
  type="{{ $type }}"
  {{ $attributes }}
>
  {{ $slot }}
</button>
```

## Testing Components

```php
// tests/Feature/Components/ButtonTest.php

public function test_button_renders_with_text()
{
    $view = $this->blade(
        '<x-button>Click Me</x-button>'
    );
    
    $view->assertSee('Click Me');
}

public function test_button_applies_variant_class()
{
    $view = $this->blade(
        '<x-button variant="danger">Delete</x-button>'
    );
    
    $view->assertSee('btn-danger');
}
```

## Composition Pattern

Combine components untuk complex UI:

```blade
<!-- Component: user-profile -->
<div class="profile">
  <x-avatar :src="$user->avatar" />
  <div class="info">
    <h3>{{ $user->name }}</h3>
    <p>{{ $user->bio }}</p>
    <x-button variant="primary">Follow</x-button>
  </div>
</div>
```

## Performance Tips

1. Lazy load heavy components
2. Gunakan slots instead of props when possible
3. Cache component output jika appropriate
4. Minimize component nesting depth
5. Gunakan `@once` untuk repeated content

## Best Practices

- [x] Keep components small dan focused
- [x] Gunakan descriptive names
- [x] Document props dan slots
- [x] Gunakan consistent styling approach
- [x] Test component behavior
- [x] Follow Tailwind conventions
- [x] Support responsive design
- [x] Ensure accessibility
- [x] Version components carefully
- [x] Update documentation dengan changes

## References

- Laravel Blade documentation: https://laravel.com/docs/blade
- Tailwind component patterns: https://tailwindcss.com/docs/utility-first
