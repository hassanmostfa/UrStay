<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingMechanism extends Model
{
    use HasFactory;

    protected $table = 'pricing_mechanisms';

    protected $fillable = [
        'owner_id',
        'unit_id',
        'name',
        'saturday_price',
        'midweek',
        'thursday_price',
        'friday_price',
        'start_date',
        'end_date',
        'periority',
    ];
}
