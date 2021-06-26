<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_model_series', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manuId');
            $table->unsignedInteger('modelId');
            $table->string('modelname', 150);
            $table->unsignedInteger('yearOfConstrFrom')->nullable();
            $table->unsignedInteger('yearOfConstrTo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_model_series');
    }
}
