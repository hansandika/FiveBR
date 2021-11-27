<?php

namespace Database\Seeders;

use App\Models\Gig;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class GigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            Gig::create([
                'user_id' => rand(1, User::get()->count()),
                'category_id' => rand(1, 10),
                'title' => $faker->sentence(),
                'about' => $faker->paragraph(),
                'basic_price' => rand(1000, 1200),
                'basic_description' =>  $faker->paragraph(),
                'standard_price' => rand(1201, 1500),
                'standard_description' =>  $faker->paragraph(),
                'premium_price' => rand(1600, 10000),
                'premium_description' =>  $faker->paragraph(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
