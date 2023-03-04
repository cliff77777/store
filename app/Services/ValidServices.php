<?php
namespace App\Services;

use DB;
use LOG;
use Validator;

class ValidServices{
    function valid_use($type,$data){
        if($type == "sign_up"){
            //註冊資料驗證規則
            $rules=[
               'email'=>[
                  'required',
                  'email',
                  'unique:users,email' //unique 確保唯一性
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