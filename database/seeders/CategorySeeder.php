<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Graphics & Design'
        ]);
        Category::create([
            'name' => 'Writing & Translation'
        ]);
        Category::create([
            'name' => 'Music & Animation'
        ]);
        Category::create([
            'name' => 'Programming & Tech'
        ]);
        Category::create([
            'name' => 'Business'
        ]);
        Category::create([
            'name' => 'Digital Marketing'
        ]);
        Category::create([
            'name' => 'Video & Animation'
        ]);
        Category::create([
            'name' => 'Music & Audio'
        ]);
        Category::create([
            'name' => 'Data'
        ]);
        Category::create([
            'name' => 'Lifestyle'
        ]);
    }
}
