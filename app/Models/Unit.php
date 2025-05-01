<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $fillable = [
        'owner_id',
        'title',
        'category',
        'sub_category',
        'sub_sub_category',
        'country',
        'zone_name',
        'governorate_name',
        'city_name',
        'district_name',
        'location',
        'size',
        'facilities',
        'rooms',
        'no_of_single_beds',
        'no_of_master_beds',
        'pool',
        'pool_size',
        'kitchen',
        'table_chairs',
        'bathrooms',
        'bathroom_facilities',
        'additional_facilities',
        'advantages',
        'description',
        'image',
        'status',
        'price',
        'request_status',
        'rejection_reason',
        'rooms_images',
        'kitchen_images',
        'pool_images',
        'bathroom_images',
        'building_images',
        'facilities_images',
        'additional_images',
        'has_mot_permission',
        'mot_permission',
        'managed_by',
        'insurance_amount',
        'latitude',
        'longitude',
        'booking_type',
        'possibility_of_cancellation',
        'cancellation_type',
        'specific_time_cancellation_duration',
    ];

    protected $casts = [
        'facilities' => 'array',
        'kitchen' => 'array',
        'bathroom_facilities' => 'array',
        'additional_facilities' => 'array',
        'advantages' => 'array',
        'rooms_images' => 'array',
    ];

     // Define the inverse relationship with owner
        public function owner()
        {
            return $this->belongsTo(Owner::class , "owner_id");
        }
     // Define the inverse relationship with owner
        public function admin()
        {
            return $this->belongsTo(Admin::class, "managed_by");
        }

        public function completedUnits(){
            return $this->hasMany(CompletedUnit::class , "unit_id");
        }

        public function favorites(){
            return $this->hasMany(Favorite::class , "unit_id");
        }

        public function ratings(){
            return $this->hasMany(Rating::class , "unit_id");
        }

        public function pricing_mechanisms(){
            return $this->hasMany(PricingMechanism::class , "unit_id");
        }

}
