<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Concerns\FormatsWhatsAppNumber;
use App\Models\ArtistProfile;
use App\Models\PortfolioItem;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use FormatsWhatsAppNumber;
    public function index(): View
    {
        $portfolioItems = PortfolioItem::with(['category', 'artist'])
            ->where('is_visible', true)
            ->orderByDesc('is_featured')
            ->orderByDesc('display_order')
            ->orderByDesc('created_at')
            ->get();

        $styles = $portfolioItems->pluck('tattoo_style')->filter()->unique()->values();

        return view('pages.gallery', [
            'title' => 'Gallery',
            'description' => 'Explore the tattoo artistry of Ananniti Tattoo Bali. Browse our portfolio of custom designs, styles, and masterpieces.',
            'portfolioItems' => $portfolioItems,
            'styles' => $styles,
        ]);
    }

    public function show(string $slug): View
    {
        $portfolio = PortfolioItem::with(['category', 'artist'])
            ->where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        $relatedWorks = PortfolioItem::with(['category', 'artist'])
            ->where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)
            ->where('is_visible', true)
            ->orderByDesc('is_featured')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $whatsappNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        return view('pages.portfolio-detail', [
            'title' => $portfolio->title . ' — Ananniti Tattoo',
            'description' => $portfolio->description ?: $portfolio->title . ' by ' . ($portfolio->artist?->name ?? 'Ananniti Tattoo') . ' — ' . ($portfolio->tattoo_style ?? 'Custom tattoo art'),
            'portfolio' => $portfolio,
            'relatedWorks' => $relatedWorks,
            'whatsappNumber' => $whatsappNumber,
        ]);
    }

    public function artist(string $slug): View
    {
        $artist = ArtistProfile::where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        $portfolioItems = PortfolioItem::with(['category'])
            ->where('artist_id', $artist->id)
            ->where('is_visible', true)
            ->orderByDesc('display_order')
            ->orderByDesc('created_at')
            ->get();

        $whatsappNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        return view('pages.artist-profile', [
            'title' => $artist->name . ' — Ananniti Tattoo',
            'description' => $artist->biography ?: $artist->name . ' — Professional tattoo artist at Ananniti Tattoo Bali.',
            'artist' => $artist,
            'portfolioItems' => $portfolioItems,
            'whatsappNumber' => $whatsappNumber,
        ]);
    }
}
