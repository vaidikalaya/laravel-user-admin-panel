<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\{HomeController,RenderController,UserController,AdminController,TestController,RazorpayController};

include('email-varification.php');

Route::get('/test', [TestController::class, 'index']);

Route::get('/', [RenderController::class, 'index']);
Route::get('getCountryIsdCode/{countryId}',function(Request $request){
    return App\Models\Country::where('id',$request->countryId)->select('code','isd_code')->get();
});

Auth::routes();


Route::controller(UserController::class)->group(function(){
    Route::post('my/refer-friend/send-invitation','sendInvitation');
    Route::post('my/password/update','updatePassword');
    Route::get('my/{url}','index');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('admin/{url}','index');
    Route::post('/mail-send','mailSend')->name('mail-send');
    Route::post('/admin/user-management/{reqUrl}/{id?}','userOperation');
});

Route::controller(RazorpayController::class)->group(function(){
    Route::get('/pricing','index');
    Route::post('/checkout','buyRequest');
    Route::post('/payment-process','paymentProcess')->name('payment-process');
});

Route::get('/clear-cache',function(){
    Artisan::call('optimize:clear');
    return back();
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
