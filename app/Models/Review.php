<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'artist_id',
        'name',
        'country',
        'tattoo_style',
        'rating',
        'content',
        'photo',
        'is_featured',
        'display_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(ArtistProfile::class, 'artist_id');
    }
}
