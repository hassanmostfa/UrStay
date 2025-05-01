<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = ['name', 'governorate_id' , 'zone_id' ,'country_id'];

    public function governorate() {
        return $this->belongsTo(Governorate::class);
    }

    public function districts() {
        return $this->hasMany(District::class);
    }
}
