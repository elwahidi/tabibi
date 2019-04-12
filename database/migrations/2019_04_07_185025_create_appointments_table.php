<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedDecimal('price',65)->nullable();
            $table->longText('reason');

            $table->unsignedBigInteger('patient_id')->index();
            $table->foreign('patient_id')->references('id')
                ->on('users');

            $table->unsignedBigInteger('calendar_id')->index();
            $table->foreign('calendar_id')->references('id')
                ->on('calendars');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
