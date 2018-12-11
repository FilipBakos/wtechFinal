<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->boolean('payed');
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('email');
            $table->string('phone');
            $table->string('street');
            $table->string('house_number');
            $table->string('city');
            $table->string('psc');
            $table->string('payment_method');
            $table->string('logistic_method');
            $table->boolean('done');
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
        Schema::dropIfExists('orders');
    }
}
