<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductTag extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'product_id',
        'category_product_tag_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'product_id' => 'integer',
        'category_product_tag_id' => 'integer',
    ];
}
