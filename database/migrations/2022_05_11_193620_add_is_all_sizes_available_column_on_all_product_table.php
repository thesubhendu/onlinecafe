<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAllSizesAvailableColumnOnAllProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('all_products', function (Blueprint $table) {
            $table->boolean('is_all_sizes_available')->after('category_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_products', function (Blueprint $table) {
            $table->dropColumn('is_all_sizes_available');
        });
    }
}
