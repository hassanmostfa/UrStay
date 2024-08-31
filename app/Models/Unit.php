<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = [
    'owner_id',
    'request_status' ,
    'owner_name' ,
    'unit_title' ,
    'unit_image',
    'rate' ,
    'unit_price' ,
    'unit_description',
    'unit_status' ,
    'unit_location' ,
    'unit_size' ,
    'unit_rooms',
    'unit_bathrooms',
    'unit_type' ,
    'lisence_one' ,
    'lisence_two' ,
    'owner_email' ,
    'owner_phone'
];

// Unit Model
public function bookings() {
    return $this->hasMany(Booking::class);
}

// Booking Model
public function unit() {
    return $this->belongsTo(Unit::class);
}

public function user() {
    return $this->belongsTo(User::class);
}


public function scopeAvailable($query, $startDate, $endDate) {
    return $query->where('status', 'available')
                ->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
                    $query->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                            ->orWhereBetween('end_date', [$startDate, $endDate]);
                    });
                });
}



public function owner() {
    return $this->belongsTo(User::class, 'owner_id');
}
}
