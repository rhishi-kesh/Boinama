<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Slider extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->insert(
            [
                'image' => 'Sliders/slider.jpg',
                'link' => 'https://www.facebook.com/rhishi.kesh.bhowmik/',
                'status' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        File::copy(
            public_path('slider.jpg'),
            Storage::path('public/Sliders/slider.jpg')
        );
    }
}
