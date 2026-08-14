<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'biography' => ['nullable', 'string', 'max:2000'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:100'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'is_visible' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Artist name is required.',
            'name.max' => 'Artist name must not exceed 255 characters.',
            'slug.required' => 'Slug is required.',
            'slug.max' => 'Slug must not exceed 255 characters.',
            'photo.image' => 'Photo must be an image file.',
            'photo.mimes' => 'Photo must be a JPG, JPEG, PNG, or WebP file.',
            'photo.max' => 'Photo must not exceed 5MB.',
            'biography.max' => 'Biography must not exceed 2000 characters.',
            'specialization.max' => 'Specialization must not exceed 255 characters.',
            'experience_years.integer' => 'Experience must be a whole number.',
            'experience_years.min' => 'Experience must be at least 0.',
            'experience_years.max' => 'Experience must not exceed 100.',
        ];
    }
}
