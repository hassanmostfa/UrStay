<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'owner_id',
        'balance',
        'currency',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    public function bankAccount(){
        return $this->hasMany(BankAccount::class);
    }
}
