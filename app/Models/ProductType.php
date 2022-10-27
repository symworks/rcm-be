<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductType extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable =[
        'id',
        'name',
        'ui_icon',
        'is_active',
    ];
}
