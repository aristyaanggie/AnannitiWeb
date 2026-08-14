<?php

namespace Database\Seeders;

use App\Models\ArtistProfile;
use Illuminate\Database\Seeder;

class ArtistProfileSeeder extends Seeder
{
    public function run(): void
    {
        ArtistProfile::updateOrCreate(
            ['slug' => 'gus-tut'],
            [
                'name' => 'Gus Tut',
                'slug' => 'gus-tut',
                'photo' => '',
                'biography' => '',
                'specialization' => '',
                'experience_years' => 0,
                'instagram' => '',
                'whatsapp' => '',
                'tiktok' => '',
                'facebook' => '',
                'location' => 'Bali, Indonesia',
                'display_order' => 1,
                'is_featured' => true,
                'is_visible' => true,
            ]
        );
    }
}
