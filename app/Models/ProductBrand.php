<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductBrand extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'logo',
        'product_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
