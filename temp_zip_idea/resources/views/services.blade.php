@extends('layouts.app')

@section('title', __('messages.welcome'))

@section('content')
<section class="aboutus-hero position-relative">
    <img src="{{ asset('images/about-hero.png') }}" class="aboutus-bg-img" alt="">
    <div class="aboutus-overlay"></div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center aboutus-hero-content">
        <h2 class="aboutus-title mb-2">{{ __('main.aboutus_title') }}</h2>
        <div class="aboutus-lead">{{ __('main.aboutus_lead') }}</div>
    </div>
</section>


<style>
.aboutus-hero { min-height:320px; height:320px; position:relative; }
.aboutus-bg-img {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    object-fit: cover; z-index: 1; }
.aboutus-overlay {
    position: absolute; inset: 0; background: rgba(33,39,78,0.51);
    z-index: 2;
}
.aboutus-hero-content {
    position: relative; z-index: 3; min-height: 300px;
    justify-content: center;
}
.aboutus-title {
    color: #fff;
    font-size: 2.1rem;
    font-weight: bold;
    letter-spacing: -0.2px;
}
.aboutus-lead {
    color: #e6e7ea;
    font-size: 1.1rem;
    font-weight: 400;
    margin-top: 6px;
}
</style>
@php
$services = [
    [
        'image' => 'images/service-ooh.jpg',
        'title' => __('main.ooh_title'),
        'desc'  => __('main.ooh_desc'),
        'bg_dark' => false,
    ],
    [
        'image' => '',
        'title' => __('main.interior_title'),
        'desc'  => __('main.interior_desc'),
        'bg_dark' => true,
    ],
    [
        'image' => '',
        'title' => __('main.branding_title'),
        'desc'  => __('main.branding_desc'),
        'bg_dark' => false,
    ],
    [
        'image' => '',
        'title' => __('main.digital_title'),
        'desc'  => __('main.digital_desc'),
        'bg_dark' => true,
    ],
    [
        'image' => '',
        'title' => __('main.events_title'),
        'desc'  => __('main.events_desc'),
        'bg_dark' => false,
    ],
    [
        'image' => '',
        'title' => __('main.exhibitions_title'),
        'desc'  => __('main.exhibitions_desc'),
        'bg_dark' => true,
    ],
    [
        'image' => '',
        'title' => __('main.video_title'),
        'desc'  => __('main.video_desc'),
        'bg_dark' => false,
    ],
    [
        'image' => '',
        'title' => __('main.web_title'),
        'desc'  => __('main.web_desc'),
        'bg_dark' => true,
    ],
    [
        'image' => '',
        'title' => __('main.certifications_title'),
        'desc'  => __('main.certifications_desc'),
        'bg_dark' => false,
    ],
];
@endphp

<div class="services-list-custom">
    @foreach($services as $i => $service)
        <div class="service-card-custom d-flex flex-column flex-md-row mb-4 {{ $service['bg_dark'] ? 'service-card-custom-dark' : '' }}">
            @if($i % 2 == 0)
                {{-- الصورة أو الفراغ يسار للكارت الفردي --}}
                <div class="service-card-img-custom" style="background-image:url('{{ asset($service['image'] ?: 'images/service-placeholder.png') }}')">
                    @if($i == 0)
                        <div class="service-card-img-overlay-custom">
                            <span>{{ __('main.our_services') }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <div class="service-card-content-custom flex-fill d-flex flex-column justify-content-center px-4 py-4">
                <h5 class="service-card-title-custom mb-2">{{ $service['title'] }}</h5>
                <div class="service-card-desc-custom mb-3">{{ $service['desc'] }}</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-sm btn-outline-primary custom-btn-outline">{{ __('main.btn_readmore') }}</a>
                    <a href="#" class="btn btn-sm btn-primary custom-btn-main">{{ __('main.btn_contact') }}</a>
                    @if($i == 5)
                        <a href="#" class="btn btn-sm btn-outline-secondary custom-btn-gray">{{ __('main.btn_learnmore') }}</a>
                    @endif
                </div>
            </div>

            @if($i % 2 == 1)
                {{-- الصورة أو الفراغ يمين للكارت الزوجي --}}
                <div class="service-card-img-custom" style="background-image:url('{{ asset($service['image'] ?: 'images/service-placeholder.png') }}')"></div>
            @endif
        </div>
    @endforeach
</div>

<style>
.services-list-custom {
    width: 100%;
    max-width: 875px;
    margin: 32px auto;
}
.service-card-custom {
    min-height: 195px;
    border-radius: 0;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 16px #2232570e;
    align-items: stretch;
}
.service-card-custom-dark {
    background: #223257 !important;
    color: #fff;
}
.service-card-img-custom {
    width: 100%;
    max-width: 206px;
    min-width: 150px;
    background: #e6e9f2;
    min-height: 145px;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: flex-end;
}
@media (min-width: 768px) {
    .service-card-img-custom {
        width: 205px;
        min-width: 205px;
        height: 195px;
    }
}
@media (max-width: 767px) {
    .service-card-img-custom {
        min-width: 100px;
        height: 140px;
        max-width: 100%;
    }
    .services-list-custom { max-width: 100%; }
}
.service-card-content-custom {
    background: transparent;
}
.service-card-title-custom {
    font-size: 1.15rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    color: inherit;
}
.service-card-desc-custom {
    color: #444;
    font-size: 1.02rem;
    font-weight: 400;
    line-height: 1.7;
}
.service-card-custom-dark .service-card-title-custom,
.service-card-custom-dark .service-card-desc-custom {
    color: #fff !important;
}
.service-card-custom-dark .custom-btn-outline {
    border-color: #fff !important;
    color: #fff !important;
}
.service-card-custom-dark .custom-btn-outline:hover {
    background: #fff !important;
    color: #223257 !important;
}
.service-card-img-overlay-custom {
    background: rgba(36,56,90,0.89);
    color: #fff;
    font-size: 1.07rem;
    font-weight: 700;
    padding: 13px 18px 9px 14px;
    border-radius: 0 0 0 0;
    position: absolute;
    left: 0; right: 0; bottom: 0;
    letter-spacing: 0.03em;
}
.custom-btn-main {
    background: #223257 !important;
    border: none;
    color: #fff;
    font-weight: 500;
    border-radius: 5px;
    padding: 4px 24px 4px 24px;
}
.custom-btn-main:hover {
    background: #334079 !important;
}
.custom-btn-outline {
    border: 1.5px solid #223257;
    color: #223257;
    border-radius: 5px;
    padding: 4px 18px 4px 18px;
    font-weight: 500;
    background: transparent;
}
.custom-btn-outline:hover {
    background: #223257;
    color: #fff;
}
.custom-btn-gray {
    background: #f5f7fa !important;
    color: #223257 !important;
    border: none !important;
}
.custom-btn-gray:hover {
    background: #e9eef4 !important;
}
</style>




@endsection
