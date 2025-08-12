<?php

namespace Database\Seeders;

use App\Models\Dog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dog::create([
            'name' => 'Buddy',
            'breed' => 'Golden Retriever',
            'age' => 3,
            'weight' => 3,
            'color' => 'Golden',
            'owner' => 'John Doe',
            'additional_info' => 'Friendly and playful, up for adoption.',
            'image_path' => 'img/Buddy.jpg', // Link to existing image
        ]);

        Dog::create([
            'name' => 'Max',
            'breed' => 'Labrador Retriever',
            'age' => 2,
            'weight' => 2.5,
            'color' => 'Black',
            'owner' => 'Jane Doe',
            'additional_info' => 'Loves to fetch and swim.',
            'image_path' => 'img/Max.jpg', // Link to existing image
        ]);

        Dog::create([
            'name' => 'Bella',
            'breed' => 'German Shepherd',
            'age' => 4,
            'weight' => 3.5,
            'color' => 'Brown',
            'owner' => 'John Smith',
            'additional_info' => 'Protective and loyal, great with kids.',
            'image_path' => 'img/Bella.jpg', // Link to existing image
        ]);
    }
}
