<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', // 0 商品下架中
        'name',
        'name_en',
        'introduction',
        'price',
        'count',
        'cost',
        'salse',
        'valid', //valid = 0 軟刪除
        'photo'
        
    ];
}
