<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PriceRange extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'min_price',
        'max_price',
        'product_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
