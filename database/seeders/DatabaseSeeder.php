<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([CustomerSeeder::class]);
        $this->call([ProductSeeder::class]);
        $this->call([InvoiceProductSeeder::class]);
        $this->call([PaymentMethodSeeder::class]);
        $this->call([PaymentSeeder::class]);
    }
}
