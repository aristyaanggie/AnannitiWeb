<?php

namespace Database\Seeders;

use App\Models\ProductBadge;
use Illuminate\Database\Seeder;

class ProductBadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['name' => 'Best Seller', 'slug' => 'best-seller', 'background_color' => 'bg-black', 'text_color' => 'text-white'],
            ['name' => 'New', 'slug' => 'new', 'background_color' => 'bg-black', 'text_color' => 'text-white'],
            ['name' => 'Featured', 'slug' => 'featured', 'background_color' => 'bg-[#1a1a1a]', 'text_color' => 'text-white'],
            ['name' => 'Limited', 'slug' => 'limited', 'background_color' => 'bg-black', 'text_color' => 'text-white'],
            ['name' => 'Staff Pick', 'slug' => 'staff-pick', 'background_color' => 'bg-[#1a1a1a]', 'text_color' => 'text-white'],
            ['name' => 'Artist Pick', 'slug' => 'artist-pick', 'background_color' => 'bg-black', 'text_color' => 'text-white'],
        ];

        foreach ($badges as $badge) {
            ProductBadge::updateOrCreate(
                ['slug' => $badge['slug']],
                $badge
            );
        }
    }
}
