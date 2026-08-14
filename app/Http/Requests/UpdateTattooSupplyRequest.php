<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTattooSupplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'link' => ['nullable', 'string', 'max:500'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'Title must not exceed 255 characters.',
            'subtitle.max' => 'Subtitle must not exceed 255 characters.',
            'image.image' => 'Image must be an image file.',
            'image.mimes' => 'Image must be a JPG, JPEG, PNG, or WebP file.',
            'image.max' => 'Image must not exceed 5MB.',
            'link.max' => 'Link must not exceed 500 characters.',
        ];
    }
}
