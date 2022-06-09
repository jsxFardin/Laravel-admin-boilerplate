<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_type_id');
            $table->bigInteger('destination_id')->nullable();

            $table->text('description')->nullable();
            $table->timestamp('duration_to')->nullable();
            $table->timestamp('duration_form')->nullable();
            $table->double('amount')->nullable();

            $table->enum('status', [1, 0])->default(0); // 0 = pending, 1 = approved
            $table->foreignId('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('updated_at')->nullable(); //approved_at 


            $table->foreign('created_by')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
