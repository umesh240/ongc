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
        Schema::create('contactsos', function (Blueprint $table) {
            $table->bigIncrements('cs_id');
            $table->string('email_id', 200)->nullable();
            $table->string('phone_no', 100)->nullable();
            $table->longText('sos_info')->nullable();
            $table->integer('create_by', false, false)->length(6)->nullable();
            $table->timestamps();
        });

        $data = [];
        $data['email_id'] = Null;
        $data['phone_no'] = Null;
        $data['sos_info'] = Null;
        $data['create_by'] = Null;
        $data['created_at'] = date('Y-m-d H:i:s');

        $runQuery = DB::table('contactsos')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactsos');
    }
};
