<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('floor_id')->unsigned();
            $table->string('name')->unique();
            $table->string('area')->nullable();
            $table->string('room_number')->nullable();
            $table->string('rent')->nullable();
            $table->string('electricity_bill')->nullable();
            $table->string('gass_bill')->nullable();
            $table->string('water_bill')->nullable();
            $table->string('others_bill')->nullable();
            $table->foreign('floor_id')
                ->references('id')->on('floors')
                ->onDelete('cascade');
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
        Schema::dropIfExists('flats');
    }
}
