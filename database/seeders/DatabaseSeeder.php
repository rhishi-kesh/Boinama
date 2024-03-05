<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WebsiteInformation::class);
        $this->call(Slider::class);
        $this->call(ShippingFee::class);
        $this->call(Coupon::class);
        $this->call(Corporates::class);
        $this->call(Customer::class);
        $this->call(Admin::class);
        $this->call(Prakasanis::class);
        $this->call(Subject::class);
        $this->call(Writer::class);
        $this->call(Product::class);
    }
}
