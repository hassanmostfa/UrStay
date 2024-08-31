<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    public $users = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'pid',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function type():Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "admin"][$value],
        );
    }


    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function ownedUnits() {
        return $this->hasMany(Unit::class, 'owner_id');
    }
    
}
