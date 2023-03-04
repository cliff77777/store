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
use Illuminate\Contracts\Session\Session;
use Symfony\Contracts\Service\Attribute\Required;

//Services
use App\Services\ValidServices;


class DashboardController extends Controller
{
  protected $VaildServices;

  public function __construct(
    ValidServices $ValidServices
    )
  {
    $this->VaildServices=$ValidServices;
  }
  public function index(){

    if(!empty(session()->get('user_data')->id)){
      $user=session()->get('user_data')->id;
    }else{
      $user="Guest";
    }

    $binding=[
      'title'=>'會員中心',
      "user"=>$user
   ]; 

    return view ('dashboard.dashboard_index',$binding);
  }

  public function detail(){

    $data=request()->all();

    $response_html='';
    $target_data=[];

    if(isset($data['password'])&&$data['password']!==NULL){
          $db_pasword=User::find($data['user_id'])->select('password')->first();
          $check_password=Hash::check($data['password'],$db_pasword->password);
          if(!$check_password){
            $msg=["msg"=>"密碼錯誤",
                  "status"=>400
                ];
          }else{
            $msg=["msg"=>"正確",
                  "status"=>200
                ];
          }
          return response()->json($msg);
    }

    switch($data['action']){
      case "order_list":
        break;
      case "order_history":
          break;
      case "shopping_cart":
          break;      
      case "my_favorite":
          break;      
      case "edit_userdata":
        $search_data=User::find($data['user_id']);
        log::info($search_data);
        $response_html= view('dashboard.edit_userdata',["search_data"=>$search_data])->render();
          break;
    }    

    return response()->json(['msg'=>'success','html'=>$response_html]);
  }
  public function user_update(){  
    $get_data=request()->all();
    log::info($get_data);

    if(strlen($get_data['password'])<4){
      return response()->json(['密碼長度不得小於4'],400);
    }elseif($get_data['password']!==$get_data['check_password']){
      return response()->json(['確認密碼不一致'],400);
    }

    $update_password=Hash::Make($get_data['password']);

    $user_date=User::where("email",$get_data['email'])->update(["password"=>$update_password]);




    return response()->json(['會員資料修改成功'],200);

  }

}