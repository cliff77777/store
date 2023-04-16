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
        Schema::create('product_ablums', function (Blueprint $table) {
            $table->id();
            
            $table->string("merchandise_id")->comment("商品編號");//商品編號
            $table->string("photo_name")->comment("圖片名稱");//圖片名稱
            $table->string("photo_origin_name")->comment("原始圖片名稱");//原始圖片名稱
            $table->string("photo_order")->comment("圖片順序");//圖片順序

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
        Schema::dropIfExists('product_ablums');
    }
};
