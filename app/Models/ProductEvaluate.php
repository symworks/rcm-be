<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductEvaluate extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'point',
        'content',

        'product_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'product_id' => 'integer',
    ];
}
