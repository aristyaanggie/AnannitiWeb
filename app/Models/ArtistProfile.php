<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArtistProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'photo',
        'biography',
        'specialization',
        'experience_years',
        'instagram',
        'whatsapp',
        'tiktok',
        'facebook',
        'youtube',
        'twitter',
        'website',
        'location',
        'display_order',
        'is_featured',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'experience_years' => 'integer',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class, 'artist_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'artist_id');
    }
}
