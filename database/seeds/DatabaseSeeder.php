<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // todo : seeder from Admin.
        // todo : construct array for cache.
        $this->call([
            CategoriesTableSeeder::class,
            CitiesTableSeeder::class,
            SexesTableSeeder::class,
            PaymentMethodsTableSeeder::class,
            SpecialtiesTableSeeder::class,
            AdminSeeder::class,
            EstablishmentSeeder::class,
            DoctorSeeder::class,
            AssistanceSeeder::class,
            PatientSeeder::class,
            CalendarSeeder::class,
            AppointmentSeeder::class
        ]);
    }

    /*
     * admin =>
         * establishment : [
         *      'invoice'   => 'method'
         *      'info',
         *      'owner'     => user,
         *      'specialty' =>
         *          'doctor'    =>
         *                  assistant   => user,
         *                  calendar    =>
         *                          appointment     =>
         *                                  patient     => fiche, payment
     * ]
     */
    /*
     * categories
     * cities
     * sexes
     * paymentMethod
     * specialty
     *
     *
     * admin
     *  create
     * establishment &&&
     *  create
     * doctor &&&
     *  create
     * assistant
     *  create
     * patient
     *  create
     *
     *
     * calendar
     * appointment
     *  create
     * fiche
     *  create
     *
     *
     * create 8
     * update
     * liste
     * profile
     * delete
     *
     */

}
