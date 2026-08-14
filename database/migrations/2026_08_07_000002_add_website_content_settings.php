<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Sprint C1 — Website Content settings.
     * Nilai default = teks hardcoded yang sekarang ada di halaman publik,
     * supaya tampilan tetap sama sebelum admin mengubahnya.
     */
    public function up(): void
    {
        $content = [
            // Hero
            ['key' => 'hero_eyebrow', 'value' => 'Est. MMXII — Bali, Indonesia', 'group' => 'content'],
            ['key' => 'hero_badge', 'value' => 'Premium Tattoo Studio', 'group' => 'content'],
            ['key' => 'hero_title', 'value' => 'Bring Your Tattoo Vision to Life', 'group' => 'content'],
            ['key' => 'hero_subtitle', 'value' => 'Every design is a collaboration. Every tattoo, a masterpiece crafted with precision and care.', 'group' => 'content'],
            ['key' => 'hero_primary_button', 'value' => 'Discuss Your Tattoo Idea', 'group' => 'content'],
            ['key' => 'hero_secondary_button', 'value' => 'View Our Works', 'group' => 'content'],

            // About
            ['key' => 'about_badge', 'value' => 'About Ananniti', 'group' => 'content'],
            ['key' => 'about_title', 'value' => 'Crafted with Precision, Built on Trust', 'group' => 'content'],
            ['key' => 'about_description', 'value' => 'We believe every tattoo is a story waiting to be told. With over a decade of combined experience, our team brings your vision to life using premium techniques and the highest safety standards.', 'group' => 'content'],

            // Services
            ['key' => 'services_badge', 'value' => 'How We Serve You', 'group' => 'content'],
            ['key' => 'services_title', 'value' => 'Choose Your Experience', 'group' => 'content'],

            // Supply (Shop section on home page)
            ['key' => 'supply_badge', 'value' => 'Tattoo Supply', 'group' => 'content'],
            ['key' => 'supply_title', 'value' => 'Professional Equipment', 'group' => 'content'],

            // Portfolio (Gallery section)
            ['key' => 'portfolio_badge', 'value' => 'Portfolio', 'group' => 'content'],
            ['key' => 'portfolio_title', 'value' => 'CHECK MY GALLERY:', 'group' => 'content'],

            // Artist
            ['key' => 'artist_badge', 'value' => 'Featured Artist', 'group' => 'content'],
            ['key' => 'artist_title', 'value' => 'Meet the Artist', 'group' => 'content'],

            // Consultation
            ['key' => 'consultation_title', 'value' => "Let's Create Something Meaningful Together", 'group' => 'content'],
            ['key' => 'consultation_description', 'value' => "Whether it's your first tattoo or your next masterpiece, we're here to help you shape every detail.", 'group' => 'content'],
            ['key' => 'consultation_button', 'value' => 'Discuss Your Tattoo Idea', 'group' => 'content'],

            // Footer
            ['key' => 'footer_brand', 'value' => 'Ananniti Tattoo Bali', 'group' => 'content'],
            ['key' => 'footer_copyright', 'value' => 'Ananniti Tattoo Bali. All Rights Reserved.', 'group' => 'content'],
        ];

        foreach ($content as $row) {
            DB::table('settings')->updateOrInsert(
                ['key' => $row['key']],
                [
                    'value' => $row['value'],
                    'group' => $row['group'],
                    'type' => 'text',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        $keys = [
            'hero_eyebrow', 'hero_badge', 'hero_title', 'hero_subtitle',
            'hero_primary_button', 'hero_secondary_button',
            'about_badge', 'about_title', 'about_description',
            'services_badge', 'services_title',
            'supply_badge', 'supply_title',
            'portfolio_badge', 'portfolio_title',
            'artist_badge', 'artist_title',
            'consultation_title', 'consultation_description', 'consultation_button',
            'footer_brand', 'footer_copyright',
        ];

        DB::table('settings')->whereIn('key', $keys)->delete();
    }
};
