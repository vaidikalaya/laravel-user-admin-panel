<?php

namespace App\Http\Livewire\Components;
use Livewire\Component;
use App\Models\{Subscription_plan};
use Exception;
class SubscriptionPlans extends Component
{
    public $createAccountError;
    public $modalHeader,$editPlanId;
    protected $listeners = ['delete-listener' => "deletePlan"];

    public $planArray=[
        'plan_name'=>null,
        'plan_slug'=>null,
        'actual_price'=>null,
        'paid_price'=>null,
        'accessible_users'=>null,
        'conversion_rate'=>null,
        'tax'=>null,
        'status'=>'draft'
    ];

    public function planOperation($url,$id=null){
        switch($url){
            case "add-update":
                try{
                    $this->planArray['plan_slug']=str_slug($this->planArray['plan_slug']);
                    $this->editPlanId
                    ?Subscription_plan::where('id',$this->editPlanId)->update($this->planArray)
                    :Subscription_plan::create($this->planArray);
                    $this->emit('close-modal');
                    $this->clear();
                    return back()->with('success_msg','plan saved');
                }catch(Exception $e){
                    $this->emit('close-modal');
                    $this->clear();
                    return back()->with('error_msg','surver error! please try after some time');
                }
                break;

            case "edit":
                $this->modalHeader="Edit Plans";
                $this->editPlanId=$id;
                $this->planArray=Subscription_plan::find($id)->toArray();
                unset($this->planArray['created_at'],$this->planArray['updated_at']);
                break;
        }
    }

    public function deletePlan($payload){
        if(Subscription_plan::where('id',$payload['id'])->delete()){
            $this->emit('close-modal');
            return back()->with('success_msg','plan deleted');
        }
    }

    public function clear(){
        $this->planArray=[
            'plan_name'=>null,
            'plan_slug'=>null,
            'actual_price'=>null,
            'paid_price'=>null,
            'accessible_users'=>null,
            'conversion_rate'=>null,
            'tax'=>null,
            'status'=>'draft'
        ];
        $this->editPlanId=null;
        $this->modalHeader=null;
    }

    public function render()
    {
        $plans=Subscription_plan::all();
        return view('livewire.components.subscription-plans',compact('plans'));
    }
}
