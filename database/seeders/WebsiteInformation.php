<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class WebsiteInformation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('website_informations')->insert(
            [
                'fabout' => 'Boinama.com is biggest online bookshop in Bangladesh. You can buy books online with a few clicks or a convenient phone call. Superfast cash on delivery service brings the Books at your doorstep.',
                'twitter' => 'https://twitter.com',
                'youtube' => 'https://www.youtube.com/',
                'instragram' => 'https://www.instagram.com/',
                'linkedin' => 'https://www.linkedin.com/',
                'facebook' => 'https://www.facebook.com/',
                'gmail' => 'rhishi@gmail.com',
                'number' => '01629005842',
                'address' => 'Fahad Plaza, 4thFloor,Mutual Trust Bank Building, Mirpur 10, Dhaka',
                'image' => 'Logo/logo.png',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        File::copy(
            public_path('logo.png'),
            Storage::path('public/Logo/logo.png')
        );
    }
}
