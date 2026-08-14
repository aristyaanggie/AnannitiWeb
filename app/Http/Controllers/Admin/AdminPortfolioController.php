<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\ArtistProfile;
use App\Models\Category;
use App\Models\PortfolioItem;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $portfolioService,
    ) {}

    public function index(): View
    {
        $portfolios = $this->portfolioService->getAllPortfolios();

        $stats = [
            'total' => PortfolioItem::count(),
            'featured' => PortfolioItem::where('is_featured', true)->count(),
            'hidden' => PortfolioItem::where('is_visible', false)->count(),
            'newest' => PortfolioItem::latest()->first()?->created_at?->diffForHumans() ?? '—',
        ];

        return view('admin.portfolio.index', [
            'pageTitle' => 'Portfolio',
            'portfolios' => $portfolios,
            'stats' => $stats,
        ]);
    }

    public function create(): View
    {
        $artist = ArtistProfile::first();

        return view('admin.portfolio.form', [
            'pageTitle' => 'Add Portfolio Item',
            'portfolio' => null,
            'artistId' => $artist?->id,
            'categories' => Category::where('type', 'gallery')->orderBy('display_order')->get(),
        ]);
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $artist = ArtistProfile::first();
        if ($artist && empty($data['artist_id'])) {
            $data['artist_id'] = $artist->id;
        }

        $this->portfolioService->createPortfolio($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item created successfully.');
    }

    public function edit(PortfolioItem $portfolio): View
    {
        return view('admin.portfolio.form', [
            'pageTitle' => 'Edit Portfolio Item',
            'portfolio' => $portfolio,
            'artistId' => $portfolio->artist_id,
            'categories' => Category::where('type', 'gallery')->orderBy('display_order')->get(),
        ]);
    }

    public function update(UpdatePortfolioRequest $request, PortfolioItem $portfolio): RedirectResponse
    {
        $data = $request->validated();

        $artist = ArtistProfile::first();
        if ($artist && empty($data['artist_id'])) {
            $data['artist_id'] = $artist->id;
        }

        $this->portfolioService->updatePortfolio($portfolio->id, $data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(PortfolioItem $portfolio): RedirectResponse
    {
        $this->portfolioService->deletePortfolio($portfolio->id);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item deleted.');
    }
}
