<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('artist_id')->nullable()->constrained('artist_profiles')->nullOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('tattoo_style', 100)->nullable();
            $table->string('placement', 100)->nullable();
            $table->integer('session_hours')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->index('category_id');
            $table->index('artist_id');
            $table->index('is_featured');
            $table->index('display_order');
            $table->index(['category_id', 'is_visible', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
