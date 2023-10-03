@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/content.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row animated-section">
            <div class="col-md-6">
                <h2 class="section-heading-name" id="corp">PT Exploresia Growth Seedonesia</h2>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('logo/egs.png') }}" alt="PT Exploresia Growth Seedonesia"
                    class="section-image img-fluid">
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="profile-column about-section animated-section slide-left">
                <div class="row">
                    <div class="col">
                        <h2 class="section-subheading text-light fw-bold">About</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="profile-text">
                            <p class="text-light">PT Eksploresia Growth Seedonesia Indonesia is a leading export and import company based in Indonesia. With a focus on promoting the rich cultural heritage of Indonesia, we specialize in exporting and importing authentic Indonesian products to international markets.</p>
                        </div>
                    </div>

                    <div class="row" id="contact">
                        <div class="col">
                            <h2 class="section-subheading text-light fw-bold">Contact</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="profile-text">
                                <p class="text-light">Website: <a class="text-light" href="#contact-website">www.egs.com</a></p>
                                <p class="text-light">Email: <a class="text-light" href="#contact-email">home@egs.co.id</a></p>
                                <p class="text-light">Phone: <a class="text-light" href="#contact-phone">+6281317686210</a></p>
                                <p class="text-light">Address: <a class="text-light fw-bold" href="https://goo.gl/maps/eYbbVNYoFHAbkmjb9">Senayan City, Jl. Asia Afrika, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-column mission-section animated-section slide-right">
                <div class="row">
                    <div class="col">
                        <h2 class="section-subheading text-light fw-bold">Mission</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-text">
                            <h4 class="text-light fw-bold text-light">Mendorong Ekspor Berkualitas</h4>
                            <p class="text-light">Kami berkomitmen untuk membantu produsen dan bisnis di Indonesia meningkatkan kualitas produk mereka agar dapat bersaing di pasar internasional.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-text">
                            <h4 class="text-light fw-bold">Kolaborasi Internasional</h4>
                            <p class="text-light">Kami akan aktif menjalin kemitraan dengan mitra bisnis di berbagai negara untuk memfasilitasi perdagangan lintas batas yang saling menguntungkan.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-text">
                            <h4 class="text-light fw-bold">Inovasi dan Pengembangan Produk</h4>
                            <p class="text-light">Kami akan terus mendorong inovasi dalam pengembangan produk dan layanan yang dapat memenuhi kebutuhan pasar global.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
