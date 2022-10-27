<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductVersion extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'origin_price',
        'official_price',
        'default_image',
        'instock_qty',
        'sold_qty',
        'busy_qty',
        'product_id',
        'product_name',
        'product_type_id',
        'product_type_name',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
