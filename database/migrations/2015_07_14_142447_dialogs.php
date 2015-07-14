<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dialogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('messages')->delete();
        Schema::create('dialogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->timestamps();
        });
        Schema::table('messages', function(Blueprint $table) {
            $table->integer('dialog_id');
            $table->dropColumn('to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->integer('to');
            $table->dropColumn('dialog_id');
        });
        Schema::drop('dialogs');

    }
}
