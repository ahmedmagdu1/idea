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




<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<div class="client-logos-section py-3" style="background: #fff;">
    <div class="container">
        <div class="swiper client-logos-swiper">
            <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide"><img src="{{ asset('images/clients/chery.png') }}" alt="Chery" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/lexus.png') }}" alt="Lexus" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/rasalhamra.png') }}" alt="Ras Al Hamra" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/hyundai.png') }}" alt="Hyundai" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/ooredoo.png') }}" alt="Ooredoo" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/bankmuscat.png') }}" alt="Bank Muscat" class="client-logo"></div>
                <div class="swiper-slide"><img src="{{ asset('images/clients/ford.png') }}" alt="Ford" class="client-logo"></div>
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



<section class="aboutus-desc section-about">
  <div class="container">
    <!-- Mission Statement -->
    <div class="aboutus-mission text-center mb-5 mission-copy">
      {!! __('main.aboutus_mission') !!}
    </div>

    <!-- Company Pills/Cards -->
    <div class="aboutus-tabs d-flex justify-content-center flex-wrap gap-3 mb-5">
      <a href="#" class="aboutus-pill active" data-company="seraj">
        <span class="pill-kicker">IDEA GROUP</span>
        <span class="pill-title">Seraj Media</span>
        <span class="pill-sub">by Oneic Media</span>
      </a>
      <a href="#" class="aboutus-pill" data-company="ides">
        <span class="pill-kicker">IDEA GROUP</span>
        <span class="pill-title">Ides Design</span>
        <span class="pill-sub">by Oneic Media</span>
      </a>
      <a href="#" class="aboutus-pill" data-company="anmat">
        <span class="pill-kicker">IDEA GROUP</span>
        <span class="pill-title">Anmat</span>
        <span class="pill-sub">by Oneic Media</span>
      </a>
    </div>

    <!-- Main Content Area -->
    <div class="row g-5 align-items-stretch">
      <!-- Left: Company Info Box -->
      <div class="col-lg-5 col-xl-5">
        <div class="aboutus-casebox h-100">
          <div class="case-header mb-4">
            <div class="aboutus-case-logo mb-3">
              <img src="{{ asset('images/seraj.png') }}" alt="Seraj" class="company-logo">
            </div>
            <h3 class="aboutus-case-title case-title">
              Outdoor Advertising, Video Production, 3D Content
            </h3>
          </div>

          <div class="case-body">
            <p class="aboutus-case-desc case-desc">
              A media company that works with the urban environment. We turn the city into a platform for brand communication through:
            </p>

            <ul class="case-features">
              <li>High-impact outdoor advertising (billboards, digital screens, unconventional formats)</li>
              <li>Video content for digital displays</li>
              <li>Cutting-edge 3D animations that stop people in their tracks</li>
            </ul>

            <p class="case-tagline">
              Here, advertising becomes art — and technology is its canvas.
            </p>

            <a href="#" class="btn aboutus-cta">
              <span>{{ __('main.case_btn') ?: 'EXPLORE MORE' }}</span>
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
                                <img src="{{ asset('images/ooh.jpg') }}" alt="Office Team" class="grid-image">
                                <div class="image-overlay"></div>
                            </div>
                            <div class="grid-item large-rect middle">
                                <img src="{{ url('images/branding.jpg') }}" alt="Creative Workspace" class="grid-image">
                                <div class="image-overlay"></div>
                            </div>
                            <div class="grid-item stats-card">
                                <div class="stats-content">
                                    <div class="stats-number">+4</div>
                                    <div class="stats-label">Operating<br>Regions</div>
                                </div>
                            </div>
                            <div class="grid-item large-rect bottom">
                                <img src="{{ asset('images/branding.jpg') }}" alt="Project Showcase" class="grid-image">
                                <div class="image-overlay"></div>
                            </div>
                        </div>
                    </div>

    </div>
  </div>
</section>
<style>
/* Visual Grid - Updated to match the image exactly */
.aboutus-visual-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: repeat(3, 1fr);
  gap: 16px;
  height: 100%;
  min-height: 520px;
}

.grid-item {
  border-radius: 16px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(52, 64, 108, 0.08);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  background: var(--bg-gray);
}

.grid-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 32px rgba(52, 64, 108, 0.12);
}

