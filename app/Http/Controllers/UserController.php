<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\{User,User_has_subscription,User_invoice};

class UserController extends Controller
{

    public function __construct(){
        $this->middleware(['verified', 'auth']);
    }

    public function index(Request $request){
        $views=['dashboard','subscription','my-activity','refer-friend','profile','user-management','invoice-download'];
        
        switch($request->url){
            case 'dashboard':
                $data=[
                    'user'=>User::with('country','roles')->where('id',auth()->user()->id)->first()
                ];
                break;

            case 'subscription':
                $data=[
                    'plan'=>User_has_subscription::where('user_id',auth()->user()->id)->with('plan_detail')->first()
                ];
                break;

            case 'my-activity':
            case 'refer-friend':
            case 'profile':
            case 'user-management':
                $data=[];
                break;
            
            case 'invoice-download':
                $invoiceDetail=User_invoice::with('user','plan','payments')->first();
                if($invoiceDetail){
                    return view('pages.invoice',compact('invoiceDetail'));
                }else{
                    return back()->with("error_msg","you don't have subscription plan");
                } 
                break;
            
            default:
                abort(404);
                break;
        }
        return view('dashboard.public'.'.'.$request->url,$data);
    }

    public function updatePassword(Request $request){
        $userId=auth()->user()->id;
        if(auth()->user()->password===Hash::make($request->currentpassword))
        {
            if($request->newpassword===$request->confirmpassword){
                $res=User::where('id',$userId)->update([
                    'password'=>Hash::make($request->newpassword)
                ]);
                if($res){
                    return back()->with('success_msg','password updated');
                }
            }else{
                return back()->with('error_msg','confirm password not matched');
            }
        }else{
            return back()->with('error_msg','current password not correct');
        }
    }

    public function sendInvitation(Request $request){
        $data=[
            'referral'=>auth()->user()->username,
            'mail'=>$request->mail
        ];
        return MailAndNotificationController::mail('send-invitation',$data);
    }
}
