<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('designation_id')->nullable();
            $table->bigInteger('supervisor_id')->nullable();
            $table->string('employee_id')->unique()->nullable();
            $table->double('mobile')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('blood_group', 15)->nullable();
            $table->date('joining_date')->nullable();
            $table->double('accommodation_cost')->nullable();
            $table->double('daily_allowance_cost')->nullable();
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
        Schema::dropIfExists('employee_details');
    }
}
