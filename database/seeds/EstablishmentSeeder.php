<?php

use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $establishment = new \App\Establishment();

        $data = [
            // step 1
            'city'                      => 1,
            // step 2
            'name'                      => "tabibis",
            'address_establishment'     => "Boulevard Mohamed",
            'description_establishment' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident",
            'build'                     => 357,
            'floor'                     => 8,
            'apt_nbr'                   => 30,
            'zip'                       => 20000,
            'phones_establishment'      => ['0522400258'],
            // step 3
            'face'                      => 'face.png',
            'first_name'                => "freha",
            'last_name'                 => "saoudi",
            'description'               => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident",
            'birth'                     => null,
            'address'                   => "357, Boulevard Mohamed V -8 étage - 20000",
            'email'                     => "fsaoudi@gmail.com",
            'password'                  => "123456",
            'category'                  => \App\Category::where('category','patient')->first()->id,
            'specialty'                 => 2,
            'sexe'                      => 1,
            'phones'                    => ['0653469193'],
            // step 4
            'imgs'                      => ['001.png','002.png'],
        ];

        $establishment->onStore($data);
    }
}
