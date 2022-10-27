<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CategoryRole extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function roles() {
        return $this->hasMany(Role::class);
    }
}
