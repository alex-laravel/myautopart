<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleIdsWithStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_article_ids_with_state', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('articleId');
            $table->unsignedBigInteger('articleLinkId');
            $table->string('articleNo', 250);
            $table->unsignedInteger('articleStateId');
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('brandNo');
            $table->string('brandName', 250);
            $table->unsignedBigInteger('genericArticleId');
            $table->string('genericArticleName', 250);
            $table->unsignedBigInteger('sortNo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_article_ids_with_state');
    }
}
