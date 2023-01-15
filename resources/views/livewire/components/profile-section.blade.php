<div>
    
<div class="container">
    
    <div class="main-header mt-2">
        <h4>
            Profile
            @if(session('success_msg'))
                <span class="alert alert-success alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                    {{session('success_msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                </span>
            @endif
            @if(session('error_msg'))
                <span class="alert alert-danger alert-dismissible" role="alert" style="padding: 6px 91px 8px 14px">
                    {{session('error_msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 12px;margin-top:-8px"></button>
                </span>
            @endif
        </h4>
    </div>
    <hr>

    <div class="d-flex justify-content-center">
        <div class="card user-card mb-3">
            
            <!--Basic Info-->
            <div class="card-header">
                Basic Info
                <a href="#" wire:click="showProfileSection('basic-info',{{$user}})" style="font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fa fa-pen"></i>
                </a>
                <hr style="margin:revert">
            </div>
            <div class="card-body text-muted">
                <div class="row">
                    <div class="col-6 col-md-3">Name</div> 
                    <div class="col-6 col-md-3">{{$user->firstname.' '.$user->lastname }}</div>

                    <div class="col-6 col-md-3">Username</div> 
                    <div class="col-6 col-md-3">{{$user->username}}</div>
    
                    <div class="col-6 col-md-3 mt-3">Email</div>
                    <div class="col-6 col-md-3 mt-3">
                         {{$user->email}}
                    </div>

                    <div class="col-6 col-md-3 mt-3">Domain</div>
                    <div class="col-6 col-md-3 mt-3">
                         {{$user->roles[0]->name}}
                    </div>

                    <div class="col-6 col-md-3 mt-3">Country</div>
                    <div class="col-6 col-md-3 mt-3">
                        @if($user->country)
                            {{$user->country->name}}
                        @endif
                    </div>

                    @role(['Doctor','Student'])
                    <div class="col-6 col-md-3 mt-3">Qualification</div>
                    <div class="col-6 col-md-3 mt-3">
                         {{json_decode($user->other_details)->qualification}}
                    </div>
                    @endrole

                    @role('Medical Center')
                    <div class="col-6 col-md-3 mt-3">Medical Center</div>
                    <div class="col-6 col-md-3 mt-3">
                         {{json_decode($user->other_details)->medicalCenter}}
                    </div>
                    @endrole

                    @role(['Pharmaceutical Organization','Biotechnology Organization'])
                    <div class="col-6 col-md-3 mt-3">Organization</div>
                    <div class="col-6 col-md-3 mt-3">
                         {{json_decode($user->other_details)->organization}}
                    </div>
                    @endrole
                </div>
            </div>

            <!--Contact Info-->
            <div class="card-header">
                Contact Info
                <a href="#" wire:click="showProfileSection('contact-info',{{$user}})" style="font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fa fa-pen"></i>
                </a>
                <hr style="margin:revert">
            </div>
            <div class="card-body text-muted">
                <div class="row">
                    <div class="col-6 col-md-3">Main phone</div>
                    <div class="col-6 col-md-3">{{$user->phone}}</div>
    
                    <div class="col-6 col-md-3">Alternate Phone</div>
                    <div class="col-6 col-md-3">
                        {{json_decode($user->other_details)->alterPhone}}
                    </div>
    
                    <div class="col-6 col-md-3 mt-3">Main Email</div>
                    <div class="col-6 col-md-3 mt-3">{{$user->email}}</div>

                    <div class="col-6 col-md-3 mt-3">Alternate Email</div>
                    <div class="col-6 col-md-3 mt-3">
                        {{json_decode($user->other_details)->alterEmail}}
                    </div>
                </div>
            </div>

            <!--Education-->
            @role(['Doctor','Student'])
            <div class="card-header">
                Education
                <a href="#" wire:click="showProfileSection('education')" style="font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fa fa-add"></i>
                </a>
                <hr style="margin: revert">
            </div>
            <div class="card-body text-muted">
                @if($user->educations->count()>0)
                    @foreach ($user->educations as $education)
                        <div class="row col-sm-12 col-md-10 col-lg-6">
                            <div>
                                <h5>
                                    {{$education->type.' from '.$education->institute}}
                                    <a href="#" wire:click="showProfileSection('education',{{$education}})" class="btn float-end" style="margin-top:-9px;font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </h5>
                                <h6 style="margin-top:-8px;font-size:16px">
                                    <span>Specialty: {{$education->specialty}}</span><br>
                                    <span>Duration: {{$education->start_date}}, {{$education->end_date}}</span>
                                </h6>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <!--Experience-->
            <div class="card-header">
                Experience
                <a href="#" wire:click="showProfileSection('experience')" style="font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fa fa-add"></i>
                </a>
                <hr style="margin: revert">
            </div>
            <div class="card-body text-muted">
                @if($user->experiences->count()>0)
                    @foreach ($user->experiences as $experience)
                        <div class="row col-sm-12 col-md-10 col-lg-6">
                            <div>
                                <h5>
                                    {{$experience->designation.' In '.$experience->organization}}
                                    <a href="#" wire:click="showProfileSection('experience',{{$experience}})" class="btn float-end" style="margin-top:-9px;font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </h5>
                                <h6 style="margin-top:-8px;font-size:16px">
                                    <span>Location: {{$experience->location}}</span><br>
                                    <span>Duration: {{$experience->start_date.', '.$experience->end_date}}</span>
                                </h6>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @endrole

            <!--Research Papers-->
            <div class="card-header">
                Research Papers
                <a href="#" wire:click="showProfileSection('research-papers')" style="font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fa fa-add"></i>
                </a>
                <hr style="margin: revert">
            </div>
            <div class="card-body">
                <ol>
                    @if($user->research_papers->count()>0)
                        <div class="row col-sm-12 col-md-10 col-lg-6">
                            @foreach ($user->research_papers as $paper)
                                <li>
                                    <a href="{{$paper->url}}" target="_blank">{{$paper->title}}</a>
                                    <a href="#" wire:click="showProfileSection('research-papers',{{$paper}})" class="btn float-end" style="margin-top:-9px;font-size:20px;color:#15477b" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </li>
                            @endforeach
                        </div>
                    @endif
                </ol>
            </div>

        </div>
    </div>

</div>

<!--Profile Modal-->
<div wire:ignore.self class="modal fade" id="profileModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                {{$sectionName}}
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="saveProfileSection('{{$component}}')">
                    @if($component==='basic-info')
                        <x-profilecomponents.basic-info/>
                    @endif
                    @if($component==='contact-info')
                        <x-profilecomponents.contact-info/>
                    @endif
                    @if($component==='education')
                        <x-profilecomponents.education/>
                    @endif
                    @if($component==='experience')
                        <x-profilecomponents.experience/>
                    @endif
                    @if($component==='research-papers')
                        <x-profilecomponents.research-papers/>
                    @endif
                    <div>
                        <button class="btn btn-primary2" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clearData()">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        window.livewire.on('close-modal',()=>{
            $('.toast').toast('show');
            $(".modal").modal('hide');
            location.reload();
        });
    })
</script>
</div>
