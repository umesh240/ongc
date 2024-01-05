<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->bigIncrements('ldr_id');
            $table->string('l_name')->length(100);
            $table->string('l_post')->length(240);
            $table->string('l_photo')->length(240);
            $table->longText('l_about')->nullable();
            $table->timestamps();
            $table->integer('create_by', false, false)->length(10)->default(0);
            $table->integer('delete_status', false, false)->length(1)->comment('1:Deleted')->default(0);
            $table->timestamp('delete_date')->nullable();
            $table->integer('order_by', false, false)->length(5)->default(0);

            $table->index(['l_name', 'l_post'], 'leaders_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaders');
    }
}
