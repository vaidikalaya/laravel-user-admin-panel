<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\{MailSystem,FriendInvitation,InvoiceMail};
use App\Models\{User_invoice};

class MailAndNotificationController extends Controller
{
    public static function mail($url,$data=null){
        switch($url){
            case "send-invitation":
                Mail::to($data['mail'])->send(new FriendInvitation($data));
                if(Mail::flushMacros()){
                    return back()->with('error_msg','mail not send');
                }
                else{
                    return back()->with('success_msg','mail send');
                }
                break;

            case "send-invoice":
                $data=User_invoice::with('user','plan','payments')->first();
                mail::to(auth()->user()->email)->send(new InvoiceMail($data));
                if(Mail::flushMacros()){
                    return back()->with('error_msg','mail not send');
                }
                else{
                    return back()->with('success_msg','mail send');
                }
                break;
        }
    }
}
