<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'user_id',
        'category_role_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categoryRole() {
        return $this->belongsTo(CategoryRole::class);
    }
}
