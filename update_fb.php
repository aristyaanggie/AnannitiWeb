<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$a = App\Models\ArtistProfile::first();
if($a) {
    $a->facebook = 'anannititattoo';
    $a->save();
    echo "Facebook updated successfully.\n";
} else {
    echo "No artist found.\n";
}
