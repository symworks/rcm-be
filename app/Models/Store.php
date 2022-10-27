<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'id',
        'name',
        'province_address_id',
        'province_address_name',
        'district_address_id',
        'district_address_name',
        'ward_address_id',
        'ward_address_name',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
