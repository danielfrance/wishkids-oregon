<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGranters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('granters', function (Blueprint $table) {
            $table->string('cell')->nullable()->change();
            $table->string('Home_phone')->nullable()->change();
        });

        Schema::table('kids', function (Blueprint $table) {
            $table->dropColumn('waiting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
