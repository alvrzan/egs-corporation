@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.admin.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    <p>Welcome, {{ Auth::user()->username }}</p>
                    <img src="{{ Auth::user()->avatar }}" alt="Profile Picture">
                    <!-- Tambahkan konten dashboard admin di sini -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
