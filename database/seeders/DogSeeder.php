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
        // Clear existing dogs
        Dog::truncate();

        // Create dogs with the new image system
        Dog::create([
            'name' => 'Buddy',
            'breed' => 'Golden Retriever',
            'age' => 3.0,
            'weight' => 30.0,
            'color' => 'Golden',
            'owner' => 'John Doe',
            'additional_info' => 'Friendly and playful, up for adoption.',
            'image_path' => 'img/dog-1-buddy-20250812000000.jpg'
        ]);

        Dog::create([
            'name' => 'Max',
            'breed' => 'Labrador Retriever',
            'age' => 2.0,
            'weight' => 25.0,
            'color' => 'Black',
            'owner' => 'Jane Doe',
            'additional_info' => 'Loves to fetch and swim.',
            'image_path' => 'img/dog-2-max-20250812000000.jpg'
        ]);

        Dog::create([
            'name' => 'Bella',
            'breed' => 'German Shepherd',
            'age' => 4.0,
            'weight' => 35.0,
            'color' => 'Brown',
            'owner' => 'John Smith',
            'additional_info' => 'Protective and loyal, great with kids.',
            'image_path' => 'img/dog-3-bella-20250812000000.jpg'
        ]);

        $this->command->info('✅ Dogs seeded successfully');
    }
}
