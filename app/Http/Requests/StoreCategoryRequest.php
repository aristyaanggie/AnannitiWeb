<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:100', 'unique:categories,slug'],
            'type' => ['required', 'in:product,gallery'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.max' => 'Category name must not exceed 100 characters.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug already exists. Please use a different one.',
            'type.required' => 'Please select a category type.',
            'type.in' => 'Type must be either Product or Gallery.',
            'image.image' => 'Image must be an image file.',
            'image.mimes' => 'Image must be a JPG, JPEG, PNG, or WebP file.',
            'image.max' => 'Image must not exceed 5MB.',
        ];
    }
}
