<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdsCampaign extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'title',
        'original',
        'thumbnail',
        'link_to_campaign',
        'is_active'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
