<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id');
            $table->enum('type_of_expense', ['transport', 'accommodation', 'allowance']);
            $table->text('description')->nullable();
            $table->double('cost');
            $table->timestamps();

            $table->foreign('expense_id')->references('id')
                ->on('expenses')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_details');
    }
}
