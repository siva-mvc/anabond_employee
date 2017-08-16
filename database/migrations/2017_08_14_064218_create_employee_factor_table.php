<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeFactorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_factor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('performance_factor_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('performance_factor_id')->references('id')->on('performance_factor');
            $table->integer('target');
            $table->integer('order_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_factor');
    }
}
