<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'completed_unit_id',
        'owner_id',
        'start_date',
        'end_date',
        'user_price',
        'booking_status',
        'note',
        'total_price',
        'no_of_people',
        'payment_status',
        'payment_method',
        'discount_value',
    ];

    public function negotiations(){
        return $this->hasMany(Negotiation::class , 'booking_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function completed_unit(){
        return $this->belongsTo(CompletedUnit::class , 'completed_unit_id');
    }

    public function owner(){
        return $this->belongsTo(Owner::class , 'owner_id');
    }

    
}
