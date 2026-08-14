<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Product categories
            ['name' => 'Tattoo Machine', 'slug' => 'tattoo-machine', 'type' => 'product', 'image' => 'ananniti photo/machine/Flux Max/spark machine.webp', 'display_order' => 1, 'is_visible' => true],
            ['name' => 'Tattoo Ink', 'slug' => 'tattoo-ink', 'type' => 'product', 'image' => 'ananniti photo/ink_tinta/spark warna warni/thubnail spark 1oz.png', 'display_order' => 2, 'is_visible' => true],
            ['name' => 'Needle', 'slug' => 'needle', 'type' => 'product', 'image' => 'ananniti photo/cartridge_jarum/thumbnail.png', 'display_order' => 3, 'is_visible' => true],
            ['name' => 'Tattoo Kit', 'slug' => 'tattoo-kit', 'type' => 'product', 'image' => 'ananniti photo/tattoo kit/ambition/Thubnail.png', 'display_order' => 4, 'is_visible' => true],
            ['name' => 'Furniture', 'slug' => 'furniture', 'type' => 'product', 'image' => 'ananniti photo/furrniture/kursi/kursi tattoo.png', 'display_order' => 5, 'is_visible' => true],
            ['name' => 'Others', 'slug' => 'others', 'type' => 'product', 'image' => 'ananniti photo/stencil/Spark.png', 'display_order' => 6, 'is_visible' => true],
            // Gallery categories
            ['name' => 'Balinese', 'slug' => 'balinese', 'type' => 'gallery', 'display_order' => 1, 'is_visible' => true],
            ['name' => 'Oriental', 'slug' => 'oriental', 'type' => 'gallery', 'display_order' => 2, 'is_visible' => true],
            ['name' => 'Realism', 'slug' => 'realism', 'type' => 'gallery', 'display_order' => 3, 'is_visible' => true],
            ['name' => 'Blackwork', 'slug' => 'blackwork', 'type' => 'gallery', 'display_order' => 4, 'is_visible' => true],
            ['name' => 'Fine Line', 'slug' => 'fine-line', 'type' => 'gallery', 'display_order' => 5, 'is_visible' => true],
            ['name' => 'Custom Design', 'slug' => 'custom-design', 'type' => 'gallery', 'display_order' => 6, 'is_visible' => true],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
