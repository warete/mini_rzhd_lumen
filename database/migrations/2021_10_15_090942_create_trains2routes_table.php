<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrains2routesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains2routes', function (Blueprint $table) {
            $table->id();
            $table->integer('train_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->foreign('train_id')->references('id')->on('trains');
            $table->foreign('route_id')->references('id')->on('routes');
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
        Schema::dropIfExists('trains2routes');
    }
}
