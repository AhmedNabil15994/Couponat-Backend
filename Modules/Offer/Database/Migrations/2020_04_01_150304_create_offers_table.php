<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->json('details')->nullable();
            $table->json('discount_title')->nullable();
            $table->json('discount_desc')->nullable();
            $table->double('price');
            $table->integer('quantity')->nullable();
            $table->integer('user_max_uses')->nullable();
            $table->date('start_at')->nullable();
            $table->date('expired_at')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('video')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->date('user_valid_from')->nullable();
            $table->date('user_valid_until')->nullable();
            $table->text('address_link')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_published')->default(false);
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
