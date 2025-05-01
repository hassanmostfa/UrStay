<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;
class AddOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Owner();
        $owner->first_name = 'UrStay';
        $owner->last_name = 'Owner';
        $owner->email = 'seller@urstay.com';
        $owner->phone = '1234567890';
        $owner->password = Hash::make('12345678');
        $owner->save();
    }
}
