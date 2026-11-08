<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'product_name',
        'customer_name',
        'customer_address',
        'customer_country',
        'format',
        'variant',
        'quantity',
        'price',
        'total_price',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
