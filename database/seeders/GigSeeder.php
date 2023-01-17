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
        $gigs = [
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 4,
                'title' => 'HTML & CSS',
                'about' => 'I will create a responsive website for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will create a responsite webbite with HTML and CSS',
                'standard_price' => rand(1201, 1500),
                'standard_description' =>  'I will create a responsite webbite with HTML and CSS with a contact form',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will create a responsite webbite with HTML and CSS with a contact form and a blog',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 4,
                'title' => 'PHP & MySQL',
                'about' => 'I will create a dynamic website for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will create a dynamic webbite with PHP and MySQL',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will create a dynamic webbite with PHP and MySQL with a contact form',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will create a dynamic webbite with PHP and MySQL with a contact form and a blog',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 4,
                'title' => 'Laravel',
                'about' => 'I will create a dynamic website for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will create a dynamic webbite with Laravel',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will create a dynamic webbite with Laravel with a contact form',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will create a dynamic webbite with Laravel with a contact form and a blog',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 2,
                'title' => 'Article Writing',
                'about' => 'I will write an article for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will write an article for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will write an article for you with specific keywords',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will write an article for you with specific keywords and a blog',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 7,
                'title' => 'Video Editing',
                'about' => 'I will edit a video for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will edit a video for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will edit a video for you with specific effect',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will edit a video for you with specific effect and an animation',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 8,
                'title' => 'Music Production',
                'about' => 'I will produce a music for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will produce a music for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will produce a music for you with specific effect',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will produce a music for you with specific effect and an animation',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 1,
                'title' => 'Logo Design',
                'about' => 'I will design a logo for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will design a logo for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will design a logo for you with specific effect',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will design a logo for you with specific effect and an animation',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 2,
                'title' => 'Article Transaction Indonesia to English',
                'about' => 'I will translate an article for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will translate an article for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will translate an article for you with specific keywords',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will translate an article for you with specific keywords and a paraphrase',
            ],
            [
                'user_id' => rand(1, User::get()->count()),
                'category_id' => 9,
                'title' => 'Data Visualization (python)',
                'about' => 'I will visualize data for you',
                'basic_price' => rand(1000, 1200),
                'basic_description' => 'I will visualize data for you',
                'standard_price' => rand(1201, 1500),
                'standard_description' => 'I will visualize data for you with specific keywords',
                'premium_price' => rand(1600, 10000),
                'premium_description' => 'I will visualize data for you with chart and a graph',
            ]
        ];

        foreach ($gigs as $gig) {
            Gig::create([
                'user_id' => $gig['user_id'],
                'category_id' => $gig['category_id'],
                'title' => $gig['title'],
                'about' => $gig['about'],
                'basic_price' => $gig['basic_price'],
                'basic_description' =>  $gig['basic_description'],
                'standard_price' => $gig['standard_price'],
                'standard_description' =>  $gig['standard_description'],
                'premium_price' => $gig['premium_price'],
                'premium_description' =>  $gig['premium_description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
