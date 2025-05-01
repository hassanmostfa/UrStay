<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    use HasFactory;

    protected $table = 'negotiations';

    protected $fillable = [
        'booking_id',
        'sender_id',
        'sender_type',
        'message',
        'is_read',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class , 'booking_id');
    }

    public function isOwnedByOwner($owner)
{
    return $this->sender_id === $owner->id && $this->sender_type === 'owner';
}

public function isOwnedByUser($user)
{
    return $this->sender_id === $user->id && $this->sender_type === 'user';
}


}


