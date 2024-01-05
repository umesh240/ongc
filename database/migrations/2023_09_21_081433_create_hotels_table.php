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
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('htl_id');
            $table->string('hotel_name', 200);
            $table->longText('hotel_address')->nullable();
            $table->longText('hotel_geolocation')->nullable();
            $table->longText('hotel_image', 500)->nullable();
            $table->string('image_path', 200)->nullable();
            $table->integer('create_by', false, false)->length(6);
            $table->integer('actv_hotel', false, false)->length(1)->comment('1:Active, 2:Expired')->default(1);
            $table->integer('evv_id', false, false)->length(10);
            $table->integer('distance', false, false)->length(6)->default(0)->comment('In KM');
            $table->integer('minutes', false, false)->length(6)->default(0)->comment('In Mins');
            $table->integer('logistic_fpr', false, false)->length(10)->nullable();
            $table->string('fpr_name', 200)->nullable();
            $table->string('fpr_mob_no', 50)->nullable();
            $table->integer('hospitality_fpr', false, false)->length(10)->nullable();
            $table->string('hosp_fpr_name', 200)->nullable();
            $table->string('hosp_fpr_mob_no', 50)->nullable();
            $table->timestamps();
        });
        Schema::create('hotels_category', function (Blueprint $table) {
            $table->bigIncrements('htl_cat_id');
            $table->unsignedBigInteger('htl_idd');
            $table->integer('evv_id', false, false)->length(10);
            $table->string('hotel_nm', 200);
            $table->string('hotel_category', 200);
            $table->string('room_level', 10)->nullable();
            $table->integer('total_rooms', false, false)->length(10);
            $table->integer('occupied_rooms', false, false)->length(10);
            $table->integer('vacent_rooms', false, false)->length(10);
            $table->integer('create_by', false, false)->length(10);
            $table->integer('soft_delete_yn', false, false)->length(1)->comment('1:Yes, 0:No')->default(0);
            $table->timestamp('soft_delete_date')->nullable();
            $table->timestamps();
            $table->foreign('htl_idd')->references('htl_id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('hotels_category');
    }
};
