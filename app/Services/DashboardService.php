<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ArtistProfile;
use App\Models\Category;
use App\Models\PortfolioItem;
use App\Models\Product;
use App\Models\Review;

class DashboardService
{
    public function getStats(): array
    {
        return [
            'products' => Product::count(),
            'categories' => Category::count(),
            'portfolio' => PortfolioItem::count(),
            'artists' => ArtistProfile::count(),
            'reviews' => Review::count(),
        ];
    }
}
