<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('service');
            $table->string('tattoo_style');
            $table->string('budget');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('placement')->nullable();
            $table->string('size')->nullable();
            $table->string('preferred_date')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('hotel')->nullable();
            $table->text('address')->nullable();
            $table->text('maps')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('has_reference')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
