<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id('id');
            $table->string('vendor_name')->unique();
            $table->string('slug')->unique();
            $table->string('contact_name');
            $table->string('contact_lastname');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('address');
            $table->string('suburb');
            $table->string('pc');
            $table->string('state');
            $table->string('cardstamps');
            $table->string('vendor_image');
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
        Schema::dropIfExists('vendors');
    }
}
