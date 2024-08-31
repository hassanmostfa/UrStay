<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = ['user_id', 'owner_id', 'unit_id', 'start_date', 'end_date', 'status'];


    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function unit() {
        return $this->belongsTo(Unit::class);
    }
    
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
}

