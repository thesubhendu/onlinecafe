<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendorFreeProductToFreeCategoryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign('vendors_free_product_foreign');
            $table->dropColumn('free_product');
            $table->unsignedBigInteger('free_category')->after('max_stamps')->nullable();
            $table->foreign('free_category')->references('id')->on('product_categories');
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
            $table->dropForeign('vendors_free_category_foreign');
            $table->dropColumn('free_category');
            $table->unsignedBigInteger('free_product')->after('max_stamps')->nullable();
            $table->foreign('free_product')->references('id')->on('products');
        });
    }
}
