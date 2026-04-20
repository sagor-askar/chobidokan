<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_download_products', function (Blueprint $table) {
            $table->integer('designer_paid_status')->default(0)->after('product_id')->comment("0=Unpaid,1= Paid");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_download_products', function (Blueprint $table) {
            $table->dropColumn('designer_paid_status');
        });
    }
};
