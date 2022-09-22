<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductComment extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'content',
        'is_hidden',

        'commented_by_id',
        'product_id',
        'product_comment_id',
    ];

    protected $hidden = [
        'deps',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'commented_by_id' => 'integer',
        'product_comment_id' => 'integer',
    ];
}
