<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        protected Product $model,
    ) {}

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findWithTrashed(int $id)
    {
        return $this->model->withTrashed()->find($id);
    }

    public function findBySlug(string $slug)
    {
        return $this->model->withTrashed()->where('slug', $slug)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function delete(int $id)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->delete();
        }
        return $product;
    }

    public function restore(int $id)
    {
        $product = $this->model->withTrashed()->find($id);
        if ($product) {
            $product->restore();
        }
        return $product;
    }

    public function toggleStatus(int $id)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update([
                'is_visible' => !$product->is_visible,
            ]);
        }
        return $product;
    }

    public function publish(int $id)
    {
        return $this->update($id, [
            'is_visible' => true,
            'published_at' => now(),
        ]);
    }

    public function unpublish(int $id)
    {
        return $this->update($id, [
            'is_visible' => false,
        ]);
    }

    public function getByCategory(int $categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }

    public function getFeatured()
    {
        return $this->model->where('is_featured', true)->get();
    }

    public function getVisible()
    {
        return $this->model->where('is_visible', true)->get();
    }

    public function getTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }
}
