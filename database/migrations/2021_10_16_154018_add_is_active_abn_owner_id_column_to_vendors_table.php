<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveAbnOwnerIdColumnToVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->foreignId('owner_id')->default(1)->constrained('users');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_subscribed')->default(false);
            $table->string('abn', 15)->nullable();

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
            $table->dropForeign('vendors_owner_id_foreign');
            $table->dropColumn(['is_active', 'abn','owner_id','is_subscribed']);
        });
    }
}
