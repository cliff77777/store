<?php

use Illuminate\Support\Facades\Route;

// controller位置
use App\Http\Controllers\user\UserAuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Merchandise\MerchandiseController;
use App\Http\Controllers\HomePage\HomePageController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'homepage'],function(){
    //首頁
    Route::get('/index',[HomePageController::class,'index'])->name('home_page');
});

Route::group(['prefix'=>'dashboard'],function(){
    //儀錶板
    Route::get('/index',[DashboardController::class,'index'])->name('dashboard');
});

Route::group(['prefix'=>'user'],function(){
    //使用者驗證
    Route::group(['prefix'=>'auth'],function(){
        // 註冊頁面
        Route::get('/sign_up',[UserAuthController::class,'signUpPage'])->name('signUpPage');
        // 增加會員
        Route::post('/addUser','App\Http\Controllers\user\UserAuthController@addUser');
        // Route::get('/sign_up','App\Http\controllers\user\UserAuthController@signUpPage');

        //登入頁面
        Route::get('/sign_in',[UserAuthController::class,'signIn'])->name('signInPage');
        Route::post('/signInHandle',[UserAuthController::class,'signInHandle']);
        Route::get('/sign_out',[UserAuthController::class,'signOut']);

    });
});

Route::group(['prefix'=>'merchandise'],function(){
        //權限中介層
    Route::group(['middleware'=>['user.auth.admin']],function(){
        //商品頁面
        Route::get('/',[MerchandiseController::class,'merchandiseList']);
        //新增商品
        Route::get('/create',[MerchandiseController::class,'createProductPage']);
        Route::post('/create_product_process',[MerchandiseController::class,'createProductProcess']);
        //修改商品
        Route::get('/edit/{id}',[MerchandiseController::class,'edit']);
        Route::post('/product_update',[MerchandiseController::class,'productUpdateProcess']);
        Route::post('/edit_product_process',[MerchandiseController::class,'editProductProcess']);
        //刪除商品
        Route::post('/del_product',[MerchandiseController::class,'softDel']);
        Route::get('/merchandise_index/{id}',[MerchandiseController::class,'merchandise_index']);
    }); 
    //商品中心
    Route ::get('/MerchandiseCenter',[MerchandiseController::class,'MerchandiseCenter']);
    Route::post('/buy','MerchandiseController@productBuy');



});
