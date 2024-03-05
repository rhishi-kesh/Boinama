<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Coupon extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert(
            [
                'code' => '1234',
                'amount' => '50',
                'expire_date' => '2030-03-05',
                'status' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
