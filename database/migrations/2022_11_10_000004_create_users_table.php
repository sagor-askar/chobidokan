<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('verification_code')->nullable();
            $table->integer('is_verified')->default(0)->comment('0=>Unverified, 1=>Verified');
            $table->integer('role_id');
            $table->integer('is_banned')->default(0)->comment('0=>Unbanned, 1=>Banned');
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->longText('bio')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('routing_no')->nullable();
            $table->string('account_type')->nullable();
            $table->string('mobile_banking_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
