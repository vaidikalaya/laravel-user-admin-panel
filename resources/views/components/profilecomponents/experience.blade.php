<div class="row">

    <div class="col-md-4">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="experienceArray.organization" class="form-control" id="organization" placeholder="organization" required>
          <label for="organization">Organization</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="experienceArray.location" class="form-control" id="locationname" placeholder="locationname" required>
          <label for="locationname">Location</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="experienceArray.designation" class="form-control" id="designationname" placeholder="designationname" required>
          <label for="designationname">Designation</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="date" wire:model.defer="experienceArray.start_date" class="form-control" id="startdate" placeholder="startdate" required>
          <label for="startdate">Start Date</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="date" wire:model.defer="experienceArray.end_date" class="form-control" id="enddate" placeholder="enddate">
          <label for="enddate">End Date</label>
        </div>
    </div>

</div>