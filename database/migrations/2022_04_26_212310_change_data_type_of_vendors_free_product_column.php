<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeOfVendorsFreeProductColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function(Blueprint $table){
            $table->unsignedBigInteger('free_product')->change();
            $table->foreign('free_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign('vendors_free_product_foreign');
            $table->string('free_product')->nullable()->change();
        });
    }
}
