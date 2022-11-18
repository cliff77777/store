<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAblum extends Model
{
    protected $fillable = [
        'merchandise_id',
        'photo_name',
        'photo_origin_name',
        'photo_order',
    ];
    use HasFactory;
}
