<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts';

    protected $fillable = [
        'owner_id',
        'wallet_id',
        'bank_name',
        'iban',
        'swift_code',
        'name_on_account',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
