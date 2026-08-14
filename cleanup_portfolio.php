<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$items = App\Models\PortfolioItem::all();
$deleted = 0;
foreach ($items as $item) {
    if (!Illuminate\Support\Facades\Storage::disk('public')->exists($item->image)) {
        $item->delete();
        echo "Deleted missing image row: " . $item->image . "\n";
        $deleted++;
    }
}
echo "Total deleted: " . $deleted . "\n";
