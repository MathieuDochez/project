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
            'weight' => 30,
            'color' => 'Golden',
            'owner_id' => 1,
        ]);

        Dog::create([
            'name' => 'Max',
            'breed' => 'Labrador Retriever',
            'age' => 2,
            'weight' => 25,
            'color' => 'Black',
            'owner_id' => 2,
        ]);

        Dog::create([
            'name' => 'Bella',
            'breed' => 'German Shepherd',
            'age' => 4,
            'weight' => 35,
            'color' => 'Brown',
            'owner_id' => 3,
        ]);
    }
}
