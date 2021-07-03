<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblyGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_assembly_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('assemblyGroupNodeId');
            $table->string('assemblyGroupName', 250);
            $table->string('linkingTargetType', 5);
            $table->unsignedBigInteger('shortCutId')->nullable()->default(null);
            $table->unsignedBigInteger('parentNodeId')->nullable()->default(null);
            $table->boolean('hasChilds');
            $table->boolean('isVisible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_assembly_groups');
    }
}
