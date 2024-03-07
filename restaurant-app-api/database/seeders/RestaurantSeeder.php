<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            ['name' => 'Restaurant A', 'cuisine' => 'Italian', 'rating' => 4.5],
            ['name' => 'Restaurant B', 'cuisine' => 'Mexican', 'rating' => 4.0],
            ['name' => 'Restaurant C', 'cuisine' => 'Chinese', 'rating' => 4.2],
        ];

        // Insert data into the restaurants table
        foreach ($restaurants as $restaurant) {
            DB::table('restaurants')->insert($restaurant);
        }
    }
}
