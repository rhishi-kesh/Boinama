<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = '12345678';
        DB::table('users')->insert(
            [
                'name' => 'Rhishi',
                'email' => 'customer@gmail.com',
                'password' => Hash::make($password),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
