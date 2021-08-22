<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manuId');
            $table->string('manuName', 150);
            $table->string('slug', 150);
            $table->boolean('favorFlag');
            $table->boolean('isPopular');
            $table->boolean('isVisible');
            $table->index('manuId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_manufacturers');
    }
}
