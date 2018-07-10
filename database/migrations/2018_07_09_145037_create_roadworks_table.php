<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoadworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadworks', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->text('description');

            $table->text('geometry');

            $table->unsignedInteger('user_id')
              ->foreign('user_id')
              ->on('users');

            $table->string('referent');

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
        Schema::dropIfExists('roadworks');
    }
}
