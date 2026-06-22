<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'minimum_purchase',
        'expired_at',
        'status',
    ];
}
