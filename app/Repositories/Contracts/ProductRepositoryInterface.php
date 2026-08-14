<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findWithTrashed(int $id);
    public function findBySlug(string $slug);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function restore(int $id);
    public function toggleStatus(int $id);
    public function publish(int $id);
    public function unpublish(int $id);
    public function getByCategory(int $categoryId);
    public function getFeatured();
    public function getVisible();
    public function getTrashed();
}
