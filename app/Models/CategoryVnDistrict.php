<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CategoryVnDistrict extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'id',
        'code',
        'name',
        'category_vn_province_id',
    ];
}