/* Top row - spans both columns */
.grid-item.large-rect.top {
  grid-column: 1 / -1;
  grid-row: 1;
  height: auto;
  min-height: 160px;
}

/* Middle row - spans both columns */
.grid-item.large-rect.middle {
  grid-column: 1 / -1;
  grid-row: 2;
  height: auto;
  min-height: 160px;
}

/* Bottom left */
.grid-item.large-rect.bottom {
  grid-column: 1;
  grid-row: 3;
  height: auto;
  min-height: 160px;
}

/* Bottom right - stats card */
.grid-item.stats-card {
  grid-column: 2;
  grid-row: 3;
  background: linear-gradient(135deg, var(--primary-dark) 0%, #2C3E50 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  box-shadow: 0 8px 24px rgba(52, 64, 108, 0.15);
}

/* Image styling */
.grid-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.grid-item:hover .grid-image {
  transform: scale(1.05);
}

/* Image overlay for depth */
.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg, 
    rgba(52, 64, 108, 0.05) 0%, 
    rgba(74, 144, 226, 0.03) 100%
  );
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.grid-item:hover .image-overlay {
  opacity: 1;
}

/* Stats card styling */
.stats-content {
  text-align: center;
  color: var(--bg-white);
  z-index: 2;
  position: relative;
}

.stats-number {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1;
  margin-bottom: 12px;
  background: linear-gradient(135deg, #FFFFFF 0%, #E2E8F0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.stats-label {
  font-size: 0.9rem;
  font-weight: 600;
  opacity: 0.95;
  line-height: 1.4;
  letter-spacing: 0.02em;
}

/* Add subtle pattern to stats card */
.stats-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
    radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
  background-size: 40px 40px, 20px 20px;
  opacity: 0.3;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
  .aboutus-visual-grid {
    min-height: 480px;
    gap: 14px;
  }
  
  .grid-item.large-rect.top,
  .grid-item.large-rect.middle {
    min-height: 140px;
  }
  
  .grid-item.large-rect.bottom {
    min-height: 140px;
  }
  
  .stats-number {
    font-size: 2.5rem;
  }
}

@media (max-width: 992px) {
  .aboutus-visual-grid {
    margin-top: 32px;
    min-height: 420px;
  }
  
  .grid-item.large-rect.top,
  .grid-item.large-rect.middle {
    min-height: 120px;
  }
  
  .grid-item.large-rect.bottom {
    min-height: 120px;
  }
}

@media (max-width: 768px) {
  .aboutus-visual-grid {
    grid-template-columns: 1fr;
    grid-template-rows: repeat(4, 1fr);
    gap: 12px;
    min-height: 400px;
  }
  
  .grid-item.large-rect.top {
    grid-column: 1;
    grid-row: 1;
    min-height: 100px;
  }
  
  .grid-item.large-rect.middle {
    grid-column: 1;
    grid-row: 2;
    min-height: 100px;
  }
  
  .grid-item.large-rect.bottom {
    grid-column: 1;
    grid-row: 3;
    min-height: 100px;
  }
  
  .grid-item.stats-card {
    grid-column: 1;
    grid-row: 4;
    min-height: 120px;
  }
  
  .stats-number {
    font-size: 2.2rem;
  }
  
  .stats-label {
    font-size: 0.85rem;
  }
}

@media (max-width: 576px) {
  .aboutus-visual-grid {
    min-height: 350px;
  }
  
  .grid-item.large-rect.top,
  .grid-item.large-rect.middle,
  .grid-item.large-rect.bottom {
    min-height: 80px;
  }
  
  .grid-item.stats-card {
    min-height: 100px;
  }
  
  .stats-number {
    font-size: 2rem;
  }
}

