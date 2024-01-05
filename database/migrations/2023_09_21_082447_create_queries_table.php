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
        Schema::create('queries', function (Blueprint $table) {
            $table->bigIncrements('qur_id');
            $table->integer('event_id', false, false)->length(10)->nullable();
            $table->integer('user_id', false, false)->length(10);
            $table->longText('query_type');
            $table->longText('query')->nullable();
            $table->integer('query_status', false, false)->length(1)->comment('0:NA, 1:Applied, 2:Responed')->default(0);
            $table->longText('response')->nullable();
            $table->integer('response_by', false, false)->length(10)->default(0);
            $table->timestamps();

            $table->index(['event_id', 'user_id', 'query_type', 'query_status', 'response_by'], 'queries_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
