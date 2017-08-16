<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDesignationTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('designation', function (Blueprint $table) {
            $table->integer('team_id');
            $table->foreign('team_id')->references('id')->on('team');
        });
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designation', function($table) {
            $table->dropColumn('team_id');
        });
    }
}
