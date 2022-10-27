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
        'average_evaluation',
        'total_evaluation',
        'product_type_id',
        'product_type_name',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
