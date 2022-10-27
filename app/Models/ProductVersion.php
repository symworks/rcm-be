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
        'official_price',
        'origin_price',
        'is_default',
        'product_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
