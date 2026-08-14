<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductGallery;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    ) {}

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function getProductBySlug(string $slug)
    {
        return $this->productRepository->findBySlug($slug);
    }

    public function createProduct(array $data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['slug'] ?? $data['name']);

        if (isset($data['status'])) {
            $data['is_visible'] = $data['status'] === 'publish';
            unset($data['status']);
        }

        $data = $this->sanitizeSalesFormatData($data);

        // Handle thumbnail upload
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            $data['thumbnail'] = $this->uploadThumbnail($data['thumbnail']);
        } else {
            unset($data['thumbnail']);
        }

        // Handle gallery upload
        $galleryFiles = $data['gallery'] ?? null;
        unset($data['gallery']);

        $product = $this->productRepository->create($data);

        // Upload gallery images
        if ($galleryFiles) {
            $this->uploadGalleryImages($product->id, $galleryFiles);
        }

        return $product;
    }

    public function updateProduct(int $id, array $data)
    {
        if (isset($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['slug'], $id);
        }

        if (isset($data['status'])) {
            $data['is_visible'] = $data['status'] === 'publish';
            unset($data['status']);
        }

        $data = $this->sanitizeSalesFormatData($data);

        // Handle thumbnail upload
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            $product = $this->productRepository->find($id);
            if ($product && $product->thumbnail) {
                $this->deleteFile($product->thumbnail);
            }
            $data['thumbnail'] = $this->uploadThumbnail($data['thumbnail']);
        } else {
            unset($data['thumbnail']);
        }

        // Handle gallery upload
        $galleryFiles = $data['gallery'] ?? null;
        unset($data['gallery']);

        $product = $this->productRepository->update($id, $data);

        // Upload new gallery images
        if ($galleryFiles) {
            $this->uploadGalleryImages($id, $galleryFiles);
        }

        return $product;
    }

    public function deleteProduct(int $id)
    {
        $product = $this->productRepository->find($id);
        if ($product) {
            if ($product->thumbnail) {
                $this->deleteFile($product->thumbnail);
            }

            foreach ($product->galleries as $gallery) {
                $this->deleteFile($gallery->image);
                $gallery->delete();
            }

            $this->productRepository->delete($id);
        }
        return $product;
    }

    public function restoreProduct(int $id)
    {
        $product = $this->productRepository->findWithTrashed($id);
        if ($product) {
            $this->productRepository->restore($id);
            return $this->productRepository->find($id);
        }
        return null;
    }

    public function toggleProductStatus(int $id)
    {
        $product = $this->productRepository->find($id);
        if ($product) {
            $this->productRepository->toggleStatus($id);
            return $this->productRepository->find($id);
        }
        return null;
    }

    public function publishProduct(int $id)
    {
        return $this->productRepository->publish($id);
    }

    public function unpublishProduct(int $id)
    {
        return $this->productRepository->unpublish($id);
    }

    public function getProductsByCategory(int $categoryId)
    {
        return $this->productRepository->getByCategory($categoryId);
    }

    public function getFeaturedProducts()
    {
        return $this->productRepository->getFeatured();
    }

    public function getVisibleProducts()
    {
        return $this->productRepository->getVisible();
    }

    public function getTrashedProducts()
    {
        return $this->productRepository->getTrashed();
    }

    public function deleteGalleryImage(int $galleryId): bool
    {
        $gallery = ProductGallery::find($galleryId);
        if ($gallery) {
            $this->deleteFile($gallery->image);
            $gallery->delete();
            return true;
        }
        return false;
    }

    protected function uploadThumbnail(\Illuminate\Http\UploadedFile $file): string
    {
        return $file->store('products', 'public');
    }

    protected function uploadGalleryImages(int $productId, array $files): void
    {
        foreach ($files as $index => $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $path = $file->store('products/gallery', 'public');
                ProductGallery::create([
                    'product_id' => $productId,
                    'image' => $path,
                    'display_order' => $index,
                    'is_primary' => false,
                ]);
            }
        }
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
            $existing = $this->productRepository->findBySlug($slug);

            if (!$existing || ($ignoreId && $existing->id === $ignoreId)) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function sanitizeSalesFormatData(array $data): array
    {
        if (isset($data['sales_format'])) {
            if ($data['sales_format'] === 'standard') {
                $data['individual_unit'] = null;
                $data['individual_price'] = null;
            } elseif ($data['sales_format'] === 'individual') {
                $data['standard_unit'] = null;
                $data['standard_quantity'] = null;
                $data['standard_price'] = null;
            }
        }
        return $data;
    }
}
