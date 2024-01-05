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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('ev_id');
            $table->string('event_name', 200);
            $table->longText('event_location', 250)->nullable();
            $table->longText('event_mapurl', 4250)->nullable();
            $table->timestamp('event_datefr')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('event_dateto')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->longText('day_wise')->nullable();
            $table->longText('date_wise')->nullable();
            $table->string('pdf_path', 200)->nullable();
            $table->integer('create_by', false, false)->length(6);
            $table->integer('actv_event', false, false)->length(1)->comment('1:Active, 2:Expired')->default(1);
            $table->string('event_city', 100)->nullable();
            $table->timestamp('last_update')->nullable();
            $table->longText('weather_result')->nullable();
            $table->longText('airports')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
