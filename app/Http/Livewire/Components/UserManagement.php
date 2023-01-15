<?php

namespace App\Http\Livewire\Components;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Spatie\Permission\Models\{Role,Permission};
use App\Models\{User,Added_user,User_has_subscription};

class UserManagement extends Component
{
    public $users,$viewUser,$authRole;
    public $profileType,$salutation,$firstname,$lastname,$email,$password,$editableUserId,$extendDays;
    public $operationType="add-user",$modalHeader="Add User";
    protected $listeners = ['delete-user' => "deleteUser"];

    public function viewUser($userData){
        $this->viewUser=$userData;
    }

    public function userOperation($url,$editData=null){
        switch($url){
            case 'add-user':
                $saveUser=User::create([
                    'salutation'=>$this->salutation,
                    'firstname'=>$this->firstname,
                    'lastname'=>$this->lastname,
                    'email'=>$this->email,
                    'password'=>Hash::make($this->password)
                ]);
                if($saveUser->id){
                    $saveUser->assignRole($this->profileType);
                    User::assignSubscription($saveUser->id);
                    if($this->authRole!=='Admin'){
                        Added_user::create([
                            'user_id'=>$saveUser->id,
                            'added_by'=>auth()->user()->id
                        ]);
                    }
                    $this->emit('close-modal');
                    return back()->with('success_msg','user added');
                }else{
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;

            case "edit-user":
                $this->operationType='update-user';
                $this->editableUserId=$editData['id'];
                $this->profileType=$editData['roles'][0]['name'];
                $this->salutation=$editData['salutation'];
                $this->firstname=$editData['firstname'];
                $this->lastname=$editData['lastname'];
                $this->email=$editData['email'];
                break;
            
            case 'update-user':
                if($this->editableUserId){
                    $updateUser=User::where('id',$this->editableUserId)->update([
                        'salutation'=>$this->salutation,
                        'firstname'=>$this->firstname,
                        'lastname'=>$this->lastname,
                        'email'=>$this->email,
                    ]);
                    if($updateUser){
                        if($this->password){
                            User::where('id',$this->editableUserId)->update([
                                'password'=>hash::make($this->password)
                            ]);
                        }
                        $this->emit('close-modal');
                        return back()->with('success_msg','user updated');
                    }else{
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                break;

            case 'extend-trail':
                $date = Carbon::now();
                $date->setTimezone('Asia/Kolkata');
                $date->addDays($this->extendDays);
                $date->toDateTimeString();
                $res=User_has_subscription::where('user_id',$editData)->update([
                    'expire_at'=>$date
                ]);
                if($res){
                    $this->extendDays=null;
                    $this->emit('close-modal');
                    return back()->with('success_msg','trail extended');
                }else{
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;
        }
    }

    public function deleteUser($payload)
    {
        if(User::where('id',$payload['userId'])->delete()){
            DB::table('model_has_roles')
                ->where('model_type','App\Models\User')
                ->where('model_id',$payload['userId'])
                ->delete();
            $this->emit('close-modal');
            return back()->with('success_msg','user deleted');
        }else{
            return back()->with('success_msg','error');
        }
    }

    public function clearData(){
        $this->operationType='add-user';
        $this->editableUserId=null;
        $this->profileType=null;
        $this->salutation=null;
        $this->firstname=null;
        $this->lastname=null;
        $this->email=null;
    }

    public function render(Request $request)
    {
        $this->authRole=auth()->user()->roles[0]->name;
        if(request()->is('admin/*')){
            $this->users=User::with('country','roles','subscription.plan_detail')->get();
        }else{
            $res=User::with('added_users.country','added_users.roles')
                    ->where('id',auth()->user()->id)
                    ->get();
            $this->users=$res[0]['added_users'];
        }
        return view('livewire.components.user-management');
    }
}
