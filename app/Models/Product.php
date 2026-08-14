<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sales_format',
        'standard_unit',
        'standard_quantity',
        'standard_price',
        'individual_unit',
        'individual_price',
        'compare_price',
        'sku',
        'thumbnail',
        'stock_quantity',
        'stock_status',
        'minimum_stock',
        'published_at',
        'badge_id',
        'is_featured',
        'is_visible',
        'meta_title',
        'meta_description',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'standard_quantity' => 'integer',
            'standard_price' => 'decimal:2',
            'individual_price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'minimum_stock' => 'integer',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
            'display_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function badge(): BelongsTo
    {
        return $this->belongsTo(ProductBadge::class, 'badge_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
