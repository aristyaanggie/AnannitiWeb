<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PortfolioItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioService
{
    public function __construct() {}

    public function getAllPortfolios()
    {
        return PortfolioItem::with(['category', 'artist'])->orderByDesc('created_at')->get();
    }

    public function getPortfolioById(int $id)
    {
        return PortfolioItem::with(['category', 'artist'])->find($id);
    }

    public function createPortfolio(array $data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['slug'] ?? $data['title']);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            unset($data['image']);
        }

        return PortfolioItem::create($data);
    }

    public function updatePortfolio(int $id, array $data)
    {
        $portfolio = PortfolioItem::find($id);
        if (!$portfolio) {
            return null;
        }

        if (isset($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['slug'], $id);
        }

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            if ($portfolio->image) {
                $this->deleteFile($portfolio->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            unset($data['image']);
        }

        $portfolio->update($data);

        return $portfolio;
    }

    public function deletePortfolio(int $id)
    {
        $portfolio = PortfolioItem::find($id);
        if ($portfolio) {
            if ($portfolio->image) {
                $this->deleteFile($portfolio->image);
            }
            $portfolio->delete();
        }
        return $portfolio;
    }

    protected function uploadImage(UploadedFile $file): string
    {
        return $file->store('portfolio', 'public');
    }

    protected function deleteFile(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $existing = PortfolioItem::where('slug', $slug)->first();

            if (!$existing || ($ignoreId && $existing->id === $ignoreId)) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
