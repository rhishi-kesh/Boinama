<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = 'admin';
        $user = 'user';
        $vendor = 'vendor';
        DB::table('admins')->insert([
            [
                'name' => 'Rhishi',
                'email' => 'admin@gmail.com',
                'password' => Hash::make($admin),
                'role' => '0',
                'status' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rhishi',
                'email' => 'user@gmail.com',
                'password' => Hash::make($user),
                'role' => '2',
                'status' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rhishi',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make($vendor),
                'role' => '1',
                'status' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
