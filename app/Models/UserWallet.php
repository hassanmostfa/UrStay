<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;

    protected $table = 'users_wallets';

    protected $fillable = [
        'user_id',
        'balance',
        'currency',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function bankAccount(){
    //     return $this->hasMany(BankAccount::class);
    // }
}
