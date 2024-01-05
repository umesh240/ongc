<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizs', function (Blueprint $table) {
            $table->bigIncrements('qz_id');
            $table->longText('question');
            $table->longText('option_1');
            $table->longText('option_2');
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();
            $table->integer('answer', false, false)->length(1)->default(0);
            $table->integer('user_id', false, false)->length(10);
            $table->integer('used_times', false, false)->length(10)->default(0);
            $table->timestamps();
            $table->timestamp('delete_date')->nullable();
            $table->integer('delete_yn', false, false)->length(1)->comment('1:Deleted')->default(0);

            $table->index(['question', 'option_1', 'option_2', 'option_3', 'option_4', 'answer'], 'quizs_index');
        });

        Schema::create('quiz_user', function (Blueprint $table) {
            $table->bigIncrements('qu_id');
            $table->longText('all_answers');
            $table->integer('ttl_question', false, false)->length(10)->default(0);
            $table->integer('right_question', false, false)->length(10)->default(0);
            $table->integer('wrong_question', false, false)->length(10)->default(0);
            $table->integer('user_id', false, false)->length(10);
            $table->integer('emp_event_id', false, false)->length(10)->default(0);
            $table->timestamps();

            $table->index(['qu_id', 'ttl_question', 'right_question', 'wrong_question', 'user_id', 'emp_event_id'], 'quiz_user_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizs');
        Schema::dropIfExists('quiz_user');
    }
};
