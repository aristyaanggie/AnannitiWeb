<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->where('key', 'whatsapp')->update(['group' => 'business']);
        DB::table('settings')->where('key', 'google_maps_url')->update(['group' => 'business']);

        $whatsapp = DB::table('settings')->where('key', 'whatsapp')->value('value');
        if ($whatsapp && preg_match('/[0-9]+/', $whatsapp, $matches)) {
            DB::table('settings')->where('key', 'whatsapp')->update(['value' => $matches[0]]);
        }
    }

    public function down(): void
    {
        DB::table('settings')->where('key', 'whatsapp')->update(['group' => 'social']);
        DB::table('settings')->where('key', 'google_maps_url')->update(['group' => 'seo']);
    }
};
