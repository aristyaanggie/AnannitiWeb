<?php

namespace Database\Seeders;

use App\Models\TattooSupply;
use Illuminate\Database\Seeder;

class TattooSupplySeeder extends Seeder
{
    public function run(): void
    {
        $supplies = [
            [
                'title' => 'Tattoo Machine',
                'subtitle' => 'Precision instruments for every style',
                'image' => 'ananniti photo/machine/Flux Max/spark machine.webp',
                'link' => '/shop#cat-tattoo-machine',
                'display_order' => 1,
                'is_visible' => true,
            ],
            [
                'title' => 'Tattoo Ink',
                'subtitle' => 'Rich pigmentation, lasting results',
                'image' => 'ananniti photo/ink_tinta/spark warna warni/thubnail spark 1oz.png',
                'link' => '/shop#cat-tattoo-ink',
                'display_order' => 2,
                'is_visible' => true,
            ],
            [
                'title' => 'Tattoo Needle',
                'subtitle' => 'Sterile, professional grade',
                'image' => 'ananniti photo/cartridge_jarum/thumbnail.png',
                'link' => '/shop#cat-needle',
                'display_order' => 3,
                'is_visible' => true,
            ],
            [
                'title' => 'Kit Set',
                'subtitle' => 'Complete starter kits',
                'image' => 'ananniti photo/tattoo kit/ambition/Thubnail.png',
                'link' => '/shop#cat-tattoo-kit',
                'display_order' => 4,
                'is_visible' => true,
            ],
            [
                'title' => 'Furniture',
                'subtitle' => 'Studio essentials',
                'image' => 'ananniti photo/furrniture/kursi/kursi tattoo.png',
                'link' => '/shop#cat-furniture',
                'display_order' => 5,
                'is_visible' => true,
            ],
            [
                'title' => 'View All',
                'subtitle' => 'Explore everything',
                'image' => 'ananniti photo/stencil/Spark.png',
                'link' => '/shop',
                'display_order' => 6,
                'is_visible' => true,
            ],
        ];

        foreach ($supplies as $index => $supply) {
            TattooSupply::updateOrCreate(
                ['title' => $supply['title']],
                $supply
            );
        }
    }
}
