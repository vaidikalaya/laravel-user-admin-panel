<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\{Role,Permission};

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'salutation' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'integer', 'min:10', 'unique:users'],
            'country_id' => ['required'],
            'profileType' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $otherData=[
            "qualification"=>$data['qualification'],
            "medicalCenter"=>$data['medicalCenter'],
            "organization"=>$data['organization'],
            "collegeName"=>$data['collegeName'],
            "ongoingCourse"=>$data['ongoingCourse'],
            "completionDate"=>$data['completionDate'],
            "alterPhone"=>"",
            "alterEmail"=>"",
        ];
        $saveUser = User::create([
            'salutation'=>$data['salutation'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_id' => $data['country_id'],
            'other_details'=>json_encode($otherData),
            'password' => Hash::make($data['password']),
        ]);
        if($saveUser->id){
            try{
                $userName=$data['username'].($saveUser->id<=9 ? ('0'.''.$saveUser->id) : $saveUser->id);
            
                User::where('id',$saveUser->id)->update([
                    'username'=>$userName
                ]); 

                $saveUser->assignRole($data['profileType']);
                User::assignSubscription($saveUser->id);

                return $saveUser;
            }
            catch(Exceptions $e){
                $res=User::where('id',$saveUser->id)->delete();
                dd($res);
            }
        } 
    }

    public function validateGuestCode($guestCode){
        if(!Guestcode::where('code',$guestCode)->exists()){
            return back()->withErrors(['guestCode', 'invalid guest code']);
        }
    }
}