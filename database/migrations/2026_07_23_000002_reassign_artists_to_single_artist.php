<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $firstArtist = DB::table('artist_profiles')->first();

        if (!$firstArtist) {
            return;
        }

        // Reassign all portfolio_items to the first artist
        DB::table('portfolio_items')
            ->where('artist_id', '!=', $firstArtist->id)
            ->orWhereNull('artist_id')
            ->update(['artist_id' => $firstArtist->id]);

        // Reassign all reviews to the first artist
        DB::table('reviews')
            ->where('artist_id', '!=', $firstArtist->id)
            ->orWhereNull('artist_id')
            ->update(['artist_id' => $firstArtist->id]);

        // Remove all other artists
        DB::table('artist_profiles')
            ->where('id', '!=', $firstArtist->id)
            ->delete();

        // Ensure the remaining artist is featured
        DB::table('artist_profiles')
            ->where('id', $firstArtist->id)
            ->update(['is_featured' => true]);
    }

    public function down(): void
    {
        // This migration is irreversible — artists were deleted
    }
};
