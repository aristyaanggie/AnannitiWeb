<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'category_id' => ['required', 'exists:categories,id'],
            'badge_id' => ['nullable', 'exists:product_badges,id'],
            'sales_format' => ['required', 'in:standard,individual,both'],
            'standard_unit' => ['required_if:sales_format,standard,both', 'nullable', 'string', 'max:50'],
            'standard_quantity' => ['required_if:sales_format,standard,both', 'nullable', 'integer', 'min:1'],
            'standard_price' => ['required_if:sales_format,standard,both', 'nullable', 'numeric', 'min:0'],
            'individual_unit' => ['required_if:sales_format,individual,both', 'nullable', 'string', 'max:50'],
            'individual_price' => ['required_if:sales_format,individual,both', 'nullable', 'numeric', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'is_visible' => ['required', 'in:0,1'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name must not exceed 255 characters.',
            'slug.unique' => 'This slug already exists. Please use a different one.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'badge_id.exists' => 'Selected badge does not exist.',
            'sales_format.required' => 'Sales format is required.',
            'sales_format.in' => 'Invalid sales format selected.',
            'standard_unit.required_if' => 'Standard unit is required when using Standard Package.',
            'standard_quantity.required_if' => 'Standard quantity is required when using Standard Package.',
            'standard_price.required_if' => 'Standard price is required when using Standard Package.',
            'individual_unit.required_if' => 'Individual unit is required when using Individual Unit.',
            'individual_price.required_if' => 'Individual price is required when using Individual Unit.',
            'price.numeric' => 'Price must be a number.',
            'stock_quantity.required' => 'Stock quantity is required.',
            'stock_quantity.integer' => 'Stock must be a whole number.',
            'minimum_stock.required' => 'Minimum stock is required.',
            'minimum_stock.integer' => 'Minimum stock must be a whole number.',
            'description.required' => 'Description is required.',
            'is_visible.required' => 'Please select a status.',
            'is_visible.in' => 'Status must be Published or Draft.',
            'meta_title.max' => 'Meta title must not exceed 255 characters.',
            'meta_description.max' => 'Meta description must not exceed 500 characters.',
            'thumbnail.image' => 'Thumbnail must be an image.',
            'thumbnail.mimes' => 'Thumbnail must be a JPG, JPEG, PNG, or WebP file.',
            'thumbnail.max' => 'Thumbnail must not exceed 20MB.',
            'gallery.*.image' => 'Gallery items must be images.',
            'gallery.*.mimes' => 'Gallery items must be JPG, JPEG, PNG, or WebP files.',
            'gallery.*.max' => 'Each gallery image must not exceed 20MB.',
        ];
    }
}
