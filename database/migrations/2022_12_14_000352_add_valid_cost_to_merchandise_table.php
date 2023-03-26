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
        Schema::table('merchandises', function (Blueprint $table) {
            // 
            $table->string("valid")->commit("商品有效性")->default("1");//商品有效性
            $table->integer("sales")->commit("銷售量")->after("price")->nullable();//銷售量
            $table->integer("cost")->commit("成本")->after("price");//成本
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchandise', function (Blueprint $table) {
            //
        });
    }
};
