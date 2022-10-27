<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductImage extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'image_url',
        'product_id',
    ];

    protected $hidden = [];

    protected $casts = [];
}
