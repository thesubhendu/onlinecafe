<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            $table->decimal('price', 4, 2);
            $table->foreignId('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
        Schema::dropIfExists('vendor_product_sizes');
    }

}
