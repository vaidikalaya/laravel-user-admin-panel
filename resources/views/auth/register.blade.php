@include('includes.header',['page_css'=>'loginStyle.css'])

<div class="container signup-page">
    <div class="text-center mt-5 signup-head">
      <h3 class="fw-bold" style="color:#15477b">SIGNUP</h3>
      <span class="d-flex justify-content-center"><hr></span>
    </div>

    <div class="col-md-12 col-lg-10 mx-auto">
      <div class="row w-100">
        <div class="col-md-4 pt-5 p-lg-3 p-xxl-5 d-none d-md-block" style="background: #039be5;">
          <ul>
            <li class="mt-4 text-white fw-bold">
              <svg viewBox="0 0 512 512" height="25" width="25"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg>
              Search for Conferences
            </li>

            <li class="mt-4 text-white fw-bold">
              <svg viewBox="0 0 512 512" height="25" width="25"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg>
              Set Alert Notifications
            </li>

            <li class="mt-4 text-white fw-bold">
              <svg viewBox="0 0 512 512" height="25" width="25"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg>
              Bookmark Your Searches
            </li>

            <li class="mt-4 text-white fw-bold">
              <svg viewBox="0 0 512 512" height="25" width="25"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg>
              Get Conference Analytics
            </li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-8">
          <form method="POST" action="{{ route('register') }}" name="signupForm" autocomplete="off">
            @csrf
            <ul class="nav nav-pills w-100" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link w-100 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true"></button>
              </li>
              <li class="nav-item ms-1" role="presentation">
                <button class="nav-link w-100" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-form" type="button" role="tab" aria-controls="pills-form" aria-selected="false"></button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="text-center mt-3">I am a</h3>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Doctor" id="doctor">
                  <label class="form-check-label" for="doctor">
                    Doctor
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Medical Center" id="medicalcenter">
                  <label class="form-check-label" for="medicalcenter">
                    Medical Center
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Biotechnology Organization" id="biotech">
                  <label class="form-check-label" for="biotech">
                    Biotech Company
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Pharmaceutical Organization" id="pharmaceuticalorganization">
                  <label class="form-check-label" for="pharmaceuticalorganization">
                    Pharmaceutical Organization
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Partner" id="partnerr">
                  <label class="form-check-label" for="partnerr">
                    Partnet
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="profileType" value="Student" id="student">
                  <label class="form-check-label" for="student">
                    Student
                  </label>
                </div>

                <div class="text-center next-button">
                  <button class="btn text-white" type="button">Next</button>
                  <p>By Submitting, you agree to <a href="https://quantinova.ai/terms-and-conditions">QuantiNova’s Terms of Use Policy</a></p>
                  <p><a href="/login">Existing User? Log In</a></p>
                </div>

              </div>
              <div class="tab-pane fade" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
                <div class="row mt-3">
                  <div class="col-12 col-md-4">
                    <div class="form-floating">
                      <select class="form-select" name="salutation" aria-label="Floating label select example">
                        <option value="Mr." selected>Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Prof.">Prof.</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="form-floating mb-3">
                      <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" id="firstname" placeholder="firstname">
                      <label for="firstname">First Name</label>
                      @error('firstname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="form-floating mb-3">
                      <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" id="lastname" placeholder="lastname">
                      <label for="lastname">Last Name</label>
                      <input type="hidden" name="username" id="username" value="">
                      @error('lastname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="email">
                      <label for="email">Email</label>
                      @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" value="{{ old('country_id') }}" id="selectedCountry">
                        @php $countries=App\Models\Country::all(); @endphp
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                      </select>
                      @error('country_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-floating mb-3">
                      <input type="text" name="code" class="form-control" id="isdCode" placeholder="code">
                      <label for="isdCode">Code</label>
                    </div>
                  </div>

                  <div class="col-9">
                    <div class="form-floating mb-3">
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phone" placeholder="phone">
                      <label for="phone">Phone</label>
                      @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="col-12 d-none" id="doctorEducation">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="qualification" aria-label="Floating label select example">
                        @php $degrees=App\Models\Degree::all(); @endphp
                        <option value="">Select Degree</option>
                        @foreach ($degrees as $degree)
                        <option value="{{$degree->name}}">{{$degree->name}}</option>
                        @endforeach
                      </select>
                      @error('qualification')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>
                  

                  <div class="col-12 d-none" id="medicalCenter">
                    <div class="form-floating mb-3">
                      <input type="text" name="medicalCenter" class="form-control @error('medicalCenter') is-invalid @enderror" value="{{ old('medicalCenter') }}" id="medical_center" placeholder="medical_center">
                      <label for="medical_center">Medical Center</label>
                      @error('medicalCenter')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="col-12 d-none" id="organization">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="organization" aria-label="Floating label select example">
                        @php $organizations=App\Models\Organization::all(); @endphp
                        <option value="">Organization</option>
                        @foreach ($organizations as $organization)
                        <option value="{{$organization->name}}">{{$organization->name}}</option>
                        @endforeach
                      </select>
                      @error('organization')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="row d-none" id="studentEducation">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="text" name="collegeName" class="form-control @error('collegeName') is-invalid @enderror" value="{{ old('collegeName') }}" id="collegename" placeholder="collegename">
                        <label for="collegename">College Name</label>
                        @error('collegeName')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>
                     
                    </div>
                    <div class="col-sm-6">
                      <div class="form-floating mb-3">
                        <input type="text" name="ongoingCourse" class="form-control @error('ongoingCourse') is-invalid @enderror" value="{{ old('ongoingCourse') }}" id="coursename" placeholder="coursename">
                        <label for="coursename">Ongoing educational course</label>
                        @error('ongoingCourse')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>   
                    </div>

                    <div class="col-sm-6">
                      <div class="form-floating mb-3">
                        <input type="number" name="completionDate" class="form-control @error('completionDate') is-invalid @enderror" value="{{ old('completionDate') }}" id="completiondate" placeholder="completiondate">
                        <label for="completiondate">Completion date</label>
                        @error('completionDate')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" placeholder="password">
                      <label for="password">Password</label>
                      @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    
                  </div>

                  <div class="col-6">
                    <div class="form-floating mb-3">
                      <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="conpassword" placeholder="conpassword">
                      <label for="conpassword">Confirm Password</label>
                    </div>
                  </div>

                  <div class="col-3">
                    <div>
                        <input class="form-check-input" type="checkbox" name="guestCodeChecked" id="guestCodeCheckBox">
                        <label class="form-check-label" for="guestCodeCheckBox">I have guest code</label>
                    </div>
                  </div>

                  <div class="col-9 d-none" id="guest_code">
                    <div class="form-floating mb-3">
                      <input type="text" name="guestCode" class="form-control @error('guestCode') is-invalid @enderror" id="guestcode" placeholder="guestcode">
                      <label for="guestcode">Guest Code</label>
                      @error('guestCode')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="text-center submit-button">
                    <button class="btn text-white" type="submit">Submit</button>
                    <p>By Submitting, you agree to <a href="https://quantinova.ai/terms-and-conditions">QuantiNova’s Terms of Use Policy</a></p>
                    <p><a href="/login">Existing User? Log In</a></p>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $('.next-button button').click(function(e) {
    
          var profileType=document.forms["signupForm"]["profileType"].value;
          if(profileType){
            var profiles={
              'Doctor':'#doctorEducation',
              'Medical Center':'#medicalCenter',
              'Biotechnology Organization':'#organization',
              'Pharmaceutical Organization':'#organization',
              'Student':'#studentEducation'
            };
            for(key in profiles) {
              if(profileType===key){
                $(profiles[key]).removeClass('d-none');
              }
              else{
                if(profileType==='Biotechnology Organization'){
                  continue;
                }
                $(profiles[key]).addClass('d-none');
              }
            }

            $('#pills-profile-tab').removeClass('active')
            $('#pills-profile').removeClass('active');
            $('#pills-profile').removeClass('show');
  
            $('#pills-form-tab').addClass('active');
            $('#pills-form').addClass('active');
            $('#pills-form').addClass('show');
  
            e.preventDefault();
          }
          else{
             alert('please select profile');
          }
              
        });  
        
        $('#guestCodeCheckBox').click(function(e){
            if($(this).prop("checked")){
              $("#guest_code").removeClass('d-none');
            }else{
              $("#guest_code").addClass('d-none');
            }
        })
       
    });
</script>

<script>
    $("#selectedCountry").change(function(e){

        var countryId = document.getElementById("selectedCountry").value;
        $.ajax({
            type:'GET',
            url:"/getCountryIsdCode/"+countryId,
            success:function(data){
                document.getElementById("isdCode").value=data[0].isd_code;
                generateUserName(data[0].code);
            }
        });

    });
    function generateUserName(countryCode){
      var profileType=document.forms["signupForm"]["profileType"].value;
      document.getElementById("username").value=countryCode+''+profileType[0]+'A';
    }
</script>
@include('includes.footer')