<?php
namespace App\Services;

use Predis\Client;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\ShoppingCart;


class CartService{

    protected $redis;
    
    public function __construct()
    {
        $this->redis = new Client();
    }

    public function addProduct($productId,$count,$method,$auth_confirm){
        if(Auth::check()){
            $user_id=Auth::id();
            $db_shpping_cart=ShoppingCart::where('user_id',$user_id)->where("product_id",$productId);
            $check_cart=$db_shpping_cart->first();
            if($check_cart){
                $db_count=$check_cart->count;
                $update=$db_shpping_cart->update([
                    'count'=>$db_count+$count
                ]);
                $msg=$user_id;
            }else{
                ShoppingCart::create([
                    'user_id'=>$user_id,
                    'product_id'=>$productId,
                    'count'=>$count
                ]);
                $msg=$user_id;
            }
        }

        return $msg;

    // $cart=session()->get('cart',[]);
    // $this->redis->hset('cart',$productId,$count);
    }

    public function removeProduct($productId){
        // $this->redis->hdel('cart', $productId);

    }
    public function getProduct(){
        // $this->redis->hgetall('cart');

    }
}
