<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 123456789;
        DB::table('admins')->insert([
            [
                'username'     => 'Admin',
                'email'        => 'admin@gmail.com',
                'phone_number' => '01764997485',
                'password'     => Hash::make($password)
            ],
            [
                'username'     => 'User',
                'email'        => 'user@gmail.com',
                'phone_number' => '01750231275',
                'password'     => Hash::make($password)
            ]
        ]);
    }
}
