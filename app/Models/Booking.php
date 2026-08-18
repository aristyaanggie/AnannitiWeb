<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'country',
        'service',
        'tattoo_style',
        'budget',
        'phone',
        'email',
        'placement',
        'size',
        'preferred_date',
        'preferred_time',
        'hotel',
        'address',
        'maps',
        'notes',
        'has_reference',
    ];
    
    protected $casts = [
        'has_reference' => 'boolean',
    ];
}
