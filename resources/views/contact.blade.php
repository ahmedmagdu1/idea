@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')

<section class=" position-relative hero soft pt-5 mt-5">
    <img src="{{ asset('https://c.animaapp.com/mh4m526aXDXfcg/img/bg.png') }}" class="aboutus-bg-img" alt="">
    <div class="aboutus-overlay"></div>
    <div class="container pt-5 h-50 d-flex flex-column justify-content-center align-items-center text-center aboutus-hero-content">
        <h1 class=" mb-2 hero-title text-white">Contact Us</h1>
        <p class="aboutus-lead hero-lead text-white-50">Any question or remarks? Just write us a message!</p>
    </div>
</section>



<!-- Contact Card & Form -->
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row shadow rounded-4 bg-white p-0">
                <!-- Contact Info (Left) -->
                <div class="col-md-4 px-0 py-4" style="background:#223257; border-radius:18px 0 0 18px; min-height:310px;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <div style="color:#fff; width:90%;">
                        <div class="fw-bold mb-1" style="font-size:1.18rem;">Contact Information</div>
                        <div class="mb-3" style="opacity:.84;">Say something to start a live chat!</div>
                        <div class="mb-3 d-flex align-items-center" style="gap:8px;">
                            <span class="bi bi-telephone-fill"></span>
                            <span>+968 000000</span>
                        </div>
                        <div class="mb-3 d-flex align-items-center" style="gap:8px;">
                            <span class="bi bi-envelope"></span>
                            <span>info@ideagroup.om</span>
                        </div>
                        <div class="mb-1 d-flex align-items-start" style="gap:8px;">
                            <span class="bi bi-geo-alt"></span>
                            <span>Al Azaiba, Muscat, Sultanate of Oman</span>
                        </div>
                    </div>
                </div>
                <!-- Form (Right) -->
                <div class="col-md-8 px-4 py-4">
                    <form>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" placeholder="+968 00000000">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Select Subject?</label>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subject" checked>
                                    <label class="form-check-label">General Inquiry</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subject">
                                    <label class="form-check-label">General Inquiry</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subject">
                                    <label class="form-check-label">General Inquiry</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="subject">
                                    <label class="form-check-label">General Inquiry</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea class="form-control" rows="3" placeholder="Write your message.."></textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn px-4 py-2" type="submit" style="background:#223257; color:#fff; border-radius:8px; min-width:150px;">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optionally add Bootstrap & icons if not already in your layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .service-card-img-overlay-custom span {font-size:1.25rem;}
    @media (max-width: 991px) {
        .col-md-4, .col-md-8 { border-radius: 0 !important;}
    }
    @media (max-width: 767px) {
        .row.shadow.bg-white { border-radius: 14px !important; }
        .col-md-4, .col-md-8 { border-radius: 0 !important;}
    }
</style>
@endsection
