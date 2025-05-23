<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {


            $table->unsignedBigInteger("offer_id");
            $table->foreign('offer_id')
                                ->references('id')->on('offers')
                                ->onUpdated("cascade")
                                ->onDelete('cascade');


            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                                ->references('id')->on('users')
                                ->onUpdated("cascade")
                                ->onDelete('cascade');
            $table->primary(["offer_id", "user_id"]);

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
        Schema::dropIfExists('favorites');
    }
}
