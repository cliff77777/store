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

            $table->string("status")->comment("商品狀態")->default("c"); //c建立中 s販賣中
            $table->string("name")->comment("商品名稱"); //商品名稱
            $table->string("name_en")->comment("商品名稱英文")->nullable(); //商品名稱英文
            $table->text("introduction")->comment("商品介紹"); //商品介紹
            $table->text("introduction_en")->comment("商品介紹英文")->nullable(); //商品介紹英文
            $table->string("photo")->comment("商品圖片")->nullable(); //商品圖片
            $table->integer("price")->comment("價格"); //價格
            $table->integer("count")->comment("數量"); //數量

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
