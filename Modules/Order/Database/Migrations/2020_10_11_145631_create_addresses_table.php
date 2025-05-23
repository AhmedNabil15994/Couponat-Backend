<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->text('address')->nullable();
            $table->string('type')->nullable();
            $table->string('mobile')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('city')->nullable();
            $table->string('flat')->nullable();
            $table->string('floor')->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('addresses');
    }
}