/* Loading placeholder for images */
.grid-item.loading {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

/* Image fade-in animation */
.grid-image {
  opacity: 0;
  animation: fadeIn 0.6s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(1.1);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Add stagger delay for images */
.grid-item:nth-child(1) .grid-image { animation-delay: 0.1s; }
.grid-item:nth-child(2) .grid-image { animation-delay: 0.2s; }
.grid-item:nth-child(4) .grid-image { animation-delay: 0.3s; }
</style>

<style>
/* Design Tokens - Matching the UI exactly */
:root {
  --primary-dark: #34406C;
  --primary-blue: #4A90E2;
  --text-primary: #2C3E50;
  --text-secondary: #6B7280;
  --text-muted: #9CA3AF;
  --bg-light: #F8FAFC;
  --bg-white: #FFFFFF;
  --bg-gray: #F1F5F9;
  --border-light: #E2E8F0;
  --shadow-soft: 0 4px 20px rgba(52, 64, 108, 0.08);
  --shadow-hover: 0 8px 32px rgba(52, 64, 108, 0.12);
  --shadow-active: 0 12px 40px rgba(52, 64, 108, 0.15);
  --radius: 16px;
  --radius-lg: 20px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Section Styling */
.section-about {
  background: var(--bg-light);
  padding: 60px 0 80px;
  position: relative;
}

.section-about::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(600px 300px at 20% 10%, rgba(52, 64, 108, 0.03) 0%, transparent 60%),
    radial-gradient(400px 200px at 80% 90%, rgba(74, 144, 226, 0.02) 0%, transparent 60%);
  pointer-events: none;
}

.mission-copy {
  color: var(--text-secondary);
  font-size: 1.125rem;
  line-height: 1.6;
  max-width: 600px;
  margin: 0 auto;
}

/* Company Pills */
.aboutus-tabs {
  gap: 16px;
  margin-bottom: 48px;
}

.aboutus-pill {
  display: flex;
  flex-direction: column;
  gap: 4px;
  text-decoration: none;
  background: var(--bg-white);
  color: var(--text-primary);
  padding: 20px 24px;
  border-radius: var(--radius);
  min-width: 180px;
  border: 1px solid var(--border-light);
  box-shadow: var(--shadow-soft);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.aboutus-pill::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, var(--primary-dark), var(--primary-blue));
  opacity: 0;
  transition: var(--transition);
}

.aboutus-pill * {
  position: relative;
  z-index: 1;
}

.pill-kicker {
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-muted);
  transition: var(--transition);
}

.pill-title {
  font-weight: 700;
  font-size: 1.25rem;
  letter-spacing: -0.02em;
  color: var(--text-primary);
  transition: var(--transition);
}

.pill-sub {
  font-size: 0.875rem;
  color: var(--text-secondary);
  transition: var(--transition);
}

.aboutus-pill:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-hover);
}

.aboutus-pill.active::before {
  opacity: 1;
}

.aboutus-pill.active .pill-kicker,
.aboutus-pill.active .pill-title,
.aboutus-pill.active .pill-sub {
  color: var(--bg-white);
}

/* Company Info Box */
.aboutus-casebox {
  background: var(--bg-white);
  border-radius: var(--radius-lg);
  padding: 40px;
  box-shadow: var(--shadow-soft);
  border: 1px solid var(--border-light);
  transition: var(--transition);
}

.aboutus-casebox:hover {
  box-shadow: var(--shadow-hover);
}

.company-logo {
  height: 40px;
  width: auto;
}

.case-title {
  color: var(--text-primary);
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.3;
  margin: 0;
}

.case-desc {
  color: var(--text-secondary);
  font-size: 1rem;
  line-height: 1.6;
  margin: 24px 0;
}

.case-features {
  list-style: none;
  padding: 0;
  margin: 24px 0;
}

.case-features li {
  position: relative;
  padding-left: 24px;
  margin-bottom: 12px;
  color: var(--text-secondary);
  line-height: 1.5;
}

.case-features li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 8px;
  width: 6px;
  height: 6px;
  background: var(--primary-blue);
  border-radius: 50%;
}

.case-tagline {
  color: var(--text-muted);
  font-style: italic;
  margin: 24px 0;
  font-size: 0.95rem;
}

.aboutus-cta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--primary-dark);
  color: var(--bg-white);
  border: none;
  border-radius: 12px;
  padding: 16px 24px;
  font-weight: 600;
  font-size: 0.9rem;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  text-decoration: none;
  box-shadow: var(--shadow-soft);
  transition: var(--transition);
}

.aboutus-cta:hover {
  background: var(--primary-blue);
  transform: translateY(-2px);
  box-shadow: var(--shadow-active);
  color: var(--bg-white);
}

/* Visual Grid */
.aboutus-visual-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 20px;
  height: 100%;
  min-height: 500px;
}

