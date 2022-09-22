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
        'title',
        'top_features',
        'description',
        'is_discount',
        'is_trending',
        'origin_price',
        'official_price',
        'average_evaluation',
        'total_evaluation',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',

        'producer_id',
        'product_brand_id',
        'category_currency_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_discount' => 'boolean',
        'is_trending' => 'boolean',

        'product_id' => 'integer',
        'product_brand_id' => 'integer',
        'category_currency_id' => 'integer',
    ];
}
