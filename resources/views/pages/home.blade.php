@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/content.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="profile-column about-section animated-section slide-left">
                <div class="row">
                    <div class="col">
                        <h2 class="section-subheading text-light fw-bold">About ID-EX</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="profile-text">
                            <p class="text-light">Welcome to ID-EX, your gateway to exploring the rich cultural heritage of Indonesia. We are PT Eksploresia Growth Seedonesia Indonesia, a leading export and import company based in Indonesia. With a focus on promoting the authentic Indonesian experience, we specialize in exporting and importing a wide range of Indonesian products to international markets.</p>
                        </div>
                    </div>

                    <div class="row" id="contact">
                        <div class="col">
                            <h2 class="section-subheading text-light fw-bold">Contact ID-EX</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="profile-text">
                                <p class="text-light">Website: <a class="text-light" href="#contact-website">www.id-explorer.com</a></p>
                                <p class="text-light">Email: <a class="text-light" href="#contact-email">info@id-explorer.com</a></p>
                                <p class="text-light">Phone: <a class="text-light" href="https://wa.me/6283153977388">+62831-5397-7388</a></p>
                                <p class="text-light">Address: <a class="text-light fw-bold" href="https://goo.gl/maps/eYbbVNYoFHAbkmjb9">Senayan City, Jl. Asia Afrika, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- <img src="{{ asset('images/app-logo.png') }}" alt="ID-EX Logo" class="section-image img-fluid"> --}}
        </div>
    </div>
</div>
@endsection