.grid-item {
  background: var(--bg-gray);
  border-radius: var(--radius);
  position: relative;
  overflow: hidden;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.grid-item.large-rect.top {
  grid-column: 1 / -1;
  height: 140px;
}

.grid-item.large-rect.middle {
  grid-column: 1 / -1;
  height: 140px;
}

.grid-item.stats-card {
  grid-column: 2;
  background: var(--primary-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  box-shadow: var(--shadow-soft);
}

.grid-item.large-rect.bottom {
  grid-column: 1;
}

.stats-content {
  text-align: center;
  color: var(--bg-white);
}

.stats-number {
  font-size: 2.5rem;
  font-weight: 700;
  line-height: 1;
  margin-bottom: 8px;
}

.stats-label {
  font-size: 0.875rem;
  font-weight: 500;
  opacity: 0.9;
  line-height: 1.3;
}

/* Responsive Design */
@media (max-width: 1200px) {
  .aboutus-casebox {
    padding: 32px;
  }
  
  .aboutus-visual-grid {
    min-height: 450px;
  }
}

@media (max-width: 992px) {
  .section-about {
    padding: 50px 0 60px;
  }
  
  .aboutus-tabs {
    justify-content: center;
  }
  
  .aboutus-visual-grid {
    margin-top: 32px;
    min-height: 400px;
  }
  
  .grid-item.large-rect.top,
  .grid-item.large-rect.middle {
    height: 120px;
  }
}

@media (max-width: 768px) {
  .aboutus-pill {
    min-width: 160px;
    padding: 16px 20px;
  }
  
  .pill-title {
    font-size: 1.125rem;
  }
  
  .aboutus-casebox {
    padding: 24px;
    margin-bottom: 32px;
  }
  
  .case-title {
    font-size: 1.25rem;
  }
  
  .aboutus-visual-grid {
    grid-template-columns: 1fr;
    gap: 16px;
    min-height: 320px;
  }
  
  .grid-item.large-rect.top,
  .grid-item.large-rect.middle,
  .grid-item.large-rect.bottom {
    grid-column: 1;
    height: 100px;
  }
  
  .grid-item.stats-card {
    grid-column: 1;
    height: 120px;
  }
}

@media (max-width: 576px) {
  .aboutus-tabs {
    gap: 12px;
  }
  
  .aboutus-pill {
    min-width: 140px;
    padding: 14px 16px;
  }
  
  .stats-number {
    font-size: 2rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Company data for switching content
  const companyData = {
    seraj: {
      logo: '{{ asset("images/seraj.png") }}',
      title: 'Outdoor Advertising, Video Production, 3D Content',
      description: 'A media company that works with the urban environment. We turn the city into a platform for brand communication through:',
      features: [
        'High-impact outdoor advertising (billboards, digital screens, unconventional formats)',
        'Video content for digital displays',
        'Cutting-edge 3D animations that stop people in their tracks'
      ],
      tagline: 'Here, advertising becomes art — and technology is its canvas.'
    },
    ides: {
      logo: '{{ asset("images/ides.png") }}',
      title: 'Creative Design & Brand Identity',
      description: 'A creative studio specializing in visual identity and brand experiences. We craft memorable designs that:',
      features: [
        'Brand identity and logo design',
        'Digital and print design solutions',
        'User experience and interface design'
      ],
      tagline: 'Where creativity meets strategic thinking.'
    },
    anmat: {
      logo: '{{ asset("images/anmat.png") }}',
      title: 'Digital Solutions & Technology',
      description: 'A technology company focused on innovative digital solutions. We develop cutting-edge applications that:',
      features: [
        'Custom web and mobile applications',
        'E-commerce and digital platforms',
        'Advanced analytics and automation tools'
      ],
      tagline: 'Transforming ideas into digital reality.'
    }
  };

  // Handle pill switching
  document.querySelectorAll('.aboutus-pill').forEach(pill => {
    pill.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Update active state
      document.querySelectorAll('.aboutus-pill').forEach(p => p.classList.remove('active'));
      this.classList.add('active');
      
      // Get company data
      const company = this.dataset.company;
      const data = companyData[company];
      
      if (data) {
        // Update content with smooth transition
        const caseBox = document.querySelector('.aboutus-casebox');
        caseBox.style.opacity = '0.7';
        caseBox.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
          // Update logo
          document.querySelector('.company-logo').src = data.logo;
          
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
