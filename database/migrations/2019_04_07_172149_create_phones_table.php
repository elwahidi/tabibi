<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone')->index();

            $table->unsignedBigInteger('establishment_id')->index()->nullable();
            $table->foreign('establishment_id')->references('establishment_id')
                ->on('establishments');

            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('user_id')
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
        Schema::dropIfExists('phones');
    }
}
