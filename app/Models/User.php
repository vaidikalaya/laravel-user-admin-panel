<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'salutation',
        'firstname',
        'lastname',
        'email',
        'phone',
        'country_id',
        'other_details',
        'profile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function educations(){
        return $this->hasMany(User_education::class,'user_id');
    }
    
    public function experiences(){
        return $this->hasMany(User_experience::class,'user_id');
    }

    public function research_papers(){
        return $this->hasMany(User_research_paper::class,'user_id');
    }

    public function subscription(){
        return $this->hasOne(User_has_subscription::class,'user_id');
    }

    public function added_users(){
        return $this->hasManyThrough(User::class,Added_user::class,'added_by','id','id','user_id');
    }
    public static function assignSubscription($userId){
        $date = Carbon::now();
        $date->setTimezone('Asia/Kolkata');
        $date->addDays(7);
        $date->toDateTimeString();
        $res=User_has_subscription::create([
            'user_id'=>$userId,
            'plan_id'=>1,
            'expire_at'=>$date->toDateTimeString()
        ]);
        if($res){
            return true;
        }
    } 

    public static function updateSubscription($userId,$planId){
        $date = Carbon::now();
        $date->setTimezone('Asia/Kolkata');
        if($planId!==1){
            $date->addDays(365);
        }
        $date->toDateTimeString();
        $res=User_has_subscription::where('user_id',$userId)->update([
                'plan_id' => $planId,
                'expire_at' => $date
            ]);
    }
}
