<?php

namespace Database\Seeders;

use App\Models\Basket;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class BasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assuming the user and items exist in your database
        $user = User::first();
        $item = Shop::first();

        Basket::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);
    }
}
