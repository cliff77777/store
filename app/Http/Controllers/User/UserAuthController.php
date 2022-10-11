<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Validator; //驗證器
use Log;
use Hash;
use Mail;
use DB;

//models
use App\Models\User ;

class UserAuthController extends Controller
{
//會員註冊頁面
   public function signUpPage(){

      log::info("進入註冊畫面");

      $binding=[
         'title'=>'註冊',
      ];

      // dd($binding);

      return view('auth.signUp',$binding);

   }
// 新增會員
   public function addUser(){
      $get_data=request()->all();
      Log::info($get_data);

      // 送去做註冊資料驗證規則
      $type="sign_up";
      $valid_result=$this->valitator_user($type,$get_data);

      if($valid_result=="success"){
         log::notice("user data valitor success");
      }else{
         return $valid_result;
      }

      $get_data["password"] = Hash::Make($get_data["password"]);

      $add_member=User::create($get_data);

      //如果註冊成功就準備寄送email到會員信箱
      if(isset($add_member->id) == true){
         log::notice("註冊成功");
         $mail_binding=[
            'name'=>$get_data['name']
         ];
         //並帶上註冊成功訊息傳到email畫面
         Mail::send('email.signUpEmailNotification',$mail_binding,
         function($mail) use ($get_data){
            $mail->to($get_data['email']);
            $mail->from('sxs0507@gmail.com');
            $mail->subject('恭喜您完成註冊');
         }
      ); 
      //寄出成功郵件後回到註冊頁面
         return redirect('/user/auth/sign_up');
      }
   }
// 會員登入頁面
   public function signIn(){
      log::info("進入登入畫面");
      $binding=[
         'title'=>'會員登入',
      ];

      return view('auth.signIn',$binding);
   }

//會員登入處理
   public function signInHandle(){
      //啟用紀錄sql語法
      DB::enableQueryLog();

      $binding=[
         'title'=>'會員登入',
      ];
      
      $data=request()->all();
      log::info($data);
      $type="sign_in";
      $valid_result=$this->valitator_user($type,$data);

      if(is_string($valid_result)){
         log::info($valid_result);
         //撈取檢查使用者帳號
         $user=User::where('email',$data['email'])->first();

         // log::notice(DB::getQueryLog());

         //檢查是帳號是否有被註冊
         if(empty($user)){
            $error_message=[
               'msg'=>[
                  '帳號尚未註冊',
                  ],
               ];
               log::info($error_message);
            return redirect('/user/auth/sign_in')->withErrors($error_message)->withInput();
         }else{
            log::notice("有照到帳號");
            log::notice($user);
         }

         //檢查使用者輸入密碼與資料庫的密碼比對
         $check_password=Hash::check($data['password'],$user->password);
         if(!$check_password){
            $error_message=[
               'msg'=>[
                  '密碼驗證錯誤',
                  ],
               ];
               log::info("密碼錯誤");
               return redirect('/user/auth/sign_in')->withErrors($error_message)->withInput();
            }else{
               log::info("密碼正確");
               session()->put('user_id',$user->id);
               //重新導回請求頁面，如沒有則導回首頁
               return redirect()->intended('/dashboard/index');
               // return redirect('/dashboard/index');

            }
      }else{
         log::info("欄位驗證失敗");
         return $valid_result ;
      }
   
   }
//會員登出
   public function signOut(){
      session()->forget('user_id');
       return redirect()->intended('/dashboard/index');
   }





   //laravel 驗證機制
   private function valitator_user ($type,$data){
      if($type == "sign_up"){
         //註冊資料驗證規則
         $rules=[
            'email'=>[
               'required',
               'email',
            ],
            'password'=>[
               'required',
               'min:4',
            ],
            'check_password'=>[
               'required',
               'same:password',
            ],
            'name'=>[
               'required',
            ]
         ];
         //丟去做判斷
         $valitator = Validator::make($data,$rules);
         if($valitator->fails()){
            LOG::INFO("註冊驗證第一步:失敗");
            return redirect('/user/auth/sign_up')->withErrors($valitator)->withInput();
         }else{
            LOG::INFO("註冊第一步:驗證成功");
            return "success";
         }
      }else if($type == "sign_in"){
         //登入欄位驗證
         $rules=[
            'email'=>[
               'required',
               'email',
            ],
            'password'=>[
               'required',
               'min:4',
            ]
         ];
         //丟去做判斷
         $valitator = Validator::make($data,$rules);
         if($valitator->fails()){
            LOG::INFO("登入驗證第一步:失敗");
            return redirect('/user/auth/sign_in')->withErrors($valitator)->withInput();
         }else{
            LOG::INFO("登入驗證第一步:成功");
            return "完成登入欄位驗證";
         }
      }      
   }
}
