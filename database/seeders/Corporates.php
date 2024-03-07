<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Corporates extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('corporates')->insert(
            [
                'title' => 'বইনামা কর্পোরেট ক্লায়েন্ট কাস্টমাইজড সার্ভিস',
                'subtitle' => 'টেন্ডার, আরএফকিউ অথবা ডিরেক্ট যেভাবেই পারচেজ হোক বাংলাদেশের যেকোন স্থানে বই পৌছে দিচ্ছে বইনামা। স্কুল, কলেজ, বিশ্ববিদ্যালয়, লাইব্রেরি, কর্পোরেট হাউজ, ব্যাংক, বীমা, এনজিও, ডিফেন্স এবং সরকারি-বেসরকারি সবধরনের প্রতিষ্ঠানে সর্বোচ্চ ডিস্কাউন্টে দেশী-বিদেশি অরিজিনাল প্রিন্টেড বই সরবরাহ করছে বইনামা কর্পোরেট সেলস টিম।',
                'number' => '01629005842',
                'gmail' => 'rhishi@gmail.com',
                'image' => 'Corporates/corporate.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        File::copy(
            public_path('corporate.jpg'),
            Storage::path('public/Corporates/corporate.jpg')
        );
    }
}
