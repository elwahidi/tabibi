<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('address');
            $table->integer('build');
            $table->integer('floor');
            $table->integer('apt_nbr');
            $table->integer('zip');
            $table->unsignedBigInteger('visit_nbr')->nullable();

            $table->unsignedBigInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('owner_id')->index();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->unsignedBigInteger('creator_id')->index();
            $table->foreign('creator_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('establishment_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('establishment_id')->index();
            $table->foreign('establishment_id')->references('id')
                ->on('establishments');

            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')
                ->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
    }
}
