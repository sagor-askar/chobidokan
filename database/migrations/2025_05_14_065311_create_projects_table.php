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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->longText('project_description')->nullable();
            $table->longText('logo_description')->nullable();
            $table->string('project_file')->nullable();
            $table->date('publish_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->default(1)->comment('1=>Active, 0=>Inactive,2=Completed');
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
        Schema::dropIfExists('projects');
    }
};
