<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_invoice extends Model
{
    use HasFactory;

    protected $fillable=['invoice_number','order_id','payment_id','plan_id','user_id'];

    public function payments(){
        return $this->belongsTo(User_payment::class,'payment_id','payment_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function plan(){
        return $this->belongsTo(Subscription_plan::class,'plan_id');
    }
}
