<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat-one', 'cat-two', 'cat-three'];

        foreach ($categories as $category) {
            \App\Modeles\Category::create([
                'ar' => ['name' => $category . '-ar'],
                'en' => ['name' => $category . '-en'],
            ]);
        }
    }
}
