<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markers', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->text('description');

            $table->float('latitude');

            $table->float('longitude');

            $table->unsignedInteger('user_id')
              ->foreign('user_id')
              ->references('id')
              ->on('users');

            $table->unsignedInteger('roadwork_id')
              ->foreign('roadwork_id')
              ->references('id')
              ->on('roadworks');

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
        Schema::dropIfExists('markers');
    }
}
