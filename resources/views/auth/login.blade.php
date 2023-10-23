@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf 
                        <div class="form-group input-icon">
                            <i class="fas fa-envelope"></i> <!-- Ikon email -->
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email or Username') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        
                        
                        
                        
                        <div class="form-group input-icon">
                            <i class="fas fa-lock"></i> <!-- Ikon kunci -->
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        

                        <div class="form-group text-center mb-0">
                            <button type="submit" class="btn btn-primary mt-3">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="{{ url('auth/google') }}" class="btn">
                            {{-- <img src="{{ asset('favicon/sso.webp') }}" alt="Google Logo" class="google-logo"> --}}
                            <img src="{{ asset('images/btn-google.png') }}" alt="btn-google" class="google-logo">

                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
