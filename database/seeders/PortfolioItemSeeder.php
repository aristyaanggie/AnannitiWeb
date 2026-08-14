<?php

namespace Database\Seeders;

use App\Models\ArtistProfile;
use App\Models\Category;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    public function run(): void
    {
        $artist = ArtistProfile::where('slug', 'gus-tut')->first();

        $items = [
            [
                'category_slug' => 'balinese',
                'title' => 'Traditional Balinese Barong',
                'slug' => 'traditional-balinese-barong',
                'description' => 'A traditional Balinese Barong tattoo featuring intricate patterns and cultural symbolism. Hand-drawn with precision to capture the essence of Balinese heritage.',
                'image' => 'portfolio/artist-work-1.jpg',
                'tattoo_style' => 'Balinese',
                'placement' => 'Thigh',
                'session_hours' => 8,
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'category_slug' => 'oriental',
                'title' => 'Japanese Dragon Sleeve',
                'slug' => 'japanese-dragon-sleeve',
                'description' => 'Full sleeve Japanese dragon tattoo with traditional waves and cherry blossoms. Executed in the classic Japanese style with bold lines and vibrant colors.',
                'image' => 'portfolio/studio-hero.jpg',
                'tattoo_style' => 'Oriental',
                'placement' => 'Full Arm',
                'session_hours' => 16,
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'category_slug' => 'realism',
                'title' => 'Lion Portrait Realism',
                'slug' => 'lion-portrait-realism',
                'description' => 'Photorealistic lion portrait tattoo showcasing detailed fur texture and expressive eyes. A testament to precision shading and attention to detail.',
                'image' => 'portfolio/realism-1.png',
                'tattoo_style' => 'Realism',
                'placement' => 'Chest',
                'session_hours' => 10,
                'is_featured' => false,
                'display_order' => 3,
            ],
            [
                'category_slug' => 'blackwork',
                'title' => 'Geometric Blackwork Pattern',
                'slug' => 'geometric-blackwork-pattern',
                'description' => 'Intricate geometric blackwork tattoo featuring sacred geometry patterns. Solid black fills with precise line work create a stunning visual impact.',
                'image' => 'portfolio/blackwork-1.png',
                'tattoo_style' => 'Blackwork',
                'placement' => 'Forearm',
                'session_hours' => 5,
                'is_featured' => false,
                'display_order' => 4,
            ],
            [
                'category_slug' => 'fine-line',
                'title' => 'Botanical Fine Line',
                'slug' => 'botanical-fine-line',
                'description' => 'Delicate botanical tattoo with fine line technique featuring lavender and rosemary stems. Minimalist approach with elegant composition.',
                'image' => 'portfolio/fine-line-1.png',
                'tattoo_style' => 'Fine Line',
                'placement' => 'Wrist',
                'session_hours' => 3,
                'is_featured' => false,
                'display_order' => 5,
            ],
            [
                'category_slug' => 'custom-design',
                'title' => 'Custom Mandala Design',
                'slug' => 'custom-mandala-design',
                'description' => 'Custom mandala tattoo design created from scratch based on client inspiration. Symmetrical patterns with dotwork shading techniques.',
                'image' => 'portfolio/custom-1.png',
                'tattoo_style' => 'Custom Design',
                'placement' => 'Back',
                'session_hours' => 12,
                'is_featured' => true,
                'display_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            $category = Category::where('slug', $item['category_slug'])->first();

            PortfolioItem::firstOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $category?->id,
                    'artist_id' => $artist?->id,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                    'tattoo_style' => $item['tattoo_style'],
                    'placement' => $item['placement'],
                    'session_hours' => $item['session_hours'],
                    'is_featured' => $item['is_featured'],
                    'display_order' => $item['display_order'],
                    'is_visible' => true,
                ]
            );
        }
    }
}
