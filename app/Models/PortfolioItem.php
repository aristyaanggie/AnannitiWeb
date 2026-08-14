<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'artist_id',
        'title',
        'slug',
        'description',
        'image',
        'tattoo_style',
        'placement',
        'session_hours',
        'is_featured',
        'display_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'session_hours' => 'integer',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(ArtistProfile::class, 'artist_id');
    }
}
