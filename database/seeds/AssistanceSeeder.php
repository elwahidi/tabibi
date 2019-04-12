<?php

use Illuminate\Database\Seeder;

class AssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assistant = new \App\User();

        $data = [
            'face'              => null,
            'first_name'        => "freha",
            'last_name'         => "saoudi",
            'birth'             => null,
            'address'           => "357, Boulevard Mohamed V -8 étage - 2000",
            'email'             => "fsaoudi@mmmmm.ma",
            'password'          => "123456",
            'category'          => \App\Category::where('category', 'assistant')->first()->id,
            'specialty'         => 1,
            'sexe'              => 1,
            'city'              => 1,
            'phones'            => ['0653469193'],
            'establishment'     => 1,
            'doctor'            => 3
        ];

        $assistant->onStoreAssistant($data);

    }
}
