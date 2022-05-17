<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendorProductOptionsTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_product_options', function (Blueprint $table) {
            $table->dropColumn('options');
            $table->dropForeign('vendor_product_options_category_id_foreign');
            $table->dropColumn('category_id');
            $table->foreignId('option_type_id')->after('image')->references('id')->on('option_types')->onDelete('cascade');
            $table->boolean('charge')->after('option_type_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_product_options', function (Blueprint $table) {
            $table->dropColumn('charge');
            $table->dropForeign('vendor_product_options_option_type_id_foreign');
            $table->dropColumn('option_type_id');
            $table->json('options')->after('image')->nullable();
            $table->foreignId('category_id')->after('options')->constrained('product_categories');
        });

    }
}
