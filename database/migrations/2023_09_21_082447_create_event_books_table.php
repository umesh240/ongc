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
        Schema::create('event_books', function (Blueprint $table) {
            $table->bigIncrements('ev_book_id');
            $table->integer('event_cd', false, false)->length(10);
            $table->integer('hotel_cd', false, false)->length(10);
            $table->integer('hotel_cat_cd', false, false)->length(10);
            $table->string('employee_cds', 100);
            $table->string('employee_cds_info', 240);
            $table->integer('ev_create_by', false, false)->length(10)->default(0);
            $table->timestamps();
        });
        Schema::create('event_books_emp', function (Blueprint $table) {
            $table->bigIncrements('emp_ev_book_id');
            $table->integer('event_book_id', false, false)->length(10);
            $table->integer('emp_cd', false, false)->length(10);
            $table->integer('emp_event_cd', false, false)->length(10);
            $table->integer('emp_hotel_cd', false, false)->length(10);
            $table->integer('emp_hotel_cat_cd', false, false)->length(10);
            $table->string('share_room_with_empcd', 200)->nullable();
            $table->string('arv_flight_name', 100)->nullable();
            $table->string('arv_flight_no', 100)->nullable();
            $table->timestamp('arv_date_time')->nullable();
            $table->longText('arv_location')->nullable();
            $table->string('dptr_flight_name', 100)->nullable();
            $table->string('dptr_flight_no', 100)->nullable();
            $table->timestamp('dptr_date_time')->nullable();
            $table->longText('dptr_location')->nullable();
            $table->integer('flight_status', false, false)->length(1)->comment('0:Active, 1:Expired')->default(0);
            $table->timestamp('flight_create_date')->nullable();
            $table->longText('drvr_name')->nullable();
            $table->longText('drvr_number')->nullable();
            $table->longText('drvr_veh_details')->nullable();
            $table->integer('ev_emp_create_by', false, false)->length(10)->default(0);
            $table->integer('status_in_htl', false, false)->length(1)->comment('1:Active, 0:Deactive')->default(1);
            $table->timestamps();
            $table->timestamp('assign_check_in')->nullable();
            $table->timestamp('assign_check_out')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->integer('print_status', false, false)->length(6)->default(0);
            $table->integer('req_chng_hotel_cd', false, false)->length(10)->nullable();
            $table->integer('req_chng_hotel_cat_cd', false, false)->length(10)->nullable();
            $table->string('req_chng_instraction', 100)->nullable();
            $table->timestamp('req_chng_date')->nullable();
            $table->integer('req_chng_status', false, false)->length(1)->comment('0:NA, 1:Request, 2:Verified, 3:Rejected')->default(0);
            $table->string('user_name', 100)->nullable();
            $table->string('user_cpfno', 20)->nullable();
            $table->string('user_email', 100)->nullable();
            $table->string('user_mobile', 50)->nullable();
            $table->string('user_level', 10)->nullable();
            $table->string('user_designation', 100)->nullable();
            $table->string('user_category', 30)->nullable();
            $table->string('user_location', 30)->nullable();
            $table->string('cancel_type', 240)->nullable();
            $table->string('cancel_reason', 240)->nullable();
            $table->timestamp('cancel_date')->nullable();
            $table->integer('cancel_status', false, false)->length(1)->comment('0:NA, 1:Cancelled')->default(0);
            $table->longText('all_feedbacks')->nullable();
            $table->string('suggestion', 240)->nullable();
            $table->integer('feedbacks_submit', false, false)->length(1)->comment('0:No, 1:Yes')->default(0);

            $table->index(['user_name', 'user_cpfno', 'user_email', 'user_mobile', 'user_level', 'user_designation', 'user_category', 'emp_hotel_cd', 'emp_hotel_cat_cd'], 'event_books_emp_index'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_books');
        Schema::dropIfExists('event_books_emp');
    }
};
