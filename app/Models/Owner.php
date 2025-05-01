<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Owner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'owners';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'pid',
        'points',
        'phone',
        'password',
    ];

       // Define the relationship with units
       public function units()
       {
           return $this->hasMany(Unit::class , "owner_id");
       }

       public function chatRooms(){
        return $this->hasMany(ChatRoom::class, 'owner_id');
    }

    public function owner_supervisor_chat_rooms(){
        return $this->hasMany(OwnerSupervisorChatRoom::class, 'owner_id');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function owner_supervisor_messages(){
        return $this->hasMany(OwnerSupervisorMessage::class);    
    }

    public function wallets(){
        return $this->hasOne(Wallet::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function userOwnerNotifications(){
        return $this->hasMany(UserOwnerNotification::class , 'owner_id');
    }

    public function bankAccount(){
        return $this->hasMany(BankAccount::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class , "owner_id");
    }
}
