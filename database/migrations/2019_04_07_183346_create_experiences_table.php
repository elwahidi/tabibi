<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('experience')->default(false);
            $table->string('name');
            $table->string('address');
            $table->unsignedBigInteger('build');
            $table->unsignedBigInteger('floor')->nullable();
            $table->unsignedBigInteger('apt_nbr')->nullable();
            $table->unsignedBigInteger('zip')->nullable();
            $table->year('start');
            $table->year('end')->nullable();

            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('doctor_id')
                ->on('users');

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
        Schema::dropIfExists('experiences');
    }
}
