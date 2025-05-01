<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $fillable = ['name', 'city_id', 'zone_id' , 'governorate_id' , 'country_id'];

    public function city() {
        return $this->belongsTo(City::class);
    }
    public function zone() {
        return $this->belongsTo(Zone::class);
    }
    public function governorate() {
        return $this->belongsTo(Governorate::class);
    }
}
