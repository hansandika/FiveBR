<?php

namespace Database\Seeders;

use App\Models\Gig;
use App\Models\GigImage;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class GigImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $gigs = Gig::get();
        foreach ($gigs as $gig) {
            $random = rand(1, 6);
            for ($i = 0; $i < $random; $i++) {
                GigImage::create([
                    'gig_id' => $gig->id,
                    'image_name' =>  $faker->image('public/storage/gig-images', 640, 480, null, false),
                ]);
            }
        }
    }
}
