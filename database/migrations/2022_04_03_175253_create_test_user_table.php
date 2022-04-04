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
        Schema::create('user_test_result_answer', function (Blueprint $table) {
            $table->bigInteger('user_test_result_id')->unsigned();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('answer_id')->unsigned()->nullable();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('user_test_result_id')->references('id')->on('user_test_result');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_test_result_answer');
    }
};
