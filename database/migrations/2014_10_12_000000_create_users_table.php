<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //會員姓名
            $table->string('email')->unique(); //會員帳號/信箱
            $table->timestamp('email_verified_at')->nullable(); //郵件驗證
            $table->string('type','1')->default('g'); //會員身分權限 g:一般會員 a:管理員
            $table->string('password'); //密碼
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
