<div>
    <div class="container-fluid">
        
        <div class="main-header mt-2">
            <h4>
                User Management
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

        <div class="card"> 
            @can('user-add')
            <div class="card-header bg-white">
                <button class="btn btn-primary2" id="addUser" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
            </div>
            @endcan
            <div class="card-body" wire:ignore>
                <table id="dataTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Email Status</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Register At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index=>$user)
                            @if($user->roles[0]->name!=='Super Admin')
                            <tr>
                                <td>{{$index}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->email_verified_at)
                                     <small class="text-success"><b>verified</b></small> 
                                    @else 
                                     <small class="text-danger"><b>not verified</b></small>
                                    @endif
                                </td>
                                <td>{{$user->roles[0]->name}}</td>
                                <td>{{\Carbon\Carbon::parse($user->created_at)->toFormattedDateString()}}</td>
                                <td>
                                    <button class="btn" wire:click="viewUser({{$user}})" data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                        <i class="fa fa-eye" style="font-size: 25px;color:#2073bf;"></i>
                                    </button>
            
                                    @can('user-update')
                                    <button class="btn" wire:click="userOperation('edit-user',{{$user}})" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                        <i class="fa fa-edit" style="font-size: 25px;color:#2073bf;" ></i>
                                    </button>
                                    @endcan
            
                                    @can('user-delete')
                                    <form name='delForm' wire:submit.prevent="userOperation('delete-user')" method="POST" style="display: none;">
                                        <input type="hidden" name="userId">
                                    </form>
                                    <button class="btn" onclick="showAlert({{$user->id}})">
                                        <i class="fa fa-trash" style="font-size: 25px;color:#2073bf;"></i>
                                    </button>   
                                    @endcan
                                 </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
 
    @can(['user-add'])
    <div wire:ignore.self class="modal fade" id="addUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{$modalHeader}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="userOperation('{{$operationType}}')" method="post" name="userAddUpdateForm" autocomplete="off">

                        <div class="row" id="userComponent">
                            
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select wire:model.defer="profileType" class="form-control @error('profileType') is-invalid @enderror" id="profileType" required>
                                        <option value="">Select Type</option>
                                        @role('Super Admin')
                                        <option value="Admin">Admin</option>
                                        @endrole
                                        <option value="Doctor">Doctor</option>
                                        <option value="Medical Center">Medical Center</option>
                                        <option value="Biotechnology Organization">Biotechnology Organization</option>
                                        <option value="Pharmaceutical Organization">Pharmaceutical Organization</option>
                                        <option value="Partner">Partner</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select wire:model.defer="salutation" class="form-control" aria-label="salutation" required>
                                      <option value="">Select Salutation</option>
                                      <option value="Mr.">Mr.</option>
                                      <option value="Ms.">Ms.</option>
                                      <option value="Dr.">Dr.</option>
                                      <option value="Prof.">Prof.</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                  <input type="text" wire:model.defer="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" id="firstname" placeholder="firstname" required>
                                  <label for="firstname">First Name</label>
                                  @error('firstname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                              
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                  <input type="text" wire:model.defer="lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname" placeholder="lastname" required>
                                  <label for="lastname">Last Name</label>
                                  @error('lastname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required>
                                    <label for="email">Email</label>
                                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                  <input type="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password" autocomplete="new-password" @if(!$editableUserId) required @endif>
                                  <label for="password">Password</label>
                                  @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        
                        </div>
                        
                        <div>
                            <button class="btn btn-primary2" type="submit">Submit</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clearData()">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div wire:ignore.self class="modal fade" id="viewUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    User Detail
                </div>
                <div class="modal-body">
                    @if($viewUser)
                        <div class="card border-0">
                            
                            <div class="card-header bg-white border-bottom-0">
                                <h5 class="text-primary2 fw-bold">Basic Detail</h5>
                                <hr style="margin-top: -2px">
                            </div>
                            <div class="card-body text-muted" style="margin-top:-30px">
                                <div class="row">
                                    <div class="col-sm-2">Name</div>
                                    <div class="col-sm-4"><span class="float-start">{{$viewUser['firstname'].' '.$viewUser['lastname']}}</span></div>
                                    <div class="col-sm-2">Email</div>
                                    <div class="col-sm-4">{{$viewUser['email']}}</div>
                                    <div class="col-sm-2 mt-2">Phone</div>
                                    <div class="col-sm-4 mt-2">{{$viewUser['phone']}}</div>
                                    <div class="col-sm-2 mt-2">Domain</div>
                                    <div class="col-sm-4 mt-2">{{$viewUser['roles'][0]['name']}}</div>
                                </div>
                            </div>

                            @can('user-subscription-details')
                            <div class="card-header bg-white border-bottom-0">
                                <h5 class="text-primary2 fw-bold">Subscription Detail</h5>
                                <hr style="margin-top: -2px">
                            </div>
                            <div class="card-body text-muted" style="margin-top:-30px">
                                <div class="row">
                                    <div class="col-sm-3">Plan</div>
                                    <div class="col-sm-3"><span class="float-start">{{$viewUser['subscription']['plan_detail']['plan_name']}}</span></div>
                                    <div class="col-sm-3">Paic Price</div>
                                    <div class="col-sm-3">{{$viewUser['subscription']['plan_detail']['paid_price']}}</div>
                                    <div class="col-sm-3 mt-2">Accessible Users</div>
                                    <div class="col-sm-3 mt-2">{{$viewUser['subscription']['plan_detail']['accessible_users']}}</div>
                                    <div class="col-sm-3 mt-2">Valid till</div>
                                    <div class="col-sm-3 mt-2">{{ \Carbon\Carbon::parse($viewUser['subscription']['expire_at'])->format('d/m/Y')}}</div>
                                </div>
                                @can('user-extend-trail')
                                <div>
                                    <form wire:submit.prevent="userOperation('extend-trail',{{$viewUser['id']}})" class="mt-2">
                                        <button class="btn btn-primary2 btn-sm mt-1">Extend Trail</button>
                                        <input type="number" wire:model.defer="extendDays" class="form-control w-25 d-inline" placeholder="enter days" required>
                                    </form>
                                </div>
                                @endcan
                            </div>
                            @endcan

                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function showAlert(userId){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                window.livewire.emit("delete-user",{ userId : userId });
            }
        })
    }

    $(document).ready(function() {
        window.livewire.on('close-modal',()=>{
            $(".modal").modal('hide');
            location.reload();
        });
    })
</script>
</div>
