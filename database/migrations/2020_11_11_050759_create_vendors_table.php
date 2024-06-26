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
            $table->string('stripe_account_id', 100)->nullable();

            $table->string('shop_email')->unique()->nullable();
            $table->string('shop_mobile')->unique()->nullable();
            $table->string('address');
            $table->string('suburb')->nullable();
            $table->string('pc');
            $table->string('state');
            $table->string('vendor_image')->nullable();
            $table->string('vendor_logo')->nullable();
            $table->foreignId('owner_id')->default(1)->constrained('users');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_subscribed')->default(false);
            $table->string('abn', 15)->nullable();
            $table->string('shop_name', 60)->nullable();
            $table->text('description')->nullable();
            $table->json('opening_hours')->nullable();
            $table->json('services')->nullable();

            $table->integer('max_stamps')->nullable();
            $table->unsignedBigInteger('free_category')->nullable();
            $table->foreign('free_category')->references('id')->on('product_categories');
            $table->integer('get_free')->nullable();


            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->boolean('is_rewarding_active')->default(true);
            $table->timestamp('charges_enabled_at')->nullable();

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
