<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'top_features',
        'description',
        'is_discount',
        'is_trending',
        'origin_price',
        'official_price',
        'average_evaluation',
        'total_evaluation',
        'instock_qty',
        'handling_qty',
        'sold_qty',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',

        'producer_id',
        'category_currency_id',
        'category_product_id',
        'category_product_type_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_discount' => 'boolean',
        'is_trending' => 'boolean',
    ];
}
