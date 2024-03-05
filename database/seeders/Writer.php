<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Writer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('writers')->insert(
            [
                'name' => 'rhishi',
                'slug' => 'rhishi',
                'user_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
