<div>
    <div class="main-header mt-2">
        <h4>Subscription Plans
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
        @can('sub-plan-add')
        <div class="card-header bg-white">
            <button class="btn btn-primary2" data-bs-toggle="modal" data-bs-target="#addPlans" wire:click="$set('modalHeader','Add a plan')">Add Plan</button>
        </div>
        @endcan
        <div class="card-body" wire:ignore>
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plan Name</th>
                        <th scope="col">Accessible Users</th>
                        <th scope="col">Actual Price</th>
                        <th scope="col">Paid Price</th>
                        <th scope="col">Conversion Rate</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $index=>$plan)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$plan->plan_name}}</td>
                            <td>{{$plan->accessible_users}}</td>
                            <td>${{$plan->actual_price}}</td>
                            <td>${{$plan->paid_price}}</td>
                            <td>{{$plan->conversion_rate}}</td>
                            <td>{{$plan->status}}</td>
                            <td>
                                @can('sub-plan-edit')
                                <button class="btn" wire:click="planOperation('edit',{{$plan->id}})" data-bs-toggle="modal" data-bs-target="#addPlans">
                                    <i class="fa fa-edit" style="font-size: 25px;color:#2073bf;" ></i>
                                </button>
                                @endcan

                                @can('sub-plan-delete')
                                <button class="btn" onclick="showDeleteAlert('plan',{{$plan->id}})">
                                    <i class="fa fa-trash" style="font-size: 25px;color:#2073bf;"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @can('sub-plan-add')
    <div wire:ignore.self class="modal fade" id="addPlans" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                   {{$modalHeader}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="planOperation('add-update')">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="text" wire:model.defer="planArray.plan_name" class="form-control only-border-bottom" id="planname" placeholder="planname" required>
                                    <label for="planname">Plan Name</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model.defer="planArray.actual_price" class="form-control only-border-bottom" id="actualprice" placeholder="actualprice" required>
                                    <label for="actualprice">Actual Price</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model.defer="planArray.paid_price" class="form-control only-border-bottom" id="paidprice" placeholder="paidprice" required>
                                    <label for="paidprice">Paid Price</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model.defer="planArray.accessible_users" class="form-control only-border-bottom" id="accessibleusers" placeholder="accessibleusers" required>
                                    <label for="accessibleusers">Accessible Users</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model.defer="planArray.conversion_rate" class="form-control only-border-bottom" id="conversionrate" placeholder="conversionrate" required>
                                    <label for="conversionrate">Conversion Rate</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model.defer="planArray.tax" class="form-control only-border-bottom" id="tax" placeholder="tax" required>
                                    <label for="tax">Tax</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating mb-3">
                                    <select wire:model.defer="planArray.status" class="form-control only-border-bottom">
                                        <option value="draft">Draft</option>
                                        <option value="active">Active</option>
                                    </select>
                                    <label for="tax">Status</label>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary2" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" wire:click="clear()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
 