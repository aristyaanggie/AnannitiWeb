<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('display_order')
            ->orderBy('name')
            ->get();

        $stats = [
            'total' => Category::count(),
            'product' => Category::where('type', 'product')->count(),
            'gallery' => Category::where('type', 'gallery')->count(),
            'hidden' => Category::where('is_visible', false)->count(),
        ];

        return view('admin.category.index', [
            'pageTitle' => 'Categories',
            'categories' => $categories,
            'stats' => $stats,
        ]);
    }

    public function create(): View
    {
        return view('admin.category.form', [
            'pageTitle' => 'Add Category',
            'category' => null,
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        } else {
            $data['slug'] = $this->generateUniqueSlug($data['slug']);
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('categories', 'public');
        } else {
            unset($data['image']);
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.category.form', [
            'pageTitle' => 'Edit Category',
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['slug'], $category->id);
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $data['image']->store('categories', 'public');
        } else {
            unset($data['image']);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category "' . $category->name . '". It is still used by ' . $category->products()->count() . ' product(s). Remove or reassign the products first.');
        }

        if ($category->portfolioItems()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category "' . $category->name . '". It is still used by ' . $category->portfolioItems()->count() . ' portfolio item(s). Remove or reassign the items first.');
        }

        if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    protected function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $existing = Category::where('slug', $slug)->first();

            if (!$existing || ($ignoreId && $existing->id === $ignoreId)) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
