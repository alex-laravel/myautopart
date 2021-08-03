<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sh_distributor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distributor_storage_id');

            $table->string('product_barcode', 255)->nullable();
            $table->string('product_original_no', 255);
            $table->string('product_local_no', 255)->nullable();
            $table->string('product_local_name', 255)->nullable();
            $table->string('product_band_name', 255)->nullable();

            $table->decimal('price', 13, 4);
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->timestamps();

            $table->foreign('distributor_storage_id')
                ->references('id')
                ->on('sh_distributor_storages')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sh_distributor_products');
    }
}
