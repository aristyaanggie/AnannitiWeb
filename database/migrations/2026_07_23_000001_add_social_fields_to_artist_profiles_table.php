<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artist_profiles', function (Blueprint $table) {
            $table->string('whatsapp', 50)->nullable()->after('instagram');
            $table->string('tiktok', 255)->nullable()->after('whatsapp');
            $table->string('facebook', 255)->nullable()->after('tiktok');
            $table->string('location', 255)->nullable()->after('facebook');
        });
    }

    public function down(): void
    {
        Schema::table('artist_profiles', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'tiktok', 'facebook', 'location']);
        });
    }
};
