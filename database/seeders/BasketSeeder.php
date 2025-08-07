<?php

namespace Database\Seeders;

use App\Models\Basket;
use Illuminate\Database\Seeder;

class BasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Basket::truncate();

        echo "Basket table cleared. Users can now add items through the shop.\n";
    }
}
