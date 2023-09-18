<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('children_id')->unsigned();
            $table->double('unit_price')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
            $table->foreign('parent_id')->references('id')->on('sections')->onDelete('cascade')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->nullable();
            $table->foreign('children_id')->references('id')->on('sections')->onDelete('cascade')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->double('cost')->nullable();
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->nullable();
            $table->dateTime('date')->nullable();
            $table->enum('payment_method',['cash','visa'])->nullable();
            $table->enum('status',['rejected','pending','approved'])->nullable();
            $table->double('price')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
