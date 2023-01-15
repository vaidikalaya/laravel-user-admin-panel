<div class="row">

    <div class="col-md-4"> 
        <div class="form-floating mb-3">
            <select wire:model.defer="educationArray.type" class="form-control" id="education" required>
                <option value="">Select Type</option>
                <option value="Board Certification">Board Certification</option>
                <option value="Residency">Residency</option>
                <option value="Fellowship">Fellowship</option>
                <option value="Internship">Internship</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="educationArray.specialty" class="form-control" id="specialty" placeholder="specialty" required>
          <label for="specialty">Specialty</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="educationArray.institute" class="form-control" id="institutename" placeholder="institutename" required>
          <label for="institutename">Institute Name</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="date" wire:model.defer="educationArray.start_date" class="form-control" id="startdate" placeholder="startdate" required>
          <label for="startdate">Start Date</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="date" wire:model.defer="educationArray.end_date" class="form-control" id="enddate" placeholder="enddate">
          <label for="enddate">End Date</label>
        </div>
    </div>

</div>