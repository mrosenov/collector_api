<?php

namespace Database\Seeders;

use App\Models\InvoiceProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceProduct::factory()->count(10)->create();
    }
}
