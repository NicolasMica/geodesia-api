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
            $table->text('description')
                ->nullable();

            $table->float('from_lat')
                ->comment("Projection 3857");

            $table->float('from_long')
                ->comment("Projection 3857");

            $table->float('to_lat')
                ->comment("Projection 3857");

            $table->float('to_long')
                ->comment("Projection 3857");

            $table->unsignedInteger('user_id')
              ->foreign('user_id')
              ->references('id')
              ->on('users');

            $table->string('referent');
            $table->string('department');
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
