<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'owner_name' => 'Fisal Ahmed',
            'unit_price' => 1000000,
            'unit_description' => 'Unit 1 description',
            'unit_status' => 'available',
            'unit_location' => 'UAE', 
            'unit_size' => 200,
            'unit_rooms' => 3,
            'unit_bathrooms' => 2,
            'unit_type' => 'apartment',
            'owner_email' => 'XVf9T@example.com',
            'owner_phone' => '0123456789',
        ]);
    }
}
