<?php

namespace App\Http\Livewire\Components;
use Livewire\Component;
use Spatie\Permission\Models\{Role,Permission};
use App\Models\{User,User_education,User_experience,User_research_paper,Country};

class ProfileSection extends Component
{
    public $component,$sectionName;

    public $basicInfoArray=[
        'salutation'=>'',
        'firstname'=>'',
        'lastname'=>'',
        'email'=>'',
        'country_id'=>'',
        'other_details'=>''
    ];

    public $contactArray=[
        'mainPhone'=>'',
        'mainEmail'=>'',
        'alterPhone'=>'',
        'alterEmail'=>''
    ];

    public $educationArray=[
        'type'=>'',
        'specialty'=>'',
        'institute'=>'',
        'start_date'=>'',
        'end_date'=>'',
        'user_id'=>''
    ];

    public $experienceArray=[
        'organization'=>'',
        'location'=>'',
        'designation'=>'',
        'start_date'=>'',
        'end_date'=>''
    ];

    public $rpArray=[
        'title'=>'',
        'url'=>''
    ];

    public function showProfileSection($section,$data=null){
        switch($section){
            case 'basic-info':
                $this->sectionName="Basic Info";
                $this->component="basic-info";
                if($data){
                    $this->basicInfoArray=[
                        'salutation'=>$data['salutation'],
                        'firstname'=>$data['firstname'],
                        'lastname'=>$data['lastname'],
                        'email'=>$data['email'],
                        'country_id'=>$data['country_id'],
                        'other_details'=>json_decode($data['other_details'])
                    ];
                    //dd($this->basicInfoArray['other_details']->qualification);
                }
                break;
            case 'contact-info':
                $this->sectionName="Contact Info";
                $this->component="contact-info";
                $otherData=json_decode($data['other_details']);
                $this->contactArray=[
                    'mainPhone'=>$data['phone'],
                    'mainEmail'=>$data['email'],
                    'alterPhone'=>$otherData->alterPhone,
                    'alterEmail'=>$otherData->alterEmail
                ];
                break;

            case 'education':
                $this->sectionName="Education";
                $this->component="education";
                if($data){
                    $this->educationArray=$data;
                    unset($this->educationArray['created_at']);
                    unset($this->educationArray['updated_at']);
                }
                break;

            case 'experience':
                $this->sectionName="Experience";
                $this->component="experience";
                if($data){
                    $this->experienceArray=$data;
                    unset($this->experienceArray['created_at']);
                    unset($this->experienceArray['updated_at']);
                }
                break;

            case 'research-papers':
                $this->sectionName="Research Papers";
                $this->component="research-papers";
                if($data){
                    $this->rpArray=$data;
                    unset($this->rpArray['created_at']);
                    unset($this->rpArray['updated_at']);
                }
                break;
        }
    }

    public function saveProfileSection($section){
        $userId=auth()->user()->id;
        switch($section){
            case 'basic-info':
                try{
                    $userName=$this->generateUserName($this->basicInfoArray['country_id']);
                    $this->basicInfoArray['username']=$userName;
                    $res=User::where('id',$userId)->update($this->basicInfoArray);
                    if($res){
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('success_msg','detail updated');
                    }else{
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                catch(Exception $e){
                    $this->clearData();
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;
            case 'contact-info':
                try{
                    $otherData=json_decode(auth()->user()->other_details);
                    $otherData->alterPhone=$this->contactArray['alterPhone'];
                    $otherData->alterEmail=$this->contactArray['alterEmail'];
                    $res=User::where('id',$userId)->update([
                        'email'=>$this->contactArray['mainEmail'],
                        'phone'=>$this->contactArray['mainPhone'],
                        'other_details'=>json_encode($otherData)
                    ]);
                    if($res){
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('success_msg','detail updated');
                    }else{
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                catch(Exception $e){
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;

            case 'education':
                try{
                    $this->educationArray['user_id']=$userId;
                    array_key_exists('id',$this->educationArray)
                    ?$res=User_education::where('id',$this->educationArray['id'])->update($this->educationArray)
                    :$res=User_education::create($this->educationArray);
                    
                    if($res){
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('success_msg','education saved');
                    }else{
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                catch(Exception $e){
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;

            case 'experience':
                try{
                    $this->experienceArray['user_id']=$userId;
                    array_key_exists('id',$this->experienceArray)
                    ?$res=User_experience::where('id',$this->experienceArray['id'])->update($this->experienceArray)
                    :$res=User_experience::create($this->experienceArray);
                    if($res){
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('success_msg','experience saved');
                    }else{
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                catch(Exception $e){
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;

            case 'research-papers':
                try{
                    $this->rpArray['user_id']=$userId;
                    array_key_exists('id',$this->rpArray)
                    ?$res=User_research_paper::where('id',$this->rpArray['id'])->update($this->rpArray)
                    :$res=User_research_paper::create($this->rpArray);
                    if($res){
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('success_msg','Research Paper saved');
                    }else{
                        $this->clearData();
                        $this->emit('close-modal');
                        return back()->with('error_msg','something went wrong ! Please try again later');
                    }
                }
                catch(Exception $e){
                    $this->emit('close-modal');
                    return back()->with('error_msg','something went wrong ! Please try again later');
                }
                break;
        }
    }

    public function generateUserName($countryId){
        $userId=auth()->user()->id;
        $countryCode=Country::find($countryId)->value('code');
        $profile=auth()->user()->roles[0]->name[0];
        $userName=$countryCode.$profile.'A'.($userId<=9 ? ('0'.''.$userId) : $userId);
        return $userName;
    }

    public function clearData(){
        $this->sectionName=null;
        $this->component=null;
        $this->educationArray=[
            'type'=>'',
            'specialty'=>'',
            'institute'=>'',
            'start_date'=>'',
            'end_date'=>'',
            'user_id'=>''
        ];
        $this->experienceArray=[
            'organization'=>'',
            'location'=>'',
            'designation'=>'',
            'start_date'=>'',
            'end_date'=>''
        ];
        $this->rpArray=[
            'title'=>'',
            'url'=>''
        ];
    }

    public function render()
    {
        $user=User::with('country','roles','educations','experiences','research_papers')
                    ->where('id',auth()->user()->id)
                    ->get();
        return view('livewire.components.profile-section',['user'=>$user[0]]);
    }
}
