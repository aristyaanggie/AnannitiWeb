<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Brand
            ['key' => 'brand_name', 'value' => 'Ananniti Tattoo Bali', 'group' => 'brand', 'type' => 'text'],
            ['key' => 'logo', 'value' => null, 'group' => 'brand', 'type' => 'image'],
            ['key' => 'favicon', 'value' => null, 'group' => 'brand', 'type' => 'image'],
            ['key' => 'copyright', 'value' => '© 2026 Ananniti Tattoo Bali. All Rights Reserved.', 'group' => 'brand', 'type' => 'text'],

            // Brand Assets
            ['key' => 'hero_image', 'value' => null, 'group' => 'brand_assets', 'type' => 'image'],
            ['key' => 'about_image', 'value' => null, 'group' => 'brand_assets', 'type' => 'image'],
            ['key' => 'gallery_hero', 'value' => null, 'group' => 'brand_assets', 'type' => 'image'],
            ['key' => 'shop_hero', 'value' => null, 'group' => 'brand_assets', 'type' => 'image'],

            // Business
            ['key' => 'studio_name', 'value' => 'Ananniti Tattoo Bali', 'group' => 'business', 'type' => 'text'],
            ['key' => 'tagline', 'value' => 'Premium Custom Tattoo Design in Bali', 'group' => 'business', 'type' => 'text'],
            ['key' => 'description', 'value' => 'Professional tattoo studio in Bali with experienced artists, sterile equipment, and exceptional artistry.', 'group' => 'business', 'type' => 'textarea'],
            ['key' => 'whatsapp', 'value' => '6281234567890', 'group' => 'business', 'type' => 'text'],
            ['key' => 'business_hours', 'value' => 'Open Daily · 10:00 — 22:00 WITA', 'group' => 'business', 'type' => 'text'],
            ['key' => 'email', 'value' => 'hello@anannititattoo.com', 'group' => 'business', 'type' => 'text'],
            ['key' => 'phone', 'value' => '+62 812 3456 7890', 'group' => 'business', 'type' => 'text'],
            ['key' => 'address', 'value' => 'Jl. Raya Seminyak No. 12, Seminyak, Bali 80361', 'group' => 'business', 'type' => 'text'],
            ['key' => 'google_maps_url', 'value' => 'https://maps.google.com/?q=Ananniti+Tattoo+Bali+Seminyak', 'group' => 'business', 'type' => 'text'],

            // Social Media
            ['key' => 'instagram', 'value' => 'https://instagram.com/anannititattoo', 'group' => 'social', 'type' => 'text'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com/@anannititattoo', 'group' => 'social', 'type' => 'text'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/anannititattoo', 'group' => 'social', 'type' => 'text'],

            // SEO
            ['key' => 'meta_title', 'value' => 'Ananniti Tattoo Bali - Premium Tattoo Studio', 'group' => 'seo', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Premium custom tattoo design studio in Bali. Professional artists, sterile equipment, and exceptional artistry.', 'group' => 'seo', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
