<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_badges', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }

    public function down(): void
    {
        Schema::table('product_badges', function (Blueprint $table) {
            $table->timestamps();
        });
    }
};
