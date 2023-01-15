<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authUser=Auth::user();
        $path=$request->path();
        $hasPermission=false;
        switch($path){
            case "admin/dashboard":
                $hasPermission=$authUser->hasPermissionTo('admin-dashboard');
                break;

            case "admin/user-management":
                $hasPermission=$authUser->hasPermissionTo('user-dashboard');
                break;

            case "admin/subscription-plans":
                $hasPermission=$authUser->hasPermissionTo('subscription-dashboard');
                break;

            case "admin/mail-system":
                $hasPermission=$authUser->hasPermissionTo('mail-management');
                break;

            case "admin/add-article":
                $hasPermission=$authUser->hasPermissionTo('article-add');
                break;

            case "admin/articles":
                $hasPermission=$authUser->hasPermissionTo('articles-dashboard');
                break;

            case "admin/invoice-download":
                $hasPermission=$authUser->hasPermissionTo('invoice-download');
                break;

            case "admin/sso-clients":
                $hasPermission=$authUser->hasPermissionTo('sso-clients-dashboard');
                break;

            case "admin/privacy-security":
                $hasPermission=$authUser->hasPermissionTo('privacy-security-management');
                break;
            default:
                $hasPermission=false;
                break;
        }
        if($hasPermission){
            return $next($request);
        }
        else{
            abort(401);
        }
    }
}
