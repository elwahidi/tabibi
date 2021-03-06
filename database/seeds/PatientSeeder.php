<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = new \App\User();

        $data = [
            'face'              => null,
            'first_name'        => "freha",
            'last_name'         => "saoudi",
            'birth'             => null,
            'address'           => "357, Boulevard Mohamed V -8 étage - 2000",
            'email'             => "fsaoudi@kk.ma",
            'password'          => "123456",
            'category'          => \App\Category::where('category', 'patient')->first()->id,
            'sexe'              => 1,
            'city'              => 1,
            'phones'            => ['0653469193', '0522400258'],
        ];

        $patient->onStore($data);
    }
}
