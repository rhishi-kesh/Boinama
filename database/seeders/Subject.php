<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Subject extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert(
            [
                'name' => 'গল্প',
                'slug' => 'গল্প',
                'user_id' => '1',
                'status' => '0',
                'is_nav' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
