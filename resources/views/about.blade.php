@extends('layouts.app')

@section('title', __('messages.welcome'))

@section('content')

<section class="aboutus-hero position-relative hero soft pt-5 mt-5">
    <img src="{{ asset('images/about-hero.png') }}" class="aboutus-bg-img" alt="">
    <div class="aboutus-overlay"></div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center aboutus-hero-content">
        <h1 class="aboutus-title mb-2 hero-title text-white">{{ __('about.aboutus_title') }}</h1>
        <p class="aboutus-lead hero-lead text-white-50">{{ __('about.aboutus_lead') }}</p>
    </div>
</section>

{{--
  <div class="container">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h2 class="mb-1">{{ __('main.aboutus_title') }}</h2>
        <div class="text-muted">IDEA Group • Since 2012</div>
      </div>
      <div class="d-flex align-items-center gap-2 muted">
        <i class="bi bi-patch-check-fill text-primary"></i>
        <span>{{ __('main.aboutus_lead') }}</span>
      </div>
    </div>
  </div>
  --}}




<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<div class="client-logos-section py-4" style="background:#fff;">
    <div class="container">
        <div class="swiper client-logos-swiper">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide"><img src="{{ asset('images/clients/chery.png') }}" alt="{{ __('about.client_chery_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/lexus.png') }}" alt="{{ __('about.client_lexus_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/rasalhamra.png') }}" alt="{{ __('about.client_rasalhamra_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/hyundai.png') }}" alt="{{ __('about.client_hyundai_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/ooredoo.png') }}" alt="{{ __('about.client_ooredoo_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/bankmuscat.png') }}" alt="{{ __('about.client_bankmuscat_alt') }}" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/ford.png') }}" alt="{{ __('about.client_ford_alt') }}" class="client-logo"></div>
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

<!-- styles moved to theme.css -->



<section class="aboutus-desc section-about">
  <div class="container">
    <!-- Mission Statement -->
