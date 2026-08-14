<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Read a website content setting value.
     *
     * @param  string  $key  Setting key, e.g. "hero_title"
     * @param  string|null  $default  Fallback when the value is null/empty
     */
    function setting(string $key, ?string $default = null): ?string
    {
        $settings = \Illuminate\Support\Facades\Cache::rememberForever('app_settings', function () {
            return \App\Models\Setting::pluck('value', 'key')->toArray();
        });

        $value = $settings[$key] ?? null;

        if ($value === null || $value === '') {
            return $default;
        }

        return $value;
    }
}
