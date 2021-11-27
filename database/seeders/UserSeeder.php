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
            'profile_image' =>  $faker->image('public/storage/profile-pictures', 640, 480, null, false),
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'beni',
            'email' => 'beni@mail.com',
            'password' => bcrypt('beni02'),
            'profile_image' =>  $faker->image('public/storage/profile-pictures', 640, 480, null, false),
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Hans',
            'email' => 'hansandika70@gmail.com',
            'password' => bcrypt('hansgeovani2'),
            'profile_image' =>  $faker->image('public/storage/profile-pictures', 640, 480, null, false),
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'ryne',
            'email' => 'ryne@mail.com',
            'password' => bcrypt('ryne02'),
            'profile_image' =>  $faker->image('public/storage/profile-pictures', 640, 480, null, false),
            'description' => $faker->paragraph(),
            'about' => $faker->sentence(),
            'join_date' => Carbon::now()
        ]);
    }
}
