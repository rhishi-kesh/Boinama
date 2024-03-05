<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Prakasanis extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prakasanis')->insert(
            [
                'name' => 'ছিন্নপত্র',
                'slug' => 'ছিন্নপত্র',
                'user_id' => '1',
                'is_nav' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
