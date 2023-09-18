<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedCoupounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used__coupouns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->bigInteger('coupon_id')->unsigned();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
        Schema::dropIfExists('used__coupouns');
    }
}
