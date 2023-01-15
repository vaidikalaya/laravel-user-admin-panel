<?php
namespace App\Http\Livewire\Components;
use Livewire\Component;
use Spatie\Permission\Models\{Role,Permission};
use App\Models\{User};

class PrivacySecurity extends Component{

    public $assignTo,$selectAll,$selectedRole,$selectedUser,$selectedPermissions=[];

    public function assignPermissions(){
        switch($this->assignTo){
            case "role":
                if($this->selectedRole){
                    $role=Role::find($this->selectedRole);
                    $role->syncPermissions($this->selectedPermissions);
                }else{
                    return back()->with('error_msg','please select role and their permissions');
                }
                break;

            case "user":
                if($this->selectedUser){
                    $user=User::find($this->selectedUser);
                    $user->syncPermissions($this->selectedPermissions);
                }
                else{
                    return back()->with('error_msg','please select user and their permissions');
                }
                break;

            default:
                return back()->with('error_msg','null values are not allowed');
        }

        $this->emit('close-modal');
        $this->clear();
    }

    public function selectedPermissionByUserAndRole($url){
        $permissions=[];
        $this->selectedPermissions=[];
        switch($url){
            case "role":
                if($this->selectedRole){
                    $permissions=Role::with('permissions')->where('id',$this->selectedRole)->first()->toArray()['permissions'];
                }            
                break;

            case "user":
                if($this->selectedUser){
                    $permissions=User::with('permissions')->where('id',$this->selectedUser)->first()->toArray()['permissions'];
                }         
                break;

            case "select-all":
                if($this->selectAll){
                    $permissions=Permission::all()->toArray();
                }else{
                    $permissions=[];
                    $this->selectedPermissions=[];
                }
                break;
        }
        
        foreach($permissions as $per){
            array_push($this->selectedPermissions,$per['name']);
        }
    }

    public function clear(){
        $this->selectedRole=null;
        $this->selectedUser=null;
        $this->assignedPermissions=[];
    }

    public function render()
    {
        $roles=Role::with('permissions')->get();
        $users=User::with('permissions')->get();
        $permissions=Permission::all();
        return view('livewire.components.privacy-security',compact('roles','permissions','users'));
    }
}