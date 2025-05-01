<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedUnit extends Model
{
    use HasFactory;

    protected $table = 'completed_units';

    protected $fillable = [
        'unit_id',
        'owner_id',
        'saturday_price',
        'sunday_price',
        'monday_price',
        'tuesday_price',
        'wednesday_price',
        'thursday_price',
        'friday_price',
        'availability_of_booking',
        'negotiable_price',
        'booking_status',
        'follows_pricing_mechanism',
        'publishment_status',
        'publishment_date',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class , "unit_id");
    }
}
