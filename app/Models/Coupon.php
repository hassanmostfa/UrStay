<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'owner_id',
        'discount_name',
        'discount_type',
        'from_date',
        'to_date',
        'no_of_nights',
        'no_of_units',
        'unit_id',
        'percentage',
        'applied_on',
        'code',
    ];
}
