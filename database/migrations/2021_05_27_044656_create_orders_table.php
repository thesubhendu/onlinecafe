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
            $table->string('payment_method')
                  ->default('in_store');
            $table->unsignedBigInteger('user_id')
                  ->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')
                  ->constrained()->onDelete('cascade');
            $table->decimal('order_total')->default(0);
            $table->decimal('sub_total')->default(0);
            $table->decimal('tax')->default(0);
            $table->string('status');
            $table->unsignedInteger('free_products_claimed')->default(0);
            $table->unsignedBigInteger('card_id')->nullable();
            $table->unsignedInteger('stamp_count')->default(0);
            $table->boolean('is_paid')->default(false);

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
