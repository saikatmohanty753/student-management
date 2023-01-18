@extends('layouts.auth-app')
@section('content')

    <div class="container" id="mydiv">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div
                    class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                    <a href="javascript:void(0)"
                        class="page-logo-link text-center press-scale-down d-flex align-items-center">
                        <img src="{{ asset('backend/img/favicon/favicon.png') }}" alt="Utkal University Of Culture"
                            aria-roledescription="logo">
                        <span class="page-logo-text mr-1">UUC Student Portal</span>
                        <span class="page-logo-text mr-1 text-right">Reset Password</span>
                    </a>
                </div>
                <div class="card">


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
