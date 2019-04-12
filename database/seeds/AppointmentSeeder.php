<?php

use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // la verification de disponibilité d'un appointment doit être dans le authorize
        $doctor = new \App\User();

        $doctor = $doctor->where('category_id',7)->first();
        $data = [
            'price'     => 250,
            'reason'    => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum",
            'calendar_id' => 1
        ];
        $doctor->onStoreAppointment($data);
    }
}
