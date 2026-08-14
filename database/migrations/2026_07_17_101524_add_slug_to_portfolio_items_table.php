<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolio_items', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            if (Schema::hasColumn('portfolio_items', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
