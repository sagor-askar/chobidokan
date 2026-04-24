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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('designer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('amount')->default(0);
            $table->string('card_type')->nullable();
            $table->string('bank_txn')->nullable();
            $table->string('is_counted')->default(0);
            $table->integer('designer_paid_status')->default(0)->comment("0=Unpaid,1= Paid");
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
};
