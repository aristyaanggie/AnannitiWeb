<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type', 50);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('image')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->index('section_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
