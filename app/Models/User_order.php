<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_order extends Model
{
    use HasFactory;

    protected $fillable=['order_id','plan_id','user_id','receipt_number','status'];
}
