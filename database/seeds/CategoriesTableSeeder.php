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

        $categories = [
            'alpha', 'beta', 'owner', 'doctor', 'establishment', 'assistant', 'patient'
        ];

        foreach ($categories as $category){

            \App\Category::create([
                'category' => $category
            ]);

        }
    }
}
