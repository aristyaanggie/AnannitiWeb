<?php

namespace App\Http\Controllers;

use App\Models\ArtistProfile;
use App\Models\PortfolioItem;
use App\Models\Review;
use App\Models\TattooSupply;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $reviews = Review::where('is_visible', true)
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $averageRating = Review::where('is_visible', true)->avg('rating');
        $averageRating = $averageRating ? round($averageRating, 1) : 0;

        $featuredPortfolio = PortfolioItem::with(['category', 'artist'])
            ->where('is_visible', true)
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->limit(16)
            ->get();

        $featuredArtist = ArtistProfile::where('is_featured', true)
            ->where('is_visible', true)
            ->first();

        $tattooSupplies = TattooSupply::where('is_visible', true)
            ->orderBy('display_order')
            ->get();

        return view('pages.home', [
            'title' => 'Home',
            'description' => 'Ananniti Tattoo Bali - Premium custom tattoo design studio',
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'featuredPortfolio' => $featuredPortfolio,
            'featuredArtist' => $featuredArtist,
            'tattooSupplies' => $tattooSupplies,
        ]);
    }
}
