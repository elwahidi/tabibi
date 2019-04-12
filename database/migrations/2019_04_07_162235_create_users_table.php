<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('face')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->date('birth')->nullable();
            $table->string('address');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('visit_nbr')->nullable();

            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('specialty_id')->index()->nullable();
            $table->foreign('specialty_id')->references('id')->on('specialties');

            $table->unsignedBigInteger('sexe_id')->index();
            $table->foreign('sexe_id')->references('id')->on('sexes');

            $table->unsignedBigInteger('city_id')->index()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');


            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
