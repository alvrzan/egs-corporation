@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-center">{{ __('Register') }}</div>

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

          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group input-icon">
              <i class="fas fa-user"></i>
              <input id="first_name" type="text" class="form-control" @error('first_name') is-invalid @enderror" name="first_name" placeholder="{{ __('First Name') }}" value="{{ old('first_name') }}" required autofocus>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-user"></i>
              <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-envelope"></i>
              <input id="email" type="text" class="form-control with-icon @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-user"></i>
              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="{{ __('Username') }}" value="{{ old('username') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-phone"></i>
              <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="{{ __('Phone Number') }}" value="{{ old('phone_number') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-globe"></i>
              <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required>
            </div>

            <div class="form-group input-icon">
              <i class="fas fa-lock"></i>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
            </div>

            <div class="form-group text-center mb-0">
              <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
