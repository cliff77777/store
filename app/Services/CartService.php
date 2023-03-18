<?php
namespace App\Services;

use Predis\Client;
use Illuminate\Support\Facades\Auth;
use Log;

class CartService{

    protected $redis;
    
    public function __construct()
    {
        $this->redis = new Client();
    }

    public function addProduct($productId,$quantity){
        log::info(Auth::check());

        log::info($productId);
        dd('stop');
        $this->redis->hset('cart',$productId,$quantity);
    }

    public function removeProduct($productId){
        $this->redis->hdel('cart', $productId);

    }
    public function getProduct(){
        $this->redis->hgetall('cart');

    }
}
