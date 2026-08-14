<?php

return [
    'studio' => [
        'name' => env('STUDIO_NAME', '[TO BE DEFINED] Studio Name'),
        'tagline' => env('STUDIO_TAGLINE', '[TO BE DEFINED] Premium custom tattoo design in Bali'),
        'description' => env('STUDIO_DESCRIPTION', '[TO BE DEFINED] Professional tattoo studio description'),
    ],

    'contact' => [
        'email' => env('STUDIO_EMAIL', '[TO BE DEFINED] email@example.com'),
        'phone' => env('STUDIO_PHONE', '[TO BE DEFINED] +62 XXX XXX XXXX'),
        'whatsapp' => env('STUDIO_WHATSAPP', '[TO BE DEFINED] +62 XXX XXX XXXX'),
        'address' => env('STUDIO_ADDRESS', '[TO BE DEFINED] Bali, Indonesia'),
        'city' => env('STUDIO_CITY', '[TO BE DEFINED] Bali'),
        'postal_code' => env('STUDIO_POSTAL_CODE', '[TO BE DEFINED] 80000'),
    ],

    'social' => [
        'instagram' => env('STUDIO_INSTAGRAM', '[TO BE DEFINED] @ananniti_tattoo'),
        'facebook' => env('STUDIO_FACEBOOK', '[TO BE DEFINED] https://facebook.com/ananniti'),
        'tiktok' => env('STUDIO_TIKTOK', '[TO BE DEFINED] @ananniti_tattoo'),
        'youtube' => env('STUDIO_YOUTUBE', '[TO BE DEFINED] https://youtube.com/@ananniti'),
    ],

    'hours' => [
        'monday' => env('STUDIO_HOURS_MON', '[TO BE DEFINED] 10:00 - 18:00'),
        'tuesday' => env('STUDIO_HOURS_TUE', '[TO BE DEFINED] 10:00 - 18:00'),
        'wednesday' => env('STUDIO_HOURS_WED', '[TO BE DEFINED] 10:00 - 18:00'),
        'thursday' => env('STUDIO_HOURS_THU', '[TO BE DEFINED] 10:00 - 18:00'),
        'friday' => env('STUDIO_HOURS_FRI', '[TO BE DEFINED] 10:00 - 18:00'),
        'saturday' => env('STUDIO_HOURS_SAT', '[TO BE DEFINED] 10:00 - 18:00'),
        'sunday' => env('STUDIO_HOURS_SUN', '[TO BE DEFINED] Closed'),
    ],

    'maps' => [
        'google_maps_url' => env('STUDIO_GOOGLE_MAPS', '[TO BE DEFINED] https://maps.google.com/?q=Bali'),
        'latitude' => env('STUDIO_LATITUDE', '[TO BE DEFINED] -8.6500'),
        'longitude' => env('STUDIO_LONGITUDE', '[TO BE DEFINED] 115.2167'),
    ],

    'payment' => [
        'currency' => env('STUDIO_CURRENCY', 'IDR'),
        'currency_symbol' => env('STUDIO_CURRENCY_SYMBOL', 'Rp'),
    ],
];
