<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('order_number');
            $table->boolean('is_confirmed')->default(false);
            $table->enum('payment_method', ['in_store', 'credit_card'])->default('in_store');
            $table->integer('order_total');
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
