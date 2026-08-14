<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:portfolio_items,slug'],
            'artist_id' => ['required', 'exists:artist_profiles,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'tattoo_style' => ['nullable', 'string', 'max:100'],
            'placement' => ['nullable', 'string', 'max:100'],
            'session_hours' => ['nullable', 'integer', 'min:1'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'Title must not exceed 150 characters.',
            'slug.unique' => 'This slug already exists.',
            'artist_id.required' => 'Please select an artist.',
            'artist_id.exists' => 'Selected artist does not exist.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'image.image' => 'Image must be an image file.',
            'image.required' => 'Please select an image.',
            'image.mimes' => 'Image must be JPG, JPEG, PNG, or WebP.',
            'image.max' => 'Image must not exceed 5MB.',
        ];
    }
}
