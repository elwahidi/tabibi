<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $doctor = new \App\User();
        $data = [
            'face'              => null,
            'first_name'        => "freha",
            'last_name'         => "saoudi",
            'birth'             => null,
            'address'           => "357, Boulevard Mohamed V -8 étage - 2000",
            'description'       => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
            'email'             => "fsaoudi@mmm.ma",
            'password'          => "123456",
            'category'          => \App\Category::where('category', 'doctor')->first()->id,
            'specialty'         => 1,
            'sexe'              => 1,
            'city'              => 1,
            'phones'            => ['0653469193', '0522400258'],
            'establishments'    => [1],
            'experiences'       => [[
                'name'          => 'experience',
                'address'       => 'address address address ',
                'build'         => 15,
                'floor'         => 5,
                'apt_nbr'       => 27,
                'zip'           => 20000,
                'start'         => \Carbon\Carbon::parse('2010')->format('Y'),
                'end'           => null,
            ]],
            'faculties'       => [[
                'name'          => 'etude',
                'address'       => 'address address address ',
                'build'         => 15,
                'floor'         => 5,
                'apt_nbr'       => 27,
                'zip'           => 20000,
                'start'         => \Carbon\Carbon::parse('2003')->format('Y'),
                'end'           => \Carbon\Carbon::parse('2010')->format('Y'),
            ]],
            'price'     => 450,
            'seance'    => \Carbon\Carbon::parse('00:01:00')->format('H:i:s')
        ];

        $doctor->onStoreDoctor($data);

    }
}
