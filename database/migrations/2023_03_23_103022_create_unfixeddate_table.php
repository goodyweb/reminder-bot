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
        Schema::create('unfixeddate', function (Blueprint $table) {
            $table->id();
            $table->int('user_id')->unsigned();
            $table->string('details');
            $table->string('webhook');
            $table->int('month');
            $table->int('week');
            $table->int('day');
            $table->int('year');
            $table->string('frequency');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('unfixeddate');
    }
};
