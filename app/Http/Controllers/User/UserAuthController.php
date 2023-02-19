<?php
namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Validator; //驗證器
use Log;
use Hash;
use Mail;
use DB;

//Services
use App\Services\ValidServices;

//models
use App\Models\User ;

class UserAuthController extends Controller
{
   protected $ValidServices;
   public function __construct(
      ValidServices $ValidServices
   ){
      $this->ValidServices=$ValidServices;
   }
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
      $valid_result=$this->ValidServices->valid_use($type,$get_data);

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
         return redirect()->route('signInPage')->with('message', '恭喜您註冊成功，請重新登入');
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
      log::warning($data);
      $type="sign_in";
      $valid_result=$this->ValidServices->valid_use($type,$data);

      if(is_string($valid_result)){
         log::info($valid_result);
         //撈取檢查使用者帳號
         $user=User::where('email',$data['email'])->first();

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
            log::notice("有找到帳號");
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
               session()->put('user_data',$user);
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
      session()->forget('user_data');
       return redirect()->intended('/dashboard/index');
   }

}
