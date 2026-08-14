<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('artist_id')->nullable()->constrained('artist_profiles')->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('country', 100)->nullable();
            $table->string('tattoo_style', 100)->nullable();
            $table->integer('rating');
            $table->text('content');
            $table->string('photo')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->index('product_id');
            $table->index('artist_id');
            $table->index('is_featured');
            $table->index('rating');
            $table->index(['is_visible', 'is_featured', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
