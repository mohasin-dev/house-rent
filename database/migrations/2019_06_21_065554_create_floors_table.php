<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('house_id')->unsigned();
            $table->string('name')->unique();
            $table->string('area')->nullable();
            $table->string('flat_number')->nullable();
            $table->foreign('house_id')
                ->references('id')->on('houses')
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
        Schema::dropIfExists('floors');
    }
}
