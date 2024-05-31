@extends('layouts.welcome')

@section('title', '| Welcome')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="row">
    <div class="col-md-8 offset-md-2 mt-4 mr-4">
        <h3 class="text-capitalize">Coordinated Web Based Internship and Job Portal Web Application</h3>
    </div>
    <div class="col-md-4 offset-md-4"><br><br>
        <div class="card mt-4">
            <div class="card-body shadow">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a> -->
                            @endif
                            <hr>

                            <a class="btn btn-outline-success btn-block" href="{{ route('applicant.register') }}">
                                {{ __('Create New Applicant Account') }} >>
                            </a>
                            <a class="btn btn-outline-success btn-block" href="{{ route('company.register') }}">
                                {{ __('Create New Company Account') }} >>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer shadow"> 
                <small class="text-muted">
                    *If you are a company, you must first call or email us in order for us to verify if you are a legal company. Upon contacting us, we will use your provided information and decide whether to verify you or not.
                </small>
                <h6 class="font-weight-light">Email Us At:</h6>
                <p><aau class="edu et"></aau>edenkibret@gmail.com</p>
				<p>+251905518127</p>
            </div>
        </div>
    </div>
</div>

@endsection