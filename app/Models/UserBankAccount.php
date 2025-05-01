<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    use HasFactory;

    protected $table = 'users_bank_accounts';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'bank_name',
        'iban',
        'swift_code',
        'name_on_account',
    ];
}
