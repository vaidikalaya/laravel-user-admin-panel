<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use App\Models\{User,Subscription_plan,User_order,User_payment,User_invoice};

class RazorpayController extends Controller
{

    public function index(){
        $plans=Subscription_plan::all();
        //dd($plans);
        return view('pages.pricing',compact('plans'));
    }

    public function buyRequest(Request $request){
     
        $razorpay_key=config("auth.razorpay_key");
        $razorpay_secret=config("auth.razorpay_secret");

        $plan=Subscription_plan::where('plan_slug',$request->plan)->first();
        $planId=$plan->id;
        $rsPrice=$plan->actual_price*$plan->conversion_rate;
        $paybleAmount=round(($rsPrice+($rsPrice*$plan->tax/100)));

        $userId=Auth::user()->id;
        $userEmail=Auth::user()->email;
        $userPhone=Auth::user()->phone;

        $api = new Api($razorpay_key, $razorpay_secret);

        $order=$api->order->create([
            'receipt' => now()->timestamp, 
            'amount' => $paybleAmount*100, 
            'currency' => 'INR'
        ]);

        $jsonData=[
            "key"      => $razorpay_key,
            "amount"   => $paybleAmount,
            "name"     => "Quantinova Subscribtion",
            "image"    => "https://cdn.razorpay.com/logos/FFATTsJeURNMxx_medium.png",
            "order_id" => $order['id'],
            "prefill"  => [
               "email" => "test@gmail.com",
               "contact" => "9115526935"
            ],
        ];

        $this->storeOrderDetails($userId,$order,$planId);
        return view('pages.checkout-page',compact('jsonData','plan','paybleAmount'));
    }

    public function paymentProcess(Request $request){
        
        $razorpay_key=config("auth.razorpay_key");
        $razorpay_secret=config("auth.razorpay_secret");

        $api = new Api($razorpay_key, $razorpay_secret);

        try{
            $attributes = [
                'razorpay_order_id' => $request->input('razorpay_order_id'),
                'razorpay_payment_id' => $request->input('razorpay_payment_id'),
                'razorpay_signature' => $request->input('razorpay_signature'),
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $paymentId=$request->input('razorpay_payment_id');
            $paymentDetails=$api->payment->fetch($paymentId);

            $this->storePaymentDetails($paymentDetails,$request->planId);
            MailAndNotificationController::mail('send-invoice');
            return view('pages.payment-success');

        }catch(SignatureVerificationError $e){
            return response(['message'=>'verification failed'],400);
        }
    }

    public function storeOrderDetails($userId,$order,$planId){
        $res=User_order::create([
            'order_id'=>$order['id'],
            'plan_id'=>$planId,
            'user_id'=>$userId,
            'receipt_number'=>$order['receipt'],
            'status'=>$order['status']
        ]);
    }

    public function storePaymentDetails($paymentDetails,$planId){
        $orderId=$paymentDetails['order_id'];
        $paymentId=$paymentDetails['id'];
        if(User_payment::where('order_id',$orderId)->exists()){
            $res=User_payment::where('order_id',$orderId)->update([
                'payment_id'=>$paymentId,
                'bank_transaction_id'=>$paymentDetails['acquirer_data']['rrn'],
                'payment_method'=>$paymentDetails['method'],
                'payment_bank'=>$paymentDetails['bank'],
                'amount'=>$paymentDetails['amount']/100,
                'status'=>$paymentDetails['status']
            ]);
        }else{
            $res=User_payment::create([
                'order_id'=> $orderId,
                'payment_id'=>$paymentId,
                'bank_transaction_id'=>$paymentDetails['acquirer_data']['rrn'],
                'payment_method'=>$paymentDetails['method'],
                'payment_bank'=>$paymentDetails['bank'],
                'amount'=>$paymentDetails['amount']/100,
                'status'=>$paymentDetails['status']
            ]);
        }
        if($res && ($paymentDetails['status']==='captured')){
            User_Order::where('order_id',$orderId)->update(['status' => 'paid']);
            User::updateSubscription(auth()->user()->id,$planId);
            User_invoice::create([
                'invoice_number'=>auth()->user()->id.(random_int(100000, 999999)),
                'order_id'=>$orderId,
                'payment_id'=>$paymentId,
                'plan_id'=>$planId,
                'user_id'=>auth()->user()->id
            ]);
        }
    }
}
