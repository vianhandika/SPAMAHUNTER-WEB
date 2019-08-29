<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('userpict');
            $table->longText('comment');
            $table->timestamps();

            $table->unsignedInteger('id_event');
            $table  ->foreign('id_event')
                    ->references('id')
                    ->on('events');

            $table->unsignedInteger('id_user');
            $table  ->foreign('id_user')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_comments');
    }
}
