<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_subscription extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'plan_id', 'expire_at'];

    public function plan_detail(){
        return $this->belongsTo(Subscription_plan::class,'plan_id');
    }

    public function order(){
        return $this->belongsTo(Subscription_plan::class,'plan_id');
    }
}
