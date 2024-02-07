<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('granters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('cell');
            $table->string('home_phone');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sex');
            $table->string('image');
            $table->integer('age');
            $table->binary('bio');
            $table->string('illness');
            $table->string('city');
            $table->string('treatment_center');
            $table->string('language');
            $table->string('wish');
            $table->string('waiting');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('granters_kids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('granters_id')->unsigned();
            $table->foreign('granters_id')->references('id')->on('granters');
            $table->integer('kids_id')->unsigned();
            $table->foreign('kids_id')->references('id')->on('kids');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropifExists('granters');
        Schema::dropifExists('kids');
        Schema::dropifExists('granters_kids');
        Schema::dropifExists('content');
        Schema::enableForeignKeyConstraints();
    }
}
