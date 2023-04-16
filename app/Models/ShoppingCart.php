<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $fillable = [
            'user_id', //會員id
            'session_id', //沒有會員id紀錄session
            'product_id',//商品id
            'count',//購買數量

    ];
}
