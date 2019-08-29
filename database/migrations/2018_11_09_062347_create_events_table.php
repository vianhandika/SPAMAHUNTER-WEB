<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title')->unique();
            $table->string('type');
            $table->string('place');
            $table->string('image');
            $table->longText('description');

            $table->string('date_start');
            $table->string('date_end');
            $table->string('time_start');
            $table->string('time_end');

            $table->smallInteger('highlight');
            $table->smallInteger('verify');
            $table->timestamps();

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
        Schema::dropIfExists('events');
    }
}
