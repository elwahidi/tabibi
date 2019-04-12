<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('invoice');
            $table->date('date');
            $table->unsignedDecimal('price',65);
            $table->string('serial')->nullable();

            $table->unsignedBigInteger('establishment_id')->index();
            $table->foreign('establishment_id')->references('id')
                ->on('establishments');

            $table->unsignedBigInteger('created_by')->index();
            $table->foreign('created_by')->references('id')
                ->on('users');

            $table->unsignedBigInteger('payment_method_id')->index();
            $table->foreign('payment_method_id')->references('id')
                ->on('payment_methods');

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
        Schema::dropIfExists('invoices');
    }
}
