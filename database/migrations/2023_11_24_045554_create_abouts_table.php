<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->binary('about_ongc')->nullable();
            $table->binary('about_iew')->nullable();
            $table->binary('about_local_event')->nullable();

            //$table->index(['about_iew', 'about_ongc', 'about_local_event'], 'abouts_index');
        });

        $aboutsData = [];
        $aboutsData['about_ongc'] = $aboutsData['about_iew'] = $aboutsData['about_local_event'] = NULL;
        $queryUpdate = DB::table('abouts')->insert($aboutsData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
