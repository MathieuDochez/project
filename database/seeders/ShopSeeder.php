<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use App\Enums\ProductCategory;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::truncate(); // Clear existing data

        Shop::create([
            'name' => 'Dog Toy - Chew Ball',
            'description' => 'Durable chew ball for dogs.',
            'price' => 9.99,
            'category' => ProductCategory::TOYS->value,
        ]);

        Shop::create([
            'name' => 'Dog Kibble - Premium',
            'description' => 'High-quality kibble for dogs.',
            'price' => 29.99,
            'category' => ProductCategory::FOOD->value,
        ]);

        Shop::create([
            'name' => 'Dog Leash - Nylon',
            'description' => 'Strong nylon leash for dogs.',
            'price' => 14.99,
            'category' => ProductCategory::ACCESSORIES->value,
        ]);

        Shop::create([
            'name' => 'Dog Bed - Large',
            'description' => 'Comfortable large bed for dogs.',
            'price' => 49.99,
            'category' => ProductCategory::BEDS->value,
        ]);

        Shop::create([
            'name' => 'Dog Collar - Leather',
            'description' => 'Stylish leather collar for dogs.',
            'price' => 19.99,
            'category' => ProductCategory::ACCESSORIES->value,
        ]);

        Shop::create([
            'name' => 'Dog Shampoo - Sensitive Skin',
            'description' => 'Gentle shampoo for dogs with sensitive skin.',
            'price' => 12.99,
            'category' => ProductCategory::GROOMING->value,
        ]);

        Shop::create([
            'name' => 'Dog Treats - Chicken Flavor',
            'description' => 'Delicious chicken-flavored treats for dogs.',
            'price' => 7.99,
            'category' => ProductCategory::FOOD->value,
        ]);

        Shop::create([
            'name' => 'Dog Bowl - Stainless Steel',
            'description' => 'Durable stainless steel bowl for dogs.',
            'price' => 8.99,
            'category' => ProductCategory::ACCESSORIES->value,
        ]);

        Shop::create([
            'name' => 'Dog Jacket - Waterproof',
            'description' => 'Waterproof jacket to keep dogs dry.',
            'price' => 24.99,
            'category' => ProductCategory::CLOTHING->value,
        ]);

        Shop::create([
            'name' => 'Dog Crate - Medium',
            'description' => 'Medium-sized crate for dogs.',
            'price' => 59.99,
            'category' => ProductCategory::HOUSING->value,
        ]);
    }
}
