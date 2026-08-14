<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminBrandAssetsController extends Controller
{
    /**
     * Website Content — field teks yang bisa diedit (Sprint C2 CMS).
     * type: text | textarea
     */
    private const TEXT_FIELDS = [
        // Hero
        'hero_eyebrow' => ['label' => 'Eyebrow', 'type' => 'text', 'section' => 'hero'],
        'hero_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'hero'],
        'hero_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'hero'],
        'hero_subtitle' => ['label' => 'Subtitle', 'type' => 'textarea', 'section' => 'hero'],
        'hero_primary_button' => ['label' => 'Primary Button', 'type' => 'text', 'section' => 'hero'],
        'hero_secondary_button' => ['label' => 'Secondary Button', 'type' => 'text', 'section' => 'hero'],

        // About
        'about_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'about'],
        'about_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'about'],
        'about_description' => ['label' => 'Description', 'type' => 'textarea', 'section' => 'about'],

        // Services
        'services_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'services'],
        'services_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'services'],

        // Supply
        'supply_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'supply'],
        'supply_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'supply'],

        // Portfolio
        'portfolio_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'portfolio'],
        'portfolio_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'portfolio'],

        // Artist
        'artist_badge' => ['label' => 'Badge', 'type' => 'text', 'section' => 'artist'],
        'artist_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'artist'],

        // Consultation
        'consultation_title' => ['label' => 'Title', 'type' => 'text', 'section' => 'consultation'],
        'consultation_description' => ['label' => 'Description', 'type' => 'textarea', 'section' => 'consultation'],
        'consultation_button' => ['label' => 'Button', 'type' => 'text', 'section' => 'consultation'],

        // Footer
        'footer_brand' => ['label' => 'Brand Name', 'type' => 'text', 'section' => 'footer'],
        'footer_copyright' => ['label' => 'Copyright Text', 'type' => 'text', 'section' => 'footer'],
    ];

    private const IMAGE_KEYS = ['logo', 'favicon', 'hero_image', 'about_image', 'gallery_hero', 'shop_hero'];

    public function edit(): View
    {
        $textKeys = array_keys(self::TEXT_FIELDS);

        $assets = Setting::whereIn('key', self::IMAGE_KEYS)
            ->pluck('value', 'key')
            ->toArray();

        $texts = Setting::whereIn('key', $textKeys)
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.brand-assets.edit', [
            'pageTitle' => 'Website Content',
            'assets' => $assets,
            'texts' => $texts,
            'textFields' => self::TEXT_FIELDS,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,ico,svg', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'about_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_hero' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'shop_hero' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        // Simpan gambar (seperti sebelumnya)
        foreach (self::IMAGE_KEYS as $key) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->value('value');
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }

                $path = $request->file($key)->store('brand-assets', 'public');

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path, 'group' => 'brand_assets', 'type' => 'image']
                );
            }
        }

        // Simpan teks website content
        foreach (self::TEXT_FIELDS as $key => $meta) {
            $value = trim((string) $request->input($key, ''));

            if ($value === '') {
                // Kosong → pakai fallback default (biarkan null, helper setting() yang memutuskan)
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => null, 'group' => 'content', 'type' => $meta['type']]
                );
            } else {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'group' => 'content', 'type' => $meta['type']]
                );
            }
        }

        return redirect()->route('admin.brand-assets.edit')
            ->with('success', 'Website content updated successfully.');
    }

    public function destroy(string $key): RedirectResponse
    {
        if (!in_array($key, self::IMAGE_KEYS)) {
            return redirect()->route('admin.brand-assets.edit')
                ->with('error', 'Invalid asset key.');
        }

        $setting = Setting::where('key', $key)->first();

        if ($setting && $setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        Setting::where('key', $key)->update(['value' => null]);

        return redirect()->route('admin.brand-assets.edit')
            ->with('success', ucfirst(str_replace('_', ' ', $key)) . ' deleted successfully. Fallback is now active.');
    }
}
