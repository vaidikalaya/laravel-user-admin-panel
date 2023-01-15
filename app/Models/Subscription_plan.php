<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription_plan extends Model
{
    use HasFactory;

    protected $fillable=['plan_name','plan_slug','actual_price','paid_price','accessible_users','conversion_rate','tax','status'];

    public function planName($planId){
        return Subscription_plan::find($planId)->value('plan_name');
    }
}
