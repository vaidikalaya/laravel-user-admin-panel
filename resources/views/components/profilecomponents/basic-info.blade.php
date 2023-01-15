<div class="row">

    <div class="col-md-3">
        <div class="form-floating">
            <select class="form-select" wire:model.defer="basicInfoArray.salutation" required>
              <option value="Mr.">Mr.</option>
              <option value="Ms.">Ms.</option>
              <option value="Dr.">Dr.</option>
              <option value="Prof.">Prof.</option>
            </select>
            <label for="salutation">Salutation</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="text" wire:model.defer="basicInfoArray.firstname" class="form-control" id="firstname" placeholder="firstname" required>
            <label for="firstname">First Name</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="text" wire:model.defer="basicInfoArray.lastname" class="form-control" id="lastname" placeholder="lastname" required>
            <label for="lastname">Last Name</label>
            <input type="hidden" name="username" id="username" value="">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="email" wire:model.defer="basicInfoArray.email" class="form-control" id="email" placeholder="email" required>
            <label for="email">Email</label>
        </div>
    </div>
 
    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-select" wire:model.defer="basicInfoArray.country_id" id="selectedCountry" required>
                @php $countries=App\Models\Country::all(); @endphp
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            <label for="selectedCountry">Country</label>
        </div>
    </div>

    @role(['Doctor','Student'])
    <div class="col-md-3">
        <div class="form-floating mb-3">
        <select class="form-select" wire:model.defer="basicInfoArray.other_details.qualification">
            @php $degrees=App\Models\Degree::all(); @endphp
                <option value="">Select Degree</option>
            @foreach ($degrees as $degree)
                <option value="{{$degree->name}}">{{$degree->name}}</option>
            @endforeach
        </select>
        </div>
    </div>
    @endrole

    @role('Medical Center')
    <div class="col-md-3">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="basicInfoArray.other_details.medicalCenter" class="form-control" id="medical_center" placeholder="medical_center">
          <label for="medical_center">Medical Center</label>
        </div>
    </div>
    @endrole

    @role(['Pharmaceutical Organization','Biotechnology Organization'])
    <div class="col-md-3">
        <div class="form-floating mb-3">
          <select class="form-select" wire:model.defer="basicInfoArray.other_details.organization">
            @php $organizations=App\Models\Organization::all(); @endphp
            <option value="">Organization</option>
            @foreach ($organizations as $organization)
            <option value="{{$organization->name}}">{{$organization->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @endrole

</div>