<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductBadge extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'background_color',
        'text_color',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'badge_id');
    }
}
