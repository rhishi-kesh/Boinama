<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                'name' => 'ইতিহাসের ছিন্নপত্র',
                'price' => '400',
                'discount' => '20',
                'quantity' => '10',
                'subject_id' => '1',
                'prakasani_id' => '1',
                'writer_id' => '1',
                'user_id' => '1',
                'slug' => 'ইতিহাসের-ছিন্নপত্র',
                'description' => 'সময়ের বিচূর্ণ আয়নায় বর্তমানের চোখে অতীতকে দেখাই ইতিহাস। অতীতের একই ঘটনাপ্রবাহকে একেক সময়ে একেক ব্যক্তি একেক চশমায় দেখেন এবং লিপিবদ্ধ করেন। আমাদের ইতিহাসের অত্যন্ত তাৎপর্যপূর্ণ একটি সময়কালকে ফিরে দেখতে এখানে সমাবেশ ঘটানো হয়েছে সর্বাধিক চশমার। সাম্প্রতিক সময়ের এ এক বর্ণাঢ্যতম অতীতবীক্ষণ।',
                'status' => '0',
                'is_active' => '0',
                'image' => 'Product/product.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        File::copy(
            public_path('product.jpg'),
            Storage::path('public/Product/product.jpg')
        );
    }
}
