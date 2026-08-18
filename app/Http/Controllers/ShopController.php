<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Concerns\FormatsWhatsAppNumber;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    use FormatsWhatsAppNumber;
    public function __construct(
        protected ProductService $productService,
    ) {}

    public function index(): View
    {
        $categories = Category::where('type', 'product')
            ->where('is_visible', true)
            ->orderBy('display_order')
            ->get();

        $productsByCategory = [];

        foreach ($categories as $category) {
            $productsByCategory[$category->id] = Product::with(['badge'])
                ->where('category_id', $category->id)
                ->where('is_visible', true)
                ->orderByDesc('display_order')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('pages.shop', [
            'title' => 'Shop',
            'description' => 'Discover professional tattoo equipment, premium supplies, and studio essentials carefully selected by Ananniti Tattoo.',
            'categories' => $categories,
            'productsByCategory' => $productsByCategory,
        ]);
    }

    public function category(string $category): View
    {
        $categoryModel = Category::where('slug', $category)->where('type', 'product')->firstOrFail();

        $products = Product::with(['category', 'badge'])
            ->where('category_id', $categoryModel->id)
            ->where('is_visible', true)
            ->orderByDesc('display_order')
            ->orderByDesc('created_at')
            ->get();

        $whatsappNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        return view('pages.shop-category', [
            'title' => $categoryModel->name,
            'description' => 'Professional ' . $categoryModel->name . ' equipment carefully selected by Ananniti Tattoo.',
            'category' => $categoryModel,
            'products' => $products,
            'whatsappNumber' => $whatsappNumber,
        ]);
    }

    public function show(string $slug): View
    {
        $product = Product::with(['category', 'badge', 'galleries'])
            ->where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        $relatedProducts = Product::with(['category', 'badge'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $whatsappNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        return view('pages.shop-detail', [
            'title' => $product->meta_title ?: $product->name,
            'description' => $product->meta_description ?: $product->short_description ?: Str::limit(strip_tags($product->description), 160),
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'whatsappNumber' => $whatsappNumber,
        ]);
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string',
            'customer_name' => 'required|string',
            'customer_country' => 'required|string',
            'format' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $validated['total_price'] = $validated['price'] * $validated['quantity'];

        Order::create($validated);

        // Build WhatsApp Message
        $whatsappNumber = setting('whatsapp', '6281234567890');
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);

        $currency = config('ananniti.payment.currency_symbol', 'Rp');
        $priceFormatted = number_format((float) $validated['price'], 0, ',', '.');
        
        $formatText = $validated['format'] ?? 'Standard';

        $message = "━━━━━━━━━━━━━━━━━━━━━━\n\nPRODUCT INQUIRY\n\n━━━━━━━━━━━━━━━━━━━━━━\n\nPRODUCT\n" .
                   "{$validated['product_name']}\n" .
                   "Format: {$formatText}\n" .
                   "{$currency} {$priceFormatted}\n" .
                   "Quantity : {$validated['quantity']}\n\n" .
                   "━━━━━━━━━━━━━━━━━━━━━━\n\nCUSTOMER\n" .
                   "Name: {$validated['customer_name']}\n" .
                   "Country: {$validated['customer_country']}\n\n" .
                   "━━━━━━━━━━━━━━━━━━━━━━\n\nMESSAGE\n" .
                   "I would like to ask about availability and shipping for this product.\n\n" .
                   "━━━━━━━━━━━━━━━━━━━━━━\n\nSent from\nAnanniti Tattoo Bali Website";

        $url = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($message);

        return redirect()->away($url);
    }
}
