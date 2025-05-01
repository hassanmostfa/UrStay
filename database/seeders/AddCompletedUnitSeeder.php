<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompletedUnit;
use Illuminate\Support\Facades\DB;
class AddCompletedUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('completed_units')->insert(
            [
                'unit_id' => 77,
                'owner_id' => 35,
                'saturday_price' => 150,
                'sunday_price' => 140,
                'monday_price' => 130,
                'tuesday_price' => 130,
                'wednesday_price' => 140,
                'thursday_price' => 160,
                'friday_price' => 170,
                'availability_of_booking' => true,
                'negotiable_price' => true,
                'booking_status' => 'available',
            ]);
    }
}
