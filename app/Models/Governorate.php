<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $table = 'governorates';
    protected $fillable = ['name', 'zone_id' , 'country_id'];

    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    public function cities() {
        return $this->hasMany(City::class);
    }
}