<!-- Mission block (matches About page design) -->
<section class="section-about">
  <div class="container pt-4">
    <div class="aboutus-mission text-center mb-5 mission-copy">
      <p>{{ __('about.mission_paragraph_1') }}</p>
      <p>{{ __('about.mission_paragraph_2') }}</p>
    </div>
    <hr class="my-5" style="opacity:.15">
  </div>
 </section>

    <!-- Company Pills/Cards -->
    <div class="aboutus-tabs d-flex justify-content-center flex-wrap gap-3 mb-5">
      <button type="button" class="aboutus-pill active" data-company="seraj" data-link="{{ url('/services#ooh') }}">
        <span class="pill-kicker">{{ __('about.company_seraj_kicker') }}</span>
        <span class="pill-title">{{ __('about.company_seraj_title') }}</span>
        <span class="pill-sub">{{ __('about.company_seraj_sub') }}</span>
      </button>
      <button type="button" class="aboutus-pill" data-company="ides" data-link="{{ url('/services#branding') }}">
        <span class="pill-kicker">{{ __('about.company_ides_kicker') }}</span>
        <span class="pill-title">{{ __('about.company_ides_title') }}</span>
        <span class="pill-sub">{{ __('about.company_ides_sub') }}</span>
      </button>
      <button type="button" class="aboutus-pill" data-company="anmat" data-link="{{ url('/services#digital') }}">
        <span class="pill-kicker">{{ __('about.company_anmat_kicker') }}</span>
        <span class="pill-title">{{ __('about.company_anmat_title') }}</span>
        <span class="pill-sub">{{ __('about.company_anmat_sub') }}</span>
      </button>
    </div>

    <!-- Main Content Area -->
    <div class="row g-5 align-items-stretch">
      <!-- Left: Company Info Box -->
      <div class="col-lg-5 col-xl-5">
        <div class="aboutus-casebox ">
          <div class="case-header mb-4">
            <div class="aboutus-case-logo mb-3">
              <img src="{{ asset('images/seraj.png') }}" alt="{{ __('about.company_seraj_title') }}" class="company-logo">
            </div>
            <h3 class="aboutus-case-title case-title">
              {{ __('about.company_seraj_case_title') }}
            </h3>
          </div>

          <div class="case-body">
            <p class="aboutus-case-desc case-desc">
              {{ __('about.company_seraj_description') }}
            </p>

            <ul class="case-features">
              <li>{{ __('about.company_seraj_feature_1') }}</li>
              <li>{{ __('about.company_seraj_feature_2') }}</li>
              <li>{{ __('about.company_seraj_feature_3') }}</li>
            </ul>

            <p class="case-tagline">
              {{ __('about.company_seraj_tagline') }}
            </p>

            <a href="{{ url('/services#ooh') }}" class="btn aboutus-cta">
              <span>{{ __('about.company_cta') }}</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Right: Visual Grid -->

                        <div class="col-lg-7 col-xl-7">
                        <div class="aboutus-visual-grid">
                            <div class="grid-item large-rect top">
                                <img src="{{ asset('images/about-hero.png') }}" class="grid-image w-100 object-fit-cover d-block" loading="lazy" alt="{{ __('about.visual_top_alt') }}">
                            </div>
                            <div class="grid-item large-rect middle">
                                <img src="{{ asset('images/website-hero.png') }}" class="grid-image w-100 object-fit-cover d-block" loading="lazy" alt="{{ __('about.visual_middle_alt') }}">
                            </div>
                            <div class="grid-item stats-card">
                                <div class="stats-content">
                                    <div class="stats-number">{{ __('about.stats_regions_number') }}</div>
                                    <div class="stats-label">{!! __('about.stats_regions_label') !!}</div>
                                </div>
                            </div>
                            <div class="grid-item large-rect bottom" style="    top: -150px;">
                                <img src="{{ asset('images/anmat.png') }}" class="grid-image w-100 object-fit-cover d-block" loading="lazy" alt="{{ __('about.visual_bottom_alt') }}">
                            </div>
                        </div>
                    </div>

    </div>
  </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Company data for switching content
  const companyData = {
    seraj: {
      logo: @json(asset('images/seraj.png')),
      alt: @json(__('about.company_seraj_title')),
      title: @json(__('about.company_seraj_case_title')),
      description: @json(__('about.company_seraj_description')),
      features: @json([
        __('about.company_seraj_feature_1'),
        __('about.company_seraj_feature_2'),
        __('about.company_seraj_feature_3')
      ]),
      tagline: @json(__('about.company_seraj_tagline'))
    },
    ides: {
      logo: @json(asset('images/ides.png')),
      alt: @json(__('about.company_ides_title')),
      title: @json(__('about.company_ides_case_title')),
      description: @json(__('about.company_ides_description')),
      features: @json([
        __('about.company_ides_feature_1'),
        __('about.company_ides_feature_2'),
        __('about.company_ides_feature_3')
      ]),
      tagline: @json(__('about.company_ides_tagline'))
    },
    anmat: {
      logo: @json(asset('images/anmat.png')),
      alt: @json(__('about.company_anmat_title')),
      title: @json(__('about.company_anmat_case_title')),
      description: @json(__('about.company_anmat_description')),
      features: @json([
        __('about.company_anmat_feature_1'),
        __('about.company_anmat_feature_2'),
        __('about.company_anmat_feature_3')
      ]),
      tagline: @json(__('about.company_anmat_tagline'))
    }
  };

  const pills = document.querySelectorAll('.aboutus-pill');
  const ctaButton = document.querySelector('.aboutus-cta');

  // Handle pill switching
  pills.forEach(pill => {
    pill.addEventListener('click', function(e) {
      e.preventDefault();

      // Update active state
      pills.forEach(p => p.classList.remove('active'));
      this.classList.add('active');

      // Get company data
      const company = this.dataset.company;
      const data = companyData[company];
      if (ctaButton) {
        const targetLink = this.dataset.link;
        if (targetLink) {
          ctaButton.href = targetLink;
        }
      }

      if (data) {
        // Update content with smooth transition
        const caseBox = document.querySelector('.aboutus-casebox');
        caseBox.style.opacity = '0.7';
        caseBox.style.transform = 'translateY(10px)';

        setTimeout(() => {
          // Update logo
          const companyLogo = document.querySelector('.company-logo');
          companyLogo.src = data.logo;
          companyLogo.alt = data.alt;

          // Update title
          document.querySelector('.case-title').textContent = data.title;

          // Update description
          document.querySelector('.case-desc').textContent = data.description;

          // Update features list
          const featuresList = document.querySelector('.case-features');
          featuresList.innerHTML = data.features.map(feature => `<li>${feature}</li>`).join('');

          // Update tagline
          document.querySelector('.case-tagline').textContent = data.tagline;

          // Restore animation
          caseBox.style.opacity = '1';
          caseBox.style.transform = 'translateY(0)';
        }, 200);
      }
    });
  });

  // Add scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observe elements for animation
  document.querySelectorAll('.aboutus-pill, .aboutus-casebox, .grid-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
  });
});
</script>


@endsection
