<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', __('messages.welcome'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap (RTL or LTR) -->
@if(app()->getLocale() == 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
@else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endif
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<!-- Theme (Figma mapping) -->
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
   <style>
    /* استدعاء الخط بأوزان متعددة من Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

/* تطبيق الخط على جميع عناصر الموقع */
html, body, * {
  font-family: 'Poppins', sans-serif !important;
  font-weight: 400;
  font-style: normal;
}
a,
a:hover,
a:focus,
a:active {
   text-decoration: none !important;
  border: none !important;
  box-shadow: none !important;
  outline: none !important;
}
/* يمكنك تحديد أوزان معينة عند الحاجة */
h1, h2, h3, h4, h5, h6 {
  font-weight: 700; /* عناوين غليظة */
}

strong, b {
  font-weight: 600; /* نص غامق متوسط */
}

p, span, li, a {
  font-weight: 400; /* النصوص العادية */
}

        .navbar .navbar-nav {
            flex: 1;
            justify-content: center;
        }
        .navbar .lang-switch {
            min-width: 130px;
            text-align: end;
        }
        .navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
        }
    </style>
</head>
<body @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top" style="min-height:80px; padding-top:16px; padding-bottom:16px;">
    <div class="container d-flex align-items-center">
        <!-- Logo -->
        <a class="navbar-brand me-lg-4 me-2" href="#">IDEA GROUP</a>

<!-- Menu -->
<div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
    <ul class="navbar-nav mx-auto gap-lg-3 align-items-center" style="--hdr-fz:16px; --hdr-lh:1.2;">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                About us
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="{{ url('/services') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Service
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('press*') ? 'active' : '' }}" href="{{ url('/press') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Press
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('careers*') ? 'active' : '' }}" href="{{ url('/careers') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Careers
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('website') ? 'active' : '' }}" href="{{ url('/website') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Website
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh); padding:10px 12px;">
                Contact us
            </a>
        </li>
    </ul>
</div>


<!-- Language Switch -->
<div class="lang-switch ms-lg-auto ps-lg-3 d-flex align-items-center" style="font-size:var(--hdr-fz); line-height:var(--hdr-lh);">
    <i class="bi bi-globe2 me-1"></i>
    @if(app()->getLocale() == 'ar')
        <a href="{{ url('lang/en') }}" class="text-decoration-none">
            English <span class="ms-1">&rsaquo;</span>
        </a>
    @else
        <a href="{{ url('lang/ar') }}" class="text-decoration-none">
            العربية <span class="ms-1">&rsaquo;</span>
        </a>
    @endif
</div>


        <!-- Mobile toggle -->
        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

@yield('content')

@extends('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
