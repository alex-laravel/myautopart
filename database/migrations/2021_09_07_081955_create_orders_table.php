<?php

use App\Models\Shop\Order\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sh_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('quantity');
            $table->decimal('total', 13, 4);
            $table->string('status', 25)->default(Order::ORDER_STATUS_PENDING);
            $table->string('payment_method', 25)->nullable();
            $table->boolean('payment_status')->default(false);
            $table->string('phone_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('country');
            $table->string('post_code');
            $table->text('address');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sh_orders');
    }
}
