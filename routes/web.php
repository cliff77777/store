<?php

use Illuminate\Support\Facades\Route;

// controller位置
use App\Http\Controllers\user\UserAuthController;
use App\Http\Controllers\Dashboard\DashboardController;

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
        Route::post('/addUser','App\Http\controllers\user\UserAuthController@addUser');
        // Route::get('/sign_up','App\Http\controllers\user\UserAuthController@signUpPage');

        //登入頁面
        Route::get('/sign_in','App\Http\controllers\user\UserAuthController@signIn')->name('signInPage');
        Route::post('/signInHandle','App\Http\controllers\user\UserAuthController@signInHandle');
        Route::get('/sign_out','App\Http\controllers\user\UserAuthController@signOut');



    });
});
