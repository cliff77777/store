<?php

namespace App\Http\Controllers\HomePage;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Validator; //驗證器
use Log;
use Hash;
use Mail;
use DB;

class HomePageController extends Controller
{
    function index (){
        $binding=[
            'title'=>'首頁',
         ];
        return view ('homepage.homepage_index',$binding);
    }
}

