<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('sales_format', ['standard', 'individual', 'both'])->default('standard')->after('short_description');
            $table->string('standard_unit', 50)->nullable()->after('sales_format');
            $table->integer('standard_quantity')->nullable()->after('standard_unit');
            $table->decimal('standard_price', 12, 2)->nullable()->after('standard_quantity');
            $table->string('individual_unit', 50)->nullable()->after('standard_price');
            $table->decimal('individual_price', 12, 2)->nullable()->after('individual_unit');
        });

        // Migrate existing data safely
        DB::table('products')->update([
            'sales_format' => 'standard',
            'standard_unit' => 'Unit',
            'standard_quantity' => 1,
            'standard_price' => DB::raw('price')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'sales_format',
                'standard_unit',
                'standard_quantity',
                'standard_price',
                'individual_unit',
                'individual_price'
            ]);
        });
    }
};
