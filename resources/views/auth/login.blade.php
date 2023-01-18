@extends('layouts.auth-app')
@section('content')
<style>
.page-logo, body:not(.header-function-fixed) .page-logo, .header-function-fixed:not(.nav-function-top) .page-header, #msgr_listfilter_input, .msgr-list, .msgr-list + .msgr:before {
    /* -webkit-transition: all 470ms cubic-bezier(0.34, 1.25, 0.3, 1);
    transition: all 470ms cubic-bezier(0.34, 1.25, 0.3, 1); */
    height: 100px;
}
.page-logo img {
    
    height: 71px;
    width: 69px;
}
</style>
    <div class="container">
        <div class="blankpage-form-field">
            <div
                class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                
                <a href="javascript:void(0)" class="page-logo-link text-center press-scale-down d-flex align-items-center"><h4></h4>
                    <img src="{{ asset('backend/img/favicon/stud.jpg') }}" alt="Utkal University Of Culture"
                        aria-roledescription="logo">
                        
                    <span class="page-logo-text mr-1">Utkal University of Culture<br>Student Portal</span>
                </a>
            </div>
            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if (session('error'))
                    <div class="alert border-danger bg-transparent text-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group text-left">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="rememberme"> Remember me! </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default float-right">Login</button>
                </form>
            </div>
            <div class="blankpage-footer text-center">
                <a href="{{ route('password.request') }}"><strong>Forgot Password</strong></a> | <a
                    href="#"><strong>Register
                        Now</strong></a>
            </div>
        </div>
    </div>
@endsection
