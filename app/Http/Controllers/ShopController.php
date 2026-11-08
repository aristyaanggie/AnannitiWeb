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
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:1000',
            'variant' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'format' => 'nullable|string|max:100',
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
        $totalFormatted = number_format((float) $validated['total_price'], 0, ',', '.');
        
        $formatText = $validated['format'] ?? 'Standard';
        $variantText = !empty($validated['variant']) ? $validated['variant'] : '-';
        $notesText = !empty($validated['notes']) ? $validated['notes'] : '-';

        $divider = "----------------------------------------";

        $message = "{$divider}\n" .
                   "*ORDER / PRODUCT INQUIRY*\n" .
                   "{$divider}\n\n" .
                   "*PRODUCT DETAILS*\n" .
                   "Product : {$validated['product_name']}\n" .
                   "Choice / Color : {$variantText}\n" .
                   "Format : {$formatText}\n" .
                   "Price : {$currency} {$priceFormatted}\n" .
                   "Quantity : {$validated['quantity']}\n" .
                   "Total : {$currency} {$totalFormatted}\n\n" .
                   "{$divider}\n" .
                   "*CUSTOMER*\n" .
                   "Name : {$validated['customer_name']}\n" .
                   "Address : {$validated['customer_address']}\n\n" .
                   "{$divider}\n" .
                   "*NOTES*\n" .
                   "{$notesText}\n\n" .
                   "{$divider}\n" .
                   "Sent from: Ananniti Tattoo Bali Website";

        $url = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($message);

        return redirect()->away($url);
    }
}
