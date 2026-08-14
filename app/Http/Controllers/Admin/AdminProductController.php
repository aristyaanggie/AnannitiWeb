<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBadge;
use App\Models\TattooSupply;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
    ) {}

    public function index(): View
    {
        $activeTab = request('tab', 'products') === 'supplies' ? 'supplies' : 'products';

        $products = Product::with('category', 'badge')
            ->orderByDesc('updated_at')
            ->get();

        $stats = [
            'total' => Product::count(),
            'published' => Product::where('is_visible', true)->count(),
            'draft' => Product::where('is_visible', false)->count(),
            'low_stock' => Product::whereColumn('stock_quantity', '<', 'minimum_stock')->count(),
            'trash' => Product::onlyTrashed()->count(),
        ];

        $supplies = TattooSupply::orderBy('display_order')
            ->orderBy('title')
            ->get();

        $supplyStats = [
            'total' => TattooSupply::count(),
            'visible' => TattooSupply::where('is_visible', true)->count(),
            'hidden' => TattooSupply::where('is_visible', false)->count(),
        ];

        return view('admin.products.index', [
            'pageTitle' => 'Products',
            'activeTab' => $activeTab,
            'products' => $products,
            'stats' => $stats,
            'supplies' => $supplies,
            'supplyStats' => $supplyStats,
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', [
            'pageTitle' => 'Add Product',
            'product' => null,
            'categories' => Category::where('type', 'product')->orderBy('display_order')->get(),
            'badges' => ProductBadge::orderBy('name')->get(),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->productService->createProduct($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', [
            'pageTitle' => 'Edit Product',
            'product' => $product,
            'categories' => Category::where('type', 'product')->orderBy('display_order')->get(),
            'badges' => ProductBadge::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $this->productService->updateProduct($product->id, $data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product->id);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product moved to trash.');
    }

    public function restore(int $id): RedirectResponse
    {
        $this->productService->restoreProduct($id);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product restored successfully.');
    }

    public function toggleStatus(Product $product): RedirectResponse
    {
        $this->productService->toggleProductStatus($product->id);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product status updated.');
    }

    public function destroyGalleryImage(int $id)
    {
        $deleted = $this->productService->deleteGalleryImage($id);

        if (request()->expectsJson()) {
            return response()->json(['success' => $deleted]);
        }

        return redirect()->back()
            ->with('success', 'Gallery image deleted.');
    }
}
