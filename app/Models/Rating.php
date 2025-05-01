<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'owner_id',
        'unit_id',
        'rating',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }


}
