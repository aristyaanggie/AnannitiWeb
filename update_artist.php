<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$a = App\Models\ArtistProfile::first();
if($a) {
    $a->biography = 'Gus Tut is a master tattoo artist with a profound dedication to his craft, blending traditional techniques with contemporary designs. Born and raised in Bali, his work is deeply inspired by the rich cultural heritage and spiritual artistry of the island. He specializes in intricate dotwork, mandala, and cultural realism. Every tattoo he creates is a personal journey, crafted meticulously to reflect the unique vision and story of his clients.';
    $a->specialization = 'Balinese Ornament, Realism & Blackwork';
    $a->experience_years = 12;
    $a->instagram = '@anannititattoo';
    $a->whatsapp = '6281234567890';
    $a->save();
    echo "Artist updated successfully.\n";
} else {
    echo "No artist found.\n";
}
