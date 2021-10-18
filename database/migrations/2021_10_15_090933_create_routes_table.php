<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('station_from_id')->unsigned();
            $table->integer('station_to_id')->unsigned();
            $table->decimal('price');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->foreign('station_from_id')->references('id')->on('stations');
            $table->foreign('station_to_id')->references('id')->on('stations');
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
        Schema::dropIfExists('routes');
    }
}
