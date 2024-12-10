<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample reviews
        Review::create([
            'user_id' => 1, // Guest
            'rating' => 5,
            'comment' => 'This website is amazing! Keep up the good work.',
        ]);

        Review::create([
            'user_id' => 2, // Guest
            'rating' => 4,
            'comment' => 'Good experience overall, but some features could be improved.',
        ]);

        Review::create([
            'user_id' => 3, // Guest
            'rating' => 3,
            'comment' => 'Average. It works, but nothing too special.',
        ]);

        Review::create([
            'user_id' => 4, // Guest
            'rating' => 2,
            'comment' => 'Had some issues navigating the site. Needs improvement.',
        ]);

        Review::create([
            'user_id' => 5, // Guest
            'rating' => 1,
            'comment' => 'Terrible experience. Couldn’t get anything to work.',
        ]);
    }
}
