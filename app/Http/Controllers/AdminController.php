<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,Subscription_plan};
use App\Mail\{MailSystem};

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','isAdmin']);
    }

    public function index(Request $request){
        return view('dashboard.admin'.'.'.$request->url);
    }

    public function mailSend(Request $request){
        $data=[
            'subject'=>$request->subject,
            'content'=>$request->content
        ];
        Mail::to($request->mailto)->send(new MailSystem($data));
        if(Mail::flushMacros()){
            return back()->with('error_msg','mail not send');
        }
        else{
            return back()->with('success_msg','mail send');
        }
    }
}
