<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductColorQty extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'id',
        'name',
        'instock_qty',
        'sold_qty',
        'busy_qty',
        'product_version_id',
        'product_version_name',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        
    ];
}
