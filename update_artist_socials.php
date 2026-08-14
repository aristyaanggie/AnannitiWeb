<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$a = App\Models\ArtistProfile::first();
if($a) {
    $a->youtube = '@anannititattoo_yt';
    $a->twitter = '@anannititattoo';
    $a->website = 'anannititattoo.com';
    $a->save();
    echo "Artist new socials updated successfully.\n";
} else {
    echo "No artist found.\n";
}
