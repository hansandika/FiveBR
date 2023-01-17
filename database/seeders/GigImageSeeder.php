<?php

namespace Database\Seeders;

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
        $gigImages = [
            [
                'gig_id' => 1,
                'image_name' => 'htmlandcss2.jpeg',
            ],
            [
                'gig_id' => 1,
                'image_name' => 'htmlandcss.jfif',
            ],
            [
                'gig_id' => 1,
                'image_name' => 'htmlandcss3.png'
            ],
            [
                'gig_id' => 2,
                'image_name' => 'php1.jpg',
            ],
            [
                'gig_id' => 2,
                'image_name' => 'php2.jpg',
            ],
            [
                'gig_id' => 3,
                'image_name' => 'laravel1.png',
            ],
            [
                'gig_id' => 3,
                'image_name' => 'laravel2.webp',
            ],
            [
                'gig_id' => 4,
                'image_name' => 'articlewrite1.jpg',
            ],
            [
                'gig_id' => 4,
                'image_name' => 'articlewrite2.jpg',
            ],
            [
                'gig_id' => 5,
                'image_name' => 'videoediting1.jpg',
            ],
            [
                'gig_id' => 5,
                'image_name' => 'videoediting2.jpg',
            ],
            [
                'gig_id' => 5,
                'image_name' => 'videoediting3.jpeg',
            ],
            [
                'gig_id' => 6,
                'image_name' => 'musicproduction1.jpg',
            ],
            [
                'gig_id' => 6,
                'image_name' => 'musicproduction2.jpg',
            ],
            [
                'gig_id' => 7,
                'image_name' => 'logodesign1.webp',
            ],
            [
                'gig_id' => 7,
                'image_name' => 'logodesign2.webp',
            ],
            [
                'gig_id' => 8,
                'image_name' => 'articletranslate1.webp',
            ],
            [
                'gig_id' => 8,
                'image_name' => 'articletranslate2.webp',
            ],
            [
                'gig_id' => 9,
                'image_name' => 'datavisual1.jfif',
            ],
            [
                'gig_id' => 9,
                'image_name' => 'datavisual2.png',
            ],
            [
                'gig_id' => 9,
                'image_name' => 'datavisual3.png',
            ],
        ];

        foreach ($gigImages as $image) {
            GigImage::create([
                'gig_id' => $image['gig_id'],
                'image_name' =>  $image['image_name'],
            ]);
        }
    }
}
