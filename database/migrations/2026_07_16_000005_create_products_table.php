<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('compare_price', 12, 2)->nullable();
            $table->string('sku', 100)->unique()->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'pre_order'])->default('in_stock');
            $table->integer('minimum_stock')->default(5);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('badge_id')->nullable()->constrained('product_badges')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('category_id');
            $table->index('badge_id');
            $table->index('is_visible');
            $table->index('is_featured');
            $table->index('display_order');
            $table->index('published_at');
            $table->index('stock_quantity');
            $table->index(['category_id', 'is_visible', 'display_order']);
            $table->index(['is_featured', 'is_visible', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
