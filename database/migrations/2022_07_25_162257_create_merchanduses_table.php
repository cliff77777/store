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
        Schema::create('Merchandises', function (Blueprint $table) {
            $table->id();

            $table->string("status")->commit("商品狀態")->default("c"); //c建立中 s販賣中
            $table->string("name")->commit("商品名稱"); //商品名稱
            $table->string("name_en")->commit("商品名稱英文")->nullable(); //商品名稱英文
            $table->text("introduction")->commit("商品介紹"); //商品介紹
            $table->text("introduction_en")->commit("商品介紹英文")->nullable(); //商品介紹英文
            $table->string("photo")->commit("商品圖片")->nullable(); //商品圖片
            $table->integer("price")->commit("價格"); //價格
            $table->integer("count")->commit("數量"); //數量

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
        Schema::dropIfExists('Merchandises');
    }
};
