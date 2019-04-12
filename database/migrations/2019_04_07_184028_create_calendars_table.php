<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('from');
            $table->time('to');
            $table->date('day');


            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')
                ->on('users');


            $table->unsignedBigInteger('establishment_id')->index();
            $table->foreign('establishment_id')->references('id')
                ->on('establishments');

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
        Schema::dropIfExists('calendars');
    }
}
