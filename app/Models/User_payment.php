<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_payment extends Model
{
    use HasFactory;
    protected $fillable=['order_id','payment_id','bank_transaction_id','payment_method','payment_bank','amount','status'];

    public function plan_detail(){
        return $this->belongsTo(Subscription_plan::class,'plan_id');
    }
}
