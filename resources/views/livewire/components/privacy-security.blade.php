<div>
    <div class="main-header mt-2">
        <div>
            <h5 class="fw-bold">Privacy & Security</h5>
        </div>
    </div>
    <hr>

    <div class="card">
        <div class="card-header bg-white">
            <button class="btn btn-primary2" id="addUser" data-bs-toggle="modal" data-bs-target="#managePermissions">
                Assign Permission
            </button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="role_permission-tab" data-bs-toggle="tab" data-bs-target="#role_permission-tab-pane" type="button">
                        Role's Permissions
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="user_permission-tab" data-bs-toggle="tab" data-bs-target="#user_permission-tab-pane" type="button">
                        User's Permissions
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="role_permission-tab-pane">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Role</th>
                                <th scope="col">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)                     
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @foreach ($role->permissions as $role_per)
                                            <span class="badge text-bg-primary2">{{$role_per->name}}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="user_permission-tab-pane">
                    <div class="card">
                        <div class="card-body">
                            <table id="dataTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->firstname.' '.$user->lastname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @foreach ($user->permissions as $user_per)
                                                    <span class="badge text-bg-primary2">{{$user_per->name}}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="managePermissions" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Manage Permissions
                    @if(session('error_msg'))
                        <span class="text-danger">
                        {{session('error_msg')}}
                        </span>
                    @endif
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="assignPermissions()">
                        
                        <div class="row">
                            <div class="col-sm-4">
                                Assign To:
                                <div class="form-check form-check-inline">
                                    <input type="radio" wire:model="assignTo" value="role" class="form-check-input" id="assigntorole" required>
                                    <label class="form-check-label" for="assigntorole">Role</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" wire:model="assignTo" value="user" class="form-check-input" id="assigntouser" required>
                                    <label class="form-check-label" for="assigntouser">User</label>
                                </div>
                            </div>

                            @if($assignTo==='role')
                            <div class="col-sm-8">
                                <div class="mb-1" style="margin-top:-5px">
                                    <select wire:model.defer="selectedRole" wire:change="selectedPermissionByUserAndRole('role')" class="form-control only-border-bottom bg-white" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($assignTo==='user')
                            <div class="col-sm-8">
                                <div class="mb-1" style="margin-top:-5px">
                                    <select wire:model.defer="selectedUser" wire:change="selectedPermissionByUserAndRole('user')" class="form-control only-border-bottom bg-white" required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr style="margin-top: auto">

                        <div class="row">
                            <div class="col-sm-12 text-primary2 fw-bold">
                                Permissions
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" wire:model="selectAll" wire:change="selectedPermissionByUserAndRole('select-all')" class="form-check-input" id="selectall">
                                    <label class="form-check-label" for="selectall">All</label>
                                </div>
                            </div>
                            @foreach ($permissions as $per)
                                <div class="col-4">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" wire:model.defer="selectedPermissions" value="{{$per->name}}" class="form-check-input permissions"  id="permission{{$per->id}}">
                                        <label class="form-check-label" for="permission{{$per->id}}">{{$per->name}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        
                        <button class="btn btn-primary2" type="submit">Apply</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clear()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>