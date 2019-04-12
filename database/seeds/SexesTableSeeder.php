<?php

use Illuminate\Database\Seeder;

class SexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexes = ['homme', 'femme'];

        foreach ($sexes as $sex){

            \App\Sexe::create([
                'sexe' => $sex
            ]);

        }
    }
}
