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
            $table->dateTime('date')->default(now());
            $table->string('order_number');
            $table->timestamp('confirmed_at')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable()
                  ->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['in_store', 'credit_card'])
                  ->default('in_store');
            $table->integer('order_total');
            $table->unsignedBigInteger('user_id')
                  ->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')
                  ->constrained()->onDelete('cascade');

            $table->unsignedInteger('free_products_claimed')->default(0);
            $table->foreignId('card_id')->nullable()->constrained();
            $table->unsignedInteger('stamp_count')->default(0);
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
