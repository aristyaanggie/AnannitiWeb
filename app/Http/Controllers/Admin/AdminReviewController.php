<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\ArtistProfile;
use App\Models\Review;
use App\Services\ReviewManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    public function __construct(
        protected ReviewManagementService $reviewService,
    ) {}

    public function index(): View
    {
        $reviews = $this->reviewService->getAllReviews();

        $stats = [
            'total' => Review::count(),
            'published' => Review::where('is_visible', true)->count(),
            'draft' => Review::where('is_visible', false)->count(),
            'featured' => Review::where('is_featured', true)->count(),
        ];

        return view('admin.reviews.index', [
            'pageTitle' => 'Reviews',
            'reviews' => $reviews,
            'stats' => $stats,
        ]);
    }

    public function create(): View
    {
        $artist = ArtistProfile::first();

        return view('admin.reviews.form', [
            'pageTitle' => 'Add Review',
            'review' => null,
            'artistId' => $artist?->id,
        ]);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $artist = ArtistProfile::first();
        if ($artist && empty($data['artist_id'])) {
            $data['artist_id'] = $artist->id;
        }

        $this->reviewService->createReview($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.form', [
            'pageTitle' => 'Edit Review',
            'review' => $review,
            'artistId' => $review->artist_id,
        ]);
    }

    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        $data = $request->validated();

        $artist = ArtistProfile::first();
        if ($artist && empty($data['artist_id'])) {
            $data['artist_id'] = $artist->id;
        }

        $this->reviewService->updateReview($review->id, $data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->reviewService->deleteReview($review->id);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted.');
    }

    public function toggleStatus(Review $review): RedirectResponse
    {
        $this->reviewService->toggleStatus($review->id);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review status updated.');
    }

    public function toggleFeatured(Review $review): RedirectResponse
    {
        $this->reviewService->toggleFeatured($review->id);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review featured status updated.');
    }
}
