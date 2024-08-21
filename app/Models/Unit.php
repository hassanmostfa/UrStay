<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = ['owner_name' , 'unit_title' , 'unit_image' , 'rate' , 'unit_price' , 'unit_description' , 'unit_status' , 'unit_location' , 'unit_size' , 'unit_rooms' , 'unit_bathrooms' , 'unit_type' , 'owner_email' , 'owner_phone'];
}
