<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Producer extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',

        'category_nation_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'category_nation_id' => 'integer',
    ];
}
