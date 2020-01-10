<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'family_name' => 'admin',
            'phone_number' => '09120000000',
            'email' => 'admin@gmail.com',
            'OTP' =>  Hash::make(12345),
        ]);
        // first otp -> 12345  number -> 09120000000
    }
}
