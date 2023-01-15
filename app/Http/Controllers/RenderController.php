<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class RenderController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }

    public function index(Request $req){
        if(request()->query->all()){
          session()->put('req_query',http_build_query(request()->query->all()));
          return redirect("http://localhost:8000/oauth/authorize?".session('req_query'));
        }
        else{
          return redirect("login");
        }
    }

    public function dashboard(){
        return view('dashboard');
    }
}
