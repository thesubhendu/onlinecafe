<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('contact_name')->nullable()->change();
            $table->string('contact_lastname')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('mobile')->nullable()->change();
            $table->string('pc')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('address')->nullable()->change();
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
            $table->string('contact_name')->change();
            $table->string('contact_lastname')->change();
            $table->string('email')->unique()->change();
            $table->string('mobile')->unique()->change();
            $table->string('pc')->change();
            $table->string('state')->change();
            $table->string('address')->change();
        });
    }
}
