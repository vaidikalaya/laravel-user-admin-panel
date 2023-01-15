@include('includes.header',['page_css'=>'loginStyle.css'])

<div class="container signup-page">

    <div class="text-center mt-5 signup-head">
      <h3 class="fw-bold" style="color:#15477b">LOGIN</h3>
      <span class="d-flex justify-content-center"><hr></span>
    </div>

    <div class="col-md-12 col-lg-8 mx-auto">
        <div class="row w-100">
            <div class="col-md-4 d-none d-md-block fw-bold text-white text-center" style="background: #039be5;">
                <p style="margin-top: 37%;">Get Access To Smart Intelligence For Conferences From All Around The World</p>
            </div>
            <div class="col-sm-12 col-md-8 card card-body shadow ml-sm-10">
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="row mt-3">

                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" placeholder="email">
                                <label for="email">Email</label>
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password">
                                <label for="password">Password</label>
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Keep me logged in</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <p class="float-end">
                            @if (Route::has('password.request'))
                                <a class="btn" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" style="color: #039be5;">Forgot Password</a>
                            @endif
                            </p>
                        </div>

                        <div class="text-center submit-button">
                            <button class="btn text-white" type="submit">LOGIN</button>
                            <p><a href="/register">New to QuantiNova? Sign In</a></p>
                        </div>

                        @if (session('status'))
                          <div class="alert alert-success mt-3" role="alert">
                            {{ session('status') }}
                          </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center text-white fw-bold" style="background: #2175bf">
                Forgot Password
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control border-top-0 border-right-0 border-left-0 @error('email') is-invalid @enderror " id="forgotemail" placeholder="enter your email address">
                        <label for="forgotemail">Email address</label>
                        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="text-center">
                        <button class="btn text-white fw-bold" type="submit" style="background: #e8701d">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@include('includes.footer')
