<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Validator; //驗證器
use Log;
use Hash;
use Mail;
use DB;

//models
use App\Models\User ;

class DashboardController extends Controller
{
  public function index(){

    $binding=[
      'title'=>'會員中心',
   ];

    
    return view ('dashboard.dashboard_index',$binding);
  }
}