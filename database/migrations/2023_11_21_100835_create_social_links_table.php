<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->bigIncrements('soc_id');
            $table->string('sc_name')->length(100);
            $table->string('sc_icon')->length(100);
            $table->longText('sc_link')->nullable();
            $table->integer('sc_show', false, false)->length(1)->comment('0:Hide, 1:Show')->default(0);
            $table->timestamps();

            $table->index(['sc_name', 'sc_icon'], 'social_links_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_links');
    }
}
