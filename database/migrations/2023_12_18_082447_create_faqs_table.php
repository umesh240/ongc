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
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('faq_id');
            $table->longText('question');
            $table->longText('answer');
            $table->integer('create_by', false, false)->length(5)->default(0);
            $table->timestamps();
            $table->timestamp('delete_date')->nullable();
            $table->integer('delete_yn', false, false)->length(1)->comment('1:Deleted')->default(0);
            $table->integer('order_by', false, false)->length(5)->default(0);
            
            $table->index(['question', 'create_by', 'delete_yn', 'answer'], 'faqs_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
