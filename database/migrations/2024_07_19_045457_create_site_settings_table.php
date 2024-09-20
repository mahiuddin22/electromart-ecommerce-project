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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('alt_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('copyright')->nullable();
            $table->string('madeby')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
};
