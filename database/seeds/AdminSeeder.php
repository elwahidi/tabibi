<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();

        $data = [
            'face'              => null,
            'first_name'        => "freha",
            'last_name'         => "saoudi",
            'birth'             => null,
            'address'           => "357, Boulevard Mohamed V -8 étage - 2000",
            'email'             => "pdg@ly.ly",
            'password'          => "12345678",
            'category'          => 1,
            'sexe'              => 1,
            'city'              => 1,
            'phones'            => ['0653469193', '0522400258']
        ];

        $user = $user->onStore($data);

        auth()->setUser($user);
    }
}
