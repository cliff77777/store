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
use App\Models\UserDetail;
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
        $title ="購物車";
        $response_html= view('dashboard.shopping_cart',["title"=>$title])->render();

          break;      
      case "my_favorite":
          break;      
      case "edit_userdata":
        $title ="會員資料編輯";
        $all_data=[];
        $search_data=User::find($data['user_id']);
        $search_user_detail=UserDetail::where('user_id',$data['user_id'])->first();
        if(null!==$search_user_detail){
          $all_data=json_decode($search_user_detail['all_data'],true);
          log::info($all_data);
        }

        $response_html= view('dashboard.edit_userdata',["search_data"=>$search_data,"all_data"=>$all_data,"title"=>$title])->render();
          break;
    }    

    return response()->json(['msg'=>'success','html'=>$response_html]);
  }
  public function user_update(){  
    $get_data=request()->all();
    // log::info($get_data);
    $user_update=[
      "name"=> $get_data['name'],
    ];
    
    if(null !== $get_data['password']){
      if(strlen($get_data['password'])<4){
        return response()->json(['密碼長度不得小於4'],400);
      }elseif($get_data['password']!==$get_data['check_password']){
        return response()->json(['確認密碼不一致'],400);
      }else{
        $update_password=Hash::Make($get_data['password']);
        $user_update=[
        "name"=> $get_data['name'],
        "password"=>$update_password
      ];
      }
    }

    if(null == $get_data['name']){
      return response()->json(['姓名不得空白'],400);
    }

    $user=User::where("email",$get_data['email']);
    $user_id=$user->first()->id;
    $user_detail=UserDetail::where('user_id',$user_id)->first();



    //把其他的欄位內容組成陣列全部存在all_data
    $other_data=[
      "id_address"=>(null !== $get_data["id_address"])?$get_data["id_address"]:"",
      "live_address"=>(null !== $get_data["live_address"])?$get_data["live_address"]:"",
      "phone"=>(null !== $get_data["phone"])?$get_data["phone"]:""
    ];
    $save_other_data=json_encode($other_data);
    User::where("email",$get_data['email'])->update($user_update);

    if(null !== $user_detail){
      UserDetail::where("user_id",$user_id)->update(['user_id'=>$user_id,"all_data"=> $save_other_data]);
    }else{
      UserDetail::create(['user_id'=>$user_id,"all_data"=> $save_other_data]);
    }

    return response()->json(['會員資料修改成功'],200);
  }

}