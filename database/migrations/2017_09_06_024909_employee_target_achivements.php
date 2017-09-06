<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeTargetAchivement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_target_achivement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('employee_factor_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('employee_factor_id')->references('id')->on('employee_factor');
            $table->string('factor_name', 255);
            $table->integer('target');
            $table->integer('achived');
            $table->integer('year');
            $table->integer('month');
            $table->date('issued_date');
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
        Schema::dropIfExists('employee_target_achivement');
    }
}
