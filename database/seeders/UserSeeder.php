<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name' => 'william',
            'email' => 'william@mail.com',
            'password' => bcrypt('willliam02'),
            'profile_image' =>  'wolf.jpg',
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'beni',
            'email' => 'beni@mail.com',
            'password' => bcrypt('beni02'),
            'profile_image' => 'what-kind-of-cat-breed-is-beluga-800x450.jpg',
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Hans',
            'email' => 'hansandika70@gmail.com',
            'password' => bcrypt('hansgeovani2'),
            'profile_image' =>  'cute-shiba-inu-standing-waving-hand-cartoon-vector-icon-illustration-animal-nature-icon-concept_138676-4381.webp',
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'ryne',
            'email' => 'ryne@mail.com',
            'password' => bcrypt('ryne02'),
            'profile_image' =>  'istockphoto-1266632962-612x612.jpg',
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);
    }
}
