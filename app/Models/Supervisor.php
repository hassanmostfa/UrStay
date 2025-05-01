<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Supervisor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'supervisors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'isApproved',
        'password',
    ];

    public function owner_supervisor_chat_rooms(){
        return $this->hasMany(OwnerSupervisorChatRoom::class, 'supervisor_id');
    }

    public function owner_supervisor_messages(){
        return $this->hasMany(OwnerSupervisorMessage::class);
    }

}
