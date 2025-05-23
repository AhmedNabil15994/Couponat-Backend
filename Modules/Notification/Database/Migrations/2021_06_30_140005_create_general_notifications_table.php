<?php

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_notifications', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('body');
            $table->bigInteger('notifiable_id')->nullable();
            $table->string('notifiable_type')->nullable();
            $table->dateTime('send_at')->nullable();
            $table->integer('is_sent')->default(0);
            $table->softDeletes();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('general_notifications');
    }
}
