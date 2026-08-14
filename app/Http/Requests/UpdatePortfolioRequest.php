<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $portfolioId = $this->route('portfolio')?->id;

        return [
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:150', Rule::unique('portfolio_items', 'slug')->ignore($portfolioId)],
            'artist_id' => ['required', 'exists:artist_profiles,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'tattoo_style' => ['nullable', 'string', 'max:100'],
            'placement' => ['nullable', 'string', 'max:100'],
            'session_hours' => ['nullable', 'integer', 'min:1'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'Title must not exceed 150 characters.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug already exists.',
            'artist_id.required' => 'Please select an artist.',
            'artist_id.exists' => 'Selected artist does not exist.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'image.image' => 'Image must be an image file.',
            'image.mimes' => 'Image must be JPG, JPEG, PNG, or WebP.',
            'image.max' => 'Image must not exceed 5MB.',
        ];
    }
}
