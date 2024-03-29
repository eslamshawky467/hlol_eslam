<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('device_token')->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->string('phone_number')->unique();
            $table->string('image')->nullable();
            $table->string('country_code')->nullable();
            $table->integer('is_registered')->default(0);
            $table->enum('status',['active','inactive'])->nullable();
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
        Schema::dropIfExists('clients');
    }
}
