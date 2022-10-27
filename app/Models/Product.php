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
        'product_info',
        'is_trending',
        'average_evaluation',
        'total_evaluation',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',

        'product_type_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
