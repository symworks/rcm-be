<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductOrderDetail extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'order_qty',
        'product_order_id',
        'product_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
