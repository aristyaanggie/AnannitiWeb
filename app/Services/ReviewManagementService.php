<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Review;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ReviewManagementService
{
    public function getStats(): array
    {
        return [
            'total' => Review::count(),
            'published' => Review::where('is_visible', true)->count(),
            'draft' => Review::where('is_visible', false)->count(),
            'featured' => Review::where('is_featured', true)->count(),
        ];
    }

    public function getAllReviews()
    {
        return Review::with(['artist'])->orderByDesc('created_at')->get();
    }

    public function getReviewById(int $id)
    {
        return Review::with(['artist'])->find($id);
    }

    public function createReview(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        } else {
            unset($data['photo']);
        }

        return Review::create($data);
    }

    public function updateReview(int $id, array $data)
    {
        $review = Review::find($id);
        if (!$review) {
            return null;
        }

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            if ($review->photo) {
                $this->deleteFile($review->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        } else {
            unset($data['photo']);
        }

        $review->update($data);

        return $review;
    }

    public function deleteReview(int $id)
    {
        $review = Review::find($id);
        if ($review) {
            if ($review->photo) {
                $this->deleteFile($review->photo);
            }
            $review->delete();
        }
        return $review;
    }

    public function toggleStatus(int $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return null;
        }

        $review->update(['is_visible' => !$review->is_visible]);

        return $review;
    }

    public function toggleFeatured(int $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return null;
        }

        $review->update(['is_featured' => !$review->is_featured]);

        return $review;
    }

    protected function uploadPhoto(UploadedFile $file): string
    {
        return $file->store('reviews', 'public');
    }

    protected function deleteFile(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
