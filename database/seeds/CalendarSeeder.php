<?php

use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Calendar::create([
            'from'              => \Carbon\Carbon::parse('10:00:00')->format('H:i:s'),
            'to'                => \Carbon\Carbon::parse('12:00:00')->format('H:i:s'),
            'day'               => \Carbon\Carbon::now()->format('Y-m-d'),
            'doctor_id'         => 3,
            'establishment_id'  => 1
        ]);
    }
}
