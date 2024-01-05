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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf_no')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('level')->nullable();
            $table->string('designation')->nullable();
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->integer('user_type', false, false)->length(1)->comment('0:Superadmin, 1:Admin, 2:Employee, 3:Hotel')->default(2);
            $table->integer('actv_status', false, false)->length(1)->comment('1:Active, 2:Deleted')->default(1);
            $table->integer('create_by', false, false)->length(10)->default(0);
            $table->integer('cur_event', false, false)->length(10)->nullable();
            $table->integer('cur_hotel', false, false)->length(10)->nullable();
            $table->integer('cur_category', false, false)->length(10)->nullable();
            $table->rememberToken();
            $table->string('login_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
