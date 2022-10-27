<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProductOrder extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    public const STATUS_INIT = 0;

    public const STATUS_WAIT_FOR_CUSTOMER_PAYING = 1;

    public const STATUS_CUSTOMER_PAID = 2;
    
    public const STATUS_WAIT_FOR_STAFF_CONFIRM_ORDERING = 3;

    public const STATUS_STAFF_CONFIRMED_ORDERING = 4;

    public const STATUS_WAIT_FOR_SHIPPING = 5;

    public const STATUS_COMPLETE_SHIPPING = 6;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'delivery_method',
        'customer_address',
        'other_request',
        'is_invoice',
        'is_call_other',
        'total_price',
        'store_province_id',
        'store_province_name',
        'store_district_id',
        'store_district_name',
        'store_address_id',
        'customer_province_id',
        'customer_province_name',
        'customer_district_id',
        'customer_district_name',
        'user_id',
        'status',
        'payment_method_id',
    ];

    protected $attributes = [
        'status' => self::STATUS_INIT,
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
