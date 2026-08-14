<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Business
            'studio_name' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'google_maps_url' => ['nullable', 'string', 'max:500'],
            'business_hours' => ['nullable', 'string', 'max:255'],
            // Social
            'instagram' => ['nullable', 'string', 'max:500'],
            'tiktok' => ['nullable', 'string', 'max:500'],
            'facebook' => ['nullable', 'string', 'max:500'],
            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'studio_name.max' => 'Studio name must not exceed 255 characters.',
            'tagline.max' => 'Tagline must not exceed 255 characters.',
            'description.max' => 'Description must not exceed 1000 characters.',
            'email.email' => 'Please enter a valid email address.',
            'address.max' => 'Address must not exceed 500 characters.',
            'google_maps_url.max' => 'Google Maps URL must not exceed 500 characters.',
            'business_hours.max' => 'Business hours must not exceed 255 characters.',
            'instagram.max' => 'Instagram URL must not exceed 500 characters.',
            'tiktok.max' => 'TikTok URL must not exceed 500 characters.',
            'facebook.max' => 'Facebook URL must not exceed 500 characters.',
            'meta_title.max' => 'Meta title must not exceed 255 characters.',
            'meta_description.max' => 'Meta description must not exceed 500 characters.',
        ];
    }
}
