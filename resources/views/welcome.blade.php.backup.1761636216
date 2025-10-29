@extends('layouts.app')

@section('title', __('welcome.hero_title'))

@section('content')
<main id="main" role="main" aria-label="Homepage main content">
    <!-- skip link for keyboard users -->
    <a class="visually-hidden-focusable" href="#main">Skip to content</a>

    <!-- Digital Slider Section (Copy this into your Blade view) -->
    <section class="section-digital-slider position-relative pt-5 mt-4">
        <div class="bg-img"></div>
        <div class="container-fluid px-0 digital-slider-content" style="max-width:100vw;">
            <div class="row w-100 flex-nowrap flex-lg-row flex-column-reverse">
                <!-- LEFT TEXT -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center" style="min-height:350px;">
            <div class="digital-service-text ps-lg-5 ps-3 w-100">
                <div id="sliderServiceNum" class="slider-num">{{ __('main.ooh_num') }}</div>
                <div id="sliderServiceTitle" class="slider-title">{{ __('main.ooh_title') }}</div>
                <div id="sliderServiceDesc" class="slider-desc">
                    {!! __('main.ooh_desc') !!}
                </div>
            </div>
                </div>
               <!-- TABS -->
    <div class="col-lg-7 pt-4 pb-4 d-flex align-items-center justify-content-lg-end justify-content-center">
        <div class="digital-services-tabs ms-lg-auto pt-2 me-0 w-100 pe-lg-5 d-none d-lg-block">
            <ul class="nav flex-column gap-1" id="digitalTabs" role="tablist" aria-label="Digital services tabs">
                            <li class="nav-item">
                                <a class="nav-link active"
                                   role="tab"
                                   aria-selected="true"
                                   tabindex="0"
                                   data-num="{{ __('main.ooh_num') }}"
                                   data-title="{{ __('main.ooh_title') }}"
                                   data-desc="{{ __('main.ooh_desc') }}"
                                   href="#" id="tab-service-01" aria-controls="sliderServiceTitle">
                                   {{ __('main.ooh_title') }}
                                   <span class="service-num">{{ __('main.ooh_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.gifts_num') }}"
                                   data-title="{{ __('main.gifts_title') }}"
                                   data-desc="{{ __('main.gifts_desc') }}"
                                   href="#" id="tab-service-02" aria-controls="sliderServiceTitle">
                                   {{ __('main.gifts_title') }}
                                   <span class="service-num">{{ __('main.gifts_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.digital_marketing_num') }}"
                                   data-title="{{ __('main.digital_marketing_title') }}"
                                   data-desc="{{ __('main.digital_marketing_desc') }}"
                                   href="#" id="tab-service-03" aria-controls="sliderServiceTitle">
                                   {{ __('main.digital_marketing_title') }}
                                   <span class="service-num">{{ __('main.digital_marketing_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.interior_num') }}"
                                   data-title="{{ __('main.interior_title') }}"
                                   data-desc="{{ __('main.interior_desc') }}"
                                   href="#" id="tab-service-04" aria-controls="sliderServiceTitle">
                                   {{ __('main.interior_title') }}
                                   <span class="service-num">{{ __('main.interior_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.game_num') }}"
                                   data-title="{{ __('main.game_title') }}"
                                   data-desc="{{ __('main.game_desc') }}"
                                   href="#" id="tab-service-05" aria-controls="sliderServiceTitle">
                                   {{ __('main.game_title') }}
                                   <span class="service-num">{{ __('main.game_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.video_num') }}"
                                   data-title="{{ __('main.video_title') }}"
                                   data-desc="{{ __('main.video_desc') }}"
                                   href="#" id="tab-service-06" aria-controls="sliderServiceTitle">
                                   {{ __('main.video_title') }}
                                   <span class="service-num">{{ __('main.video_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.branding_num') }}"
                                   data-title="{{ __('main.branding_title') }}"
                                   data-desc="{{ __('main.branding_desc') }}"
                                   href="#" id="tab-service-07" aria-controls="sliderServiceTitle">
                                   {{ __('main.branding_title') }}
                                   <span class="service-num">{{ __('main.branding_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.webdev_num') }}"
                                   data-title="{{ __('main.webdev_title') }}"
                                   data-desc="{{ __('main.webdev_desc') }}"
                                   href="#" id="tab-service-08" aria-controls="sliderServiceTitle">
                                   {{ __('main.webdev_title') }}
                                   <span class="service-num">{{ __('main.webdev_num') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   aria-selected="false"
                                   tabindex="-1"
                                   data-num="{{ __('main.event_num') }}"
                                   data-title="{{ __('main.event_title') }}"
                                   data-desc="{{ __('main.event_desc') }}"
                                   href="#" id="tab-service-09" aria-controls="sliderServiceTitle">
                                   {{ __('main.event_title') }}
                                   <span class="service-num">{{ __('main.event_num') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Arrows for mobile slider (optional) -->
            <div class="slider-arrows d-lg-none">
                <button class="slider-arrow prev" type="button"><span>&#8592;</span></button>
                <button class="slider-arrow next" type="button"><span>&#8594;</span></button>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 CDN (add to your layout if not included) -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <style>
    :root{
        /* Colors */
        --brand-900: #223257;
        --brand-800: #173466;
        --accent: #61d2ff;
        --accent-2: #67d5ff;
        --bg-page: #ffffff;
        --muted: #4d5674;
        --soft: #f7f9fc;

        /* Spacing */
        --space-xs: 6px;
        --space-sm: 12px;
        --space-md: 20px;
        --space-lg: 32px;

        /* Typography */
        --font-sans: 'Poppins', 'Tajawal', Arial, sans-serif;
        --h1-size: clamp(1.5rem, 3vw, 2.6rem);
        --h2-size: clamp(1.25rem, 2.5vw, 2.25rem);
        --lead-size: 1.07rem;
        --body-size: 1rem;
        --line-height: 1.45;
    }

    /* Base */
    body, html { font-family: var(--font-sans); -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; color: #222; }
    h1,h2,h3,h4 { line-height: 1.12; margin: 0 0 var(--space-sm) 0; color: var(--brand-900); }
    h1 { font-size: var(--h1-size); font-weight: 800; letter-spacing: -0.6px; }
    h2 { font-size: var(--h2-size); font-weight: 700; }
    p, .text-muted { font-size: var(--body-size); line-height: var(--line-height); color: #444; }

    /* Utility */
    .visually-hidden-focusable { position: absolute; left: -9999px; top:auto; width:1px; height:1px; overflow:hidden; }
    .visually-hidden-focusable:focus { position: static; width: auto; height: auto; left: auto; }

    /* Reused components */
    .card-surface { background:#fff; border-radius:18px; box-shadow: 0 6px 26px rgba(34,50,87,0.06); }
    .btn-brand { background: var(--brand-900); color: #fff; border-radius: 10px; border: none; padding: 10px 18px; }
    .muted { color: var(--muted); }

    /* Core Section */
    .section-digital-slider {
        min-height: 430px;
        height: 100%;
        background: #24385A;
        position: relative;
        color: #fff;
        overflow: hidden;
        font-family: 'Poppins', 'Tajawal', Arial, sans-serif;
        width: 100vw;
        max-width: 100vw;
        padding: 0;
    }
    .section-digital-slider .bg-img {
        position: absolute;
        inset: 0;
        width: 100vw;
        height: 100%;
        z-index: 1;
        /* Use background-color + background-image */
        background-image: url('{{ asset('images/BG Copy.png') }}');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        /* This makes the overlay blend with the image */
        background-blend-mode: multiply;
        opacity: 1;
        pointer-events: none;
    }

    /* Overlay layer */
    .section-digital-slider .bg-img::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgb(0 26 100 / 61%); /* solid overlay */
        z-index: 2;
    }
    .digital-slider-content { position: relative; z-index: 2; min-height: 430px; }
    .digital-service-text {
        min-height: 310px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        gap: 0.65rem;
        transition: all .42s cubic-bezier(.4,1,.5,1.1);
    }
    .slider-num {
        font-size: 3.7rem; font-weight: 800; letter-spacing: 2px; color: #fff; line-height: 1; margin-bottom: 2px;
        transition: color .29s;
    }
    .slider-title {
        font-size: 2.25rem; font-weight: 700; letter-spacing: 0.5px; color: #fff; margin-bottom: 2px; line-height: 1.15;
        transition: color .29s;
    }
    .slider-desc {
        font-size: 1.11rem; line-height: 1.55; color: #e8f2ff; max-width: 440px; font-weight: 400;
        transition: color .29s;
    }
    .digital-services-tabs {
        z-index: 3; width: 92%; max-width: 475px; margin-left: auto; margin-right: 0; margin-top: 0;
        background: transparent; border-radius: 18px; box-shadow: 0 4px 32px 0 rgba(20,35,62,0.11);
    }
    .digital-services-tabs .nav-link {
        background: rgba(24, 36, 62, 0.81); color: #fff; margin-bottom: 12px;
        border-radius: 18.34px; padding: 18px 28px 18px 28px;
        font-size: 1.18rem; font-weight: 400; display: flex;
        justify-content: space-between; align-items: center;
        transition: background .28s cubic-bezier(.4,1,.5,1.1), color .16s, transform .16s;
        border: none;
        letter-spacing: 0.01em; position: relative;
        box-shadow: 0 2px 10px 0 rgba(20,35,62,0.08);
        cursor: pointer;
        outline: none;
        overflow: hidden;
    }
    .digital-services-tabs .nav-link .service-num {
        font-size: 1.33rem; font-weight: bold; opacity: 0.7;
        margin-left: 24px; font-family: inherit; letter-spacing: 1px;
        transition: color .19s, opacity .19s;
    }
    .digital-services-tabs .nav-link.active,
    .digital-services-tabs .nav-link:focus,
    .digital-services-tabs .nav-link:hover {
        background: #173466;
        color: #67d5ff;
        font-weight: 700;
        transform: translateX(-30px) scale(1.03);
        box-shadow: 0 12px 32px 0 rgba(97,210,255,0.08);
        outline: none;
    }
    .digital-services-tabs .nav-link.active .service-num,
    .digital-services-tabs .nav-link:hover .service-num {
        color: #67d5ff !important;
        opacity: 1;
    }
    .digital-services-tabs .nav-link.active::before,
    .digital-services-tabs .nav-link:hover::before {
        content: "";
        position: absolute;
        left: -12px;
        top: 10%;
        height: 80%;
        width: 7px;
        background: linear-gradient(180deg, #67d5ff 0%, #365988 100%);
        border-radius: 9px 0 0 9px;
        box-shadow: 0 0 16px #61d2ff54;
        transition: all .25s cubic-bezier(.5,.95,.45,1.2);
        opacity: 1;
    }
    .digital-services-tabs .nav-link:last-child { margin-bottom: 3px; }

    /* Arrows for mobile slider */
    .slider-arrows {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 18px;
    }
    .slider-arrow {
        background: #22355a;
        color: #67d5ff;
        border: none;
        width: 46px; height: 46px;
        border-radius: 50%;
        font-size: 1.75rem;
        box-shadow: 0 2px 8px rgba(36,56,90,0.08);
        display: flex; align-items: center; justify-content: center;
        transition: background .18s, color .16s, box-shadow .18s;
    }
    .slider-arrow:active, .slider-arrow:focus, .slider-arrow:hover {
        background: #67d5ff;
        color: #22355a;
        box-shadow: 0 4px 20px #67d5ff32;
    }

    /* Mobile: Make tabs horizontally scrollable */
    @media (max-width: 991px) {
        .section-digital-slider {
            background: #24385A;
            padding: 0;
            min-height: 420px;
            height: auto;
        }
        .section-digital-slider .bg-img {
            background:         linear-gradient(90deg, rgba(36,56,90,0.92) 0%, rgba(36,56,90,0.48) 35%, rgba(36,56,90,0.10) 78%, rgba(255,255,255,0.01) 100%),
            url('{{ asset('images/BG Copy.png') }}') center center/cover no-repeat;
            opacity: 1 !important;
            filter: none !important;
        }
        .digital-slider-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-start;
            min-height: 420px;
            padding: 0 14px 22px 14px;
            width: 100vw;
            background: none !important;
        }
        .digital-service-text {
            background: none !important;
            box-shadow: none !important;
            padding: 0;
            margin: 0 0 12px 0;
            width: 100%;
            align-items: flex-start;
            text-align: left;
        }
        .slider-num {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            margin-left: 0;
            letter-spacing: 1.2px;
        }
        .slider-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }
        .slider-desc {
            font-size: 0.98rem;
            line-height: 1.55;
            color: #e8f2ff;
            font-weight: 400;
            margin-bottom: 10px;
            max-width: 100%;
        }
        .slider-arrows {
            display: flex;
            gap: 14px;
            margin: 0 0 0 0;
            padding-left: 0;
        }
        .slider-arrow {
            background: none !important;
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 1.4rem;
            box-shadow: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color .16s;
            outline: none;
            padding: 0;
        }
        .slider-arrow:focus,
        .slider-arrow:hover {
            color: #67d5ff !important;
            background: none !important;
        }
    }

    @media (max-width: 576px) {
        .digital-service-text { padding-left: 0; }
        .section-digital-slider { min-height: 180px; }
        .slider-title { font-size: 1.35rem; }
        .slider-num { font-size: 2.1rem; }
        .slider-desc { font-size: 0.98rem; }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = Array.from(document.querySelectorAll('#digitalTabs .nav-link'));
        const serviceNum = document.getElementById('sliderServiceNum');
        const serviceTitle = document.getElementById('sliderServiceTitle');
        const serviceDesc = document.getElementById('sliderServiceDesc');
        let activeIndex = tabs.findIndex(t => t.classList.contains('active')) || 0;

        function updateTabAttributes(idx) {
            tabs.forEach((tab, i) => {
                tab.classList.toggle('active', i === idx);
                tab.setAttribute('aria-selected', i === idx ? 'true' : 'false');
                tab.setAttribute('tabindex', i === idx ? '0' : '-1');
            });
        }

        function activateTab(idx, options = { focus: true }) {
            idx = (idx + tabs.length) % tabs.length;
            const tab = tabs[idx];
            if(!tab) return;
            serviceNum.textContent = tab.getAttribute('data-num') || serviceNum.textContent;
            serviceTitle.textContent = tab.getAttribute('data-title') || serviceTitle.textContent;
            serviceDesc.textContent = tab.getAttribute('data-desc') || serviceDesc.textContent;
            activeIndex = idx;
            updateTabAttributes(idx);
            if(window.innerWidth <= 991) {
                tab.scrollIntoView({behavior:"smooth", inline:"center", block:"nearest"});
            }
            if(options.focus) tab.focus();
        }

        // Initialize attributes
        tabs.forEach((tab, i) => {
            tab.setAttribute('role', 'tab');
            if(!tab.id) tab.id = `tab-service-${String(i+1).padStart(2,'0')}`;
            tab.setAttribute('tabindex', i === activeIndex ? '0' : '-1');
            tab.setAttribute('aria-selected', i === activeIndex ? 'true' : 'false');
            // hover/click/touch
            tab.addEventListener('mouseenter', () => activateTab(i, { focus: false }));
            tab.addEventListener('click', (e) => { e.preventDefault(); activateTab(i); });
            tab.addEventListener('touchstart', () => activateTab(i, { focus: false }), {passive:true});
            // keyboard navigation (Left/Right / Up/Down)
            tab.addEventListener('keydown', (e) => {
                if(e.key === 'ArrowRight' || e.key === 'ArrowDown') { e.preventDefault(); activateTab(i+1); }
                if(e.key === 'ArrowLeft' || e.key === 'ArrowUp') { e.preventDefault(); activateTab(i-1); }
                if(e.key === 'Home') { e.preventDefault(); activateTab(0); }
                if(e.key === 'End') { e.preventDefault(); activateTab(tabs.length-1); }
            });
        });

        // Initialize view
        activateTab(activeIndex, { focus: false });

        // Slider arrows for mobile/tablet
        const prevBtn = document.querySelector('.slider-arrow.prev');
        const nextBtn = document.querySelector('.slider-arrow.next');
        if(prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => activateTab(activeIndex-1));
            nextBtn.addEventListener('click', () => activateTab(activeIndex+1));
        }
    });
    </script>

    <section class="about-section py-5" style="background: #fff;">
        <div class="container">
            <!-- Title & Lead -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div style="letter-spacing:1.3px; color:#4d5674; font-size:0.98rem; font-weight:600; margin-bottom:2px;">
                        {{ __('main.about_small') }}
                    </div>
                    <h1 class="fw-bold mb-3" style="color:#223257;font-size:2.6rem;letter-spacing:-1px;">
                        {{ __('main.about_title') }}
                    </h1>
                    <div class="mb-2" style="color:#223257;font-weight:600;font-size:1.13rem;">
                        {!! __('main.about_lead') !!}
                    </div>
                    <div class="mb-3" style="color:#222; font-size:1.07rem; font-weight:400;">
                        {{ __('main.about_p1') }}
                    </div>
                    <div class="mb-2" style="color:#444; font-size:1.08rem; font-weight:400;">
                        {!! __('main.about_p2') !!}
                    </div>
                </div>
            </div>
            <!-- Image & We Create -->
            <div class="row align-items-center g-4">
                <div class="col-md-5">
                    <img src="{{ asset('images/about.png') }}" alt="About IDEA Group" class="img-fluid shadow-sm" loading="lazy" style="max-height:510px; object-fit:cover; border-radius:18px;" width="820" height="510">
                </div>
                <div class="col-md-7">
                    <div class="about-create-card p-4" style="background:#fff; border-radius:19px; box-shadow:0 7px 30px #22325710;">
                        <div style="color:#223257; font-size:1.34rem; font-weight:700; margin-bottom: 14px;">
                            {{ __('main.about_create_title') }}
                        </div>
                        <ul style="color:#374151; font-size:1.11rem; font-weight:500; padding-left:1.5rem; margin-bottom: 0;">
                            <li>{{ __('main.about_create_1') }}</li>
                            <li>{{ __('main.about_create_2') }}</li>
                            <li>{{ __('main.about_create_3') }}</li>
                            <li>{{ __('main.about_create_4') }}</li>
                            <li>{{ __('main.about_create_5') }}</li>
                            <li>{{ __('main.about_create_6') }}</li>
                            <li>{{ __('main.about_create_7') }}</li>
                            <li>{{ __('main.about_create_8') }}</li>
                            <li>{{ __('main.about_create_9') }}</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-4 px-4 py-2" style="background:#223257; border:none; border-radius:9px; font-size:0.97rem; font-weight:700; letter-spacing:0.7px;">
                            {{ __('main.about_read_more') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CSS خاص بتحسين الخط والتدرجات (يُضاف مرة واحدة في رأس الصفحة أو ملف CSS عام) -->
    <style>
        .about-section h1, .about-section h2, .about-section h3, .about-section h4, .about-section .fw-bold {
            font-family: 'Poppins', 'Tajawal', Arial, sans-serif;
            letter-spacing: -0.6px;
        }
        .about-section ul {
            margin-bottom: 0;
        }
        .about-create-card ul li {
            margin-bottom: 7px;
            line-height: 1.65;
        }
        .about-section .btn-primary {
            background: #223257;
            border: none;
            border-radius: 9px;
            box-shadow: 0 2px 14px #22325718;
            transition: background 0.16s;
        }
        .about-section .btn-primary:hover {
            background: #182041;
        }
    </style>

    <section class="industries-section py-5" style="background: #f7f9fc;">
        <div class="container-xxl">
            <div class="row gx-5">

                <!-- Grid -->
                <div class="col-lg-12">
                    <div class="row g-4">

                                <!-- Title & Description -->
                <div class="col-md-6 col-xl-4">
                    <h2 class="fw-bold" style="color:#223257;letter-spacing:-0.5px; font-size:2.5rem;line-height:1.12;">{{ __('main.industries_title') }}</h2>
                    <div class="text-muted mt-3" style="font-size:1.4rem;line-height:1.5;max-width:340px;">{{ __('main.industries_lead') }}</div>
                </div>

                        <!-- Item 1 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_01_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_01_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_01_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 2 (Active) -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-active h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_02_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_02_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_02_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_03_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_03_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_03_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_04_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_04_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_04_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 5 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_05_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_05_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_05_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 6 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_06_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_06_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_06_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 7 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_07_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_07_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_07_desc') }}</div>
                            </div>
                        </div>
                        <!-- Item 8 -->
                        <div class="col-md-6 col-xl-4">
                            <div class="industry-card industry-card-hover h-100 px-4 py-4">
                                <div class="industry-num">{{ __('main.industry_08_num') }}</div>
                                <div class="industry-title">{{ __('main.industry_08_title') }}</div>
                                <div class="industry-desc">{{ __('main.industry_08_desc') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CSS احترافي 100% مطابق لفجما -->
    <style>
    .industry-card {
        background: #fff;
        border-radius: 19px;
        box-shadow: 0 4px 36px #22325712;
        min-height: 360px;
        transition: all .2s cubic-bezier(.45,.05,.55,1.12);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        gap: 8px;
    }
    .industry-card .industry-num {
        font-size: 3.5rem;
        font-weight: 700;
        color: #223257;
        letter-spacing: 0.02em;
        line-height: 1;
        margin: 5px;
        padding-top:15px;
    }
    .industry-card .industry-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1c2236;
        margin-bottom: 5px;
        line-height: 1.23;
    }
    .industry-card .industry-desc {
        font-size: 1.3rem;
        color: #4b5877;
        font-weight: 400;
        margin-top: 5px;
        line-height: 1.54;
    }
    .industry-active, .industry-card-hover:hover {
        background: #223257 !important;
        color: #fff !important;
        box-shadow: 0 4px 36px #22325732;
    }
    .industry-active .industry-num,
    .industry-card-hover:hover .industry-num {
        color: #fff !important;
    }
    .industry-active .industry-title,
    .industry-card-hover:hover .industry-title {
        color: #fff !important;
    }
    .industry-active .industry-desc,
    .industry-card-hover:hover .industry-desc {
        color: #dee2ee !important;
    }
    @media (max-width: 991px) {
        .industry-card { min-height: 160px; }
        .industry-card .industry-title { font-size: 1rem;}
        .industry-card .industry-desc { font-size: 0.96rem;}
    }
    </style>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <div class="client-logos-section py-3" style="background: #fff;">
        <div class="container">
            <div class="swiper client-logos-swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="{{ asset('images/clients/chery.png') }}" alt="Chery logo" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/lexus.png') }}" alt="Lexus logo" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/rasalhamra.png') }}" alt="Ras Al Hamra" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/hyundai.png') }}" alt="Hyundai" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/ooredoo.png') }}" alt="Ooredoo" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/bankmuscat.png') }}" alt="Bank Muscat" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <div class="swiper-slide"><img src="{{ asset('images/clients/ford.png') }}" alt="Ford" class="client-logo" loading="lazy" width="140" height="50"></div>
                    <!-- أضف المزيد إذا احتجت -->
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const isRTL = document.documentElement.dir === 'rtl';

        new Swiper('.client-logos-swiper', {
            slidesPerView: 5,
            spaceBetween: 40,
            loop: true,
            speed: 650,
            autoplay: {
                delay: 1600,
                disableOnInteraction: false,
            },
            breakpoints: {
                0:   { slidesPerView: 2, spaceBetween: 16 },
                520: { slidesPerView: 3, spaceBetween: 18 },
                768: { slidesPerView: 4, spaceBetween: 28 },
                992: { slidesPerView: 5, spaceBetween: 40 },
            },
            grabCursor: true,
            rtl: isRTL,
            allowTouchMove: true,
            // لا تحتاج arrows في هذا التصميم
        });
    });
    </script>

    <style>
    .client-logos-section {
        border-bottom: 1.2px solid #efefef;
        margin-bottom: 10px;
    }
    .client-logo {
        height: 50px;
        width: auto;
        max-width: 135px;
        object-fit: contain;
        filter: grayscale(100%);
        opacity: 0.86;
        transition: opacity .18s;
        display: block;
        margin: 0 auto;
        padding: 0 10px;
    }
    .client-logo:hover {
        opacity: 1;
        filter: grayscale(0%);
    }
    .swiper.client-logos-swiper {
        padding: 8px 0;
    }
    .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 65px;
    }
    @media (max-width: 520px) {
        .client-logo { height: 38px; }
        .swiper-slide { height: 48px; }
    }
    </style>

    <section class="services-section pt-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-2" style="color:#223257;letter-spacing:-1px;">{{ __('main.services_title') }}</h2>
            <div class="mb-4" style="color:#595959; font-size:1.07rem;">
                {{ __('main.services_lead') }}
            </div>

            <!-- الشبكة الرئيسية -->
            <div class="row justify-content-center g-4 mb-3">
                <!-- أول صف: 2 عناصر كبار -->
                <div class="col-md-4">
                    <div class="service-card h-100 d-flex flex-column justify-content-between">
                        <img src="{{ asset('images/ooh.png') }}" class="service-img mb-0" alt="">
                        <div class="d-flex align-items-center justify-content-between px-2 py-3" style="min-height:46px;">

                        <div class="service-title m-0">{{ __('main.service_ooh') }}</div>
                            <a href="#" class="service-arrow d-flex align-items-center justify-content-center ms-2">
                                <span style="font-size:1.15rem;display:inline-block;">&rarr;</span>
                            </a>
                         </div></div>
                </div>

                <div class="col-md-4">
                    <div class="service-card h-100 d-flex flex-column justify-content-between">
                        <img src="{{ asset('images/branding.png') }}" class="service-img mb-0" alt="">
                        <div class="d-flex align-items-center justify-content-between px-2 py-3" style="min-height:46px;">
                            <div class="service-title m-0">{{ __('main.service_branding') }}</div>
                            <a href="#" class="service-arrow d-flex align-items-center justify-content-center ms-2">
                                <span style="font-size:1.15rem;display:inline-block;">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>


            </div>

            <!-- بقية الخدمات: شبكة 4 أعمدة لحد الشاشات الصغيرة -->
            <div class="row g-4 justify-content-center">
                @php
                    $services = [
                        [
                            'img' => 'interior.png',
                            'title' => __('main.service_interior'),
                        ],
                        [
                            'img' => 'digital-marketing.png',
                            'title' => __('main.service_digital'),
                        ],
                        [
                            'img' => 'video.png',
                            'title' => __('main.service_video'),
                        ],
                        [
                            'img' => 'gifts.png',
                            'title' => __('main.service_gifts'),
                        ],
                        [
                            'img' => 'web.png',
                            'title' => __('main.service_web'),
                        ],
                        [
                            'img' => 'events.png',
                            'title' => __('main.service_events'),
                        ],
                        [
                            'img' => 'game.png',
                            'title' => __('main.service_game'),
                        ],
                        [
                            'img' => 'permits.png',
                            'title' => __('main.service_permits'),
                        ],
                    ];
                @endphp
                @foreach ($services as $srv)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="service-card h-100 d-flex flex-column align-items-center justify-content-between">
                        <img src="{{ asset('images/services/'.$srv['img']) }}" class="service-img mb-2" alt="{{ $srv['title'] }}" loading="lazy" width="400" height="300">
                        <div class="service-title mb-2">{{ $srv['title'] }}</div>
                        <a href="#" class="service-arrow"><span>&rarr;</span></a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- زر See All -->
            <div class="pt-4">
                <a href="#" class="see-all-btn btn btn-dark px-4 rounded-3" style="background:#223257;border:none;font-size:0.95rem;">{{ __('main.see_all') }}</a>
            </div>
        </div>
    </section>



    <style>
    services-section { background: #fff; }
    .service-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px #22325714;
        padding: 12px 10px 14px 10px;
        min-height: 408px;
        transition: box-shadow .19s, transform .14s;
        border: 1.2px solid #f2f3fa;
        position: relative;
    }
    .service-card:hover {
        box-shadow: 0 8px 32px #22325724;
        transform: translateY(-4px) scale(1.02);
        border-color: #22325715;
    }
    .service-img {
        width: 100%;
        height: 301.49px;
        object-fit: cover;
        border-radius: 13px;
        margin-bottom: 8px;
        background: #f7f7fa;
        box-shadow: 0 2px 10px #22325709;
    }
    .service-title {
        font-weight: 500;
        color: #223257;
        font-size: 1.09rem;
        text-align: center;
    }
    .service-arrow {
       color: #223257;
        font-size: 1.17rem;
        background: transparent;
        border: none;
        transition: color .12s;
        text-decoration: none;
        margin-left: 4px;
        margin-right: 0;
        min-width: 26px;
        min-height: 26px;
    }
    .service-card:hover .service-arrow {
        color: #61d2ff;
    }
    service-card:hover {
        box-shadow: 0 8px 32px #22325724;
        transform: translateY(-4px) scale(1.018);
        border-color: #22325715;
    }
    .see-all-btn {
        min-width: 130px;
        border-radius: 8px;
        font-size: 0.98rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        background: #223257;
        color: #fff;
    }
    @media (max-width: 991px) {
        .service-img { height: 90px; }
        .service-card { min-height: 200px; }
    }
    @media (max-width: 575px) {
        .service-img { height: 60px; }
        .service-card { min-height: 120px; }
        .service-title { font-size: 0.96rem; }
    }
    </style>

    @if(isset($members) && $members->count() > 0)
    <section class="team-section">
        <div class="container">
            <h2 class="team-heading">{{ __('main.meet_team') }}</h2>

            <div class="swiper team-swiper" dir="ltr">
                <div class="swiper-wrapper">
                    @foreach($members as $member)
                        <div class="swiper-slide team-card" data-swiper-slide-index="{{ $loop->index }}">
                            <div class="card-image-wrapper">
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy" width="480" height="360">
                                <div class="card-overlay">
                                    <h3 class="member-name">{{ $member->name }}</h3>
                                    <p class="member-title">{{ $member->title }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="team-navigation">
            <button class="nav-arrow prev-arrow" type="button" aria-label="Previous team member"></button>
            <button class="nav-arrow next-arrow" type="button" aria-label="Next team member"></button>
        </div>
    </div>
    </section>

    {{-- تضمين Swiper CSS مباشرة --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
    :root {
        --team-bg: #F3F6FA;
        --team-heading: #3C4A7A;
        --card-radius: 22px;
        --speed: 0.55s;
        --easing: cubic-bezier(0.65, 0.05, 0.36, 1);

        /* أبعاد ديناميكية لكل عرض */
        --narrow: 132px;
        --wide: 480px;
        --card-height: 410px;
    }

    .team-section {
        background: var(--team-bg);
        padding: 72px 0 88px;
        position: relative;
        overflow: hidden;
        direction: ltr;
    }

    .team-heading {
        color: var(--team-heading);
        font-weight: 800;
        font-size: clamp(1.9rem, 3.5vw, 2.6rem);
        letter-spacing: -0.6px;
        margin: 0 0 28px;
        text-align: left;
        direction: ltr;
    }

    /* السلايدر */
    .team-swiper {
        position: relative;
        padding-bottom: 56px;
        overflow: visible;
        width: 100%;
    }

    .swiper-wrapper {
        display: flex;
        align-items: stretch;
        transition-timing-function: var(--easing) !important;
    }

    /* الكروت - الحالة الافتراضية الضيقة */
    .team-card {
        width: var(--narrow) !important;
        height: var(--card-height);
        border-radius: var(--card-radius);
        overflow: hidden;
        cursor: pointer;
        transition: width var(--speed) var(--easing);
        flex-shrink: 0;
        position: relative;
    }

    .card-image-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
    }

    .team-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: var(--card-radius);
        filter: grayscale(100%);
        transition: filter var(--speed) var(--easing), transform var(--speed) var(--easing);
        display: block;
    }

    /* الكارت النشط العريض */
    .team-card.swiper-slide-active {
        width: var(--wide) !important;
        z-index: 2;
    }

    .team-card.swiper-slide-active img {
        filter: grayscale(0%);
        transform: scale(1.04);
    }

    /* الأوفرلاي للاسم والوظيفة - يظهر فقط بالكارت النشط */
    .card-overlay {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 22px 20px 20px;
        color: #fff;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.85) 100%);
        opacity: 0;
        visibility: hidden;
        transform: translateY(14px);
        transition: opacity 0.35s ease 0.15s, transform 0.35s ease 0.15s, visibility 0s 0.55s;
        z-index: 3;
    }

    .team-card.swiper-slide-active .card-overlay {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        transition: opacity 0.35s ease 0.15s, transform 0.35s ease 0.15s;
    }

    .member-name {
        margin: 0 0 4px;
        font-weight: 700;
        font-size: 1.1rem;
        line-height: 1.3;
    }

    .member-title {
        margin: 0;
        opacity: 0.9;
        font-weight: 600;
        font-size: 0.92rem;
        line-height: 1.2;
    }

    /* الأسهم أسفل اليمين */
    .team-navigation {
        position: absolute;
        right: 20px;
        bottom: 0;
        display: flex;
        gap: 14px;
        z-index: 10;
    }

    .nav-arrow {
        width: 34px;
        height: 34px;
        border: 1px solid rgba(60, 74, 122, 0.25);
        background: #fff;
        border-radius: 50%;
        color: var(--team-heading);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.2s ease;
        outline: none;
    }

    .nav-arrow:hover:not(.swiper-button-disabled) {
        transform: scale(1.08);
        box-shadow: 0 6px 18px rgba(60, 74, 122, 0.18);
        border-color: rgba(60, 74, 122, 0.45);
    }

    .nav-arrow::after {
        font-size: 18px;
        line-height: 1;
    }

    .prev-arrow::after { content: "←"; }
    .next-arrow::after { content: "→"; }

    .nav-arrow.swiper-button-disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    /* الاستجابة */
    @media (max-width: 1200px) {
        :root {
            --narrow: 120px;
            --wide: 420px;
            --card-height: 360px;
        }
    }

    @media (max-width: 900px) {
        .team-section {
            padding: 60px 0 72px;
        }
        :root {
            --narrow: 100px;
            --wide: 340px;
            --card-height: 310px;
        }
    }

    @media (max-width: 560px) {
        :root {
            --narrow: 84px;
            --wide: 280px;
            --card-height: 260px;
        }
        .member-name { font-size: 1rem; }
        .member-title { font-size: 0.82rem; }
        .team-navigation { right: 15px; }
    }
    </style>

    {{-- تضمين Swiper JS مباشرة --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded - Starting Swiper Init');

        // انتظار قصير للتأكد من تحميل كل شيء
        setTimeout(function() {
            initTeamSwiper();
        }, 100);
    });

    function initTeamSwiper() {
        console.log('Attempting to initialize Swiper...');

        // فحص تحميل مكتبة Swiper
        if (typeof Swiper === 'undefined') {
            console.error('❌ Swiper library not found');
            return;
        }
        console.log('✅ Swiper library loaded');

        const teamSwiperEl = document.querySelector('.team-swiper');
        if (!teamSwiperEl) {
            console.error('❌ Team swiper element not found');
            return;
        }
        console.log('✅ Swiper element found');

        const slides = teamSwiperEl.querySelectorAll('.swiper-slide');
        if (slides.length === 0) {
            console.error('❌ No slides found');
            return;
        }
        console.log(`✅ Found ${slides.length} slides`);

        try {
            const swiper = new Swiper('.team-swiper', {
                // الإعدادات الأساسية
                slidesPerView: 'auto',
                spaceBetween: 16,
                speed: 650,
                grabCursor: true,

                // السلوك
                initialSlide: 0,
                centeredSlides: false,

                // Loop (فقط مع عدة slides)
                loop: slides.length > 1,

                // Autoplay (فقط مع عدة slides)
                autoplay: slides.length > 1 ? {
                    delay: 3600,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,

                // أزرار التنقل
                navigation: {
                    nextEl: '.next-arrow',
                    prevEl: '.prev-arrow',
                },

                // الكيبورد
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },

                // اللمس
                touchRatio: 1.2,

                // نقاط الاستجابة
                breakpoints: {
                    0: { spaceBetween: 12 },
                    560: { spaceBetween: 14 },
                    900: { spaceBetween: 16 }
                },

                // الأحداث
                on: {
                    init: function() {
                        console.log('🎉 Swiper initialized successfully!');

                        // تأكد من وجود slide نشط
                        const firstSlide = this.slides[0];
                        if (firstSlide) {
                            firstSlide.classList.add('swiper-slide-active');
                        }
                    },

                    slideChange: function() {
                        // إزالة الclass النشط من جميع الslides
                        this.slides.forEach(slide => {
                            slide.classList.remove('swiper-slide-active');
                        });

                        // إضافة الclass النشط للslide الحالي
                        const activeSlide = this.slides[this.activeIndex];
                        if (activeSlide) {
                            activeSlide.classList.add('swiper-slide-active');
                        }
                    },

                    error: function(error) {
                        console.error('❌ Swiper error:', error);
                    }
                }
            });

            // النقر على الكروت
            slides.forEach((slide, index) => {
                slide.addEventListener('click', function(e) {
                    e.preventDefault();
                    const slideIndex = parseInt(this.getAttribute('data-swiper-slide-index'), 10);
                    if (!isNaN(slideIndex)) {
                        if (swiper.params.loop) {
                            swiper.slideToLoop(slideIndex);
                        } else {
                            swiper.slideTo(slideIndex);
                        }
                    }
                });
            });

            // مراقبة الظهور للأوتوبلاي
            if (swiper.autoplay && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        swiper.autoplay.start();
                    } else {
                        swiper.autoplay.stop();
                    }
                }, { threshold: 0.2 });
                observer.observe(teamSwiperEl);
            }

            console.log('✅ All Swiper features initialized');

        } catch (error) {
            console.error('❌ Error initializing Swiper:', error);
        }
    }
    </script>
    @endif


</main>
@endsection
