<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Supervisor;

class AddSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Supervisor();
        $owner->first_name = 'UrStay';
        $owner->last_name = 'Supervisor';
        $owner->email = 'supervisor@urstay.com';
        $owner->phone = '1234567890';
        $owner->password = Hash::make('12345678');
        $owner->save();
    }
}
