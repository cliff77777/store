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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string("user_id")->commit("會員編號");//會員編號
            $table->string("merchandise_id")->commit("商品編號");//商品編號
            $table->integer("price")->commit("購買價格");//購買價格
            $table->integer("buy_count")->commit("購買數量");//購買數量
            $table->integer("total_price")->commit("總金額");//總金額

            $table->timestamps();

            //索引
            $table->index(["user_id"],'user_transaction_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
