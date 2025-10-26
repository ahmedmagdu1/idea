@extends('layouts.app')

@section('title', __('messages.welcome'))

@section('content')

<!-- Hero Section -->
<section class="aboutus-hero position-relative">
    <img src="{{ asset('images/about-hero.png') }}" class="aboutus-bg-img" alt="">
    <div class="aboutus-overlay"></div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center aboutus-hero-content">
        <h1 class="aboutus-main-title">{{ __('main.aboutus_title') ?: 'About Us' }}</h1>
        <p class="aboutus-subtitle">{{ __('main.aboutus_lead') ?: 'Learn more about our company, values and the team behind our success' }}</p>
    </div>
</section>

<!-- Client Logos Section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<div class="client-logos-section">
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
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section - Who Chooses Us -->
<section class="who-chooses-us-section">
    <div class="container">
        
        <!-- Section Header -->
        <div class="section-header text-center">
            <h2 class="section-title">Who Chooses Us</h2>
            <p class="section-description">
                We are a group of companies under IDEA GROUP, each specializing in different aspects of media, design, and technology to provide comprehensive solutions for our clients.
            </p>
        </div>

        <div class="main-content-wrapper">
            
            <!-- Left Side - Company Cards -->
            <div class="companies-sidebar">
                <div class="company-card active" data-company="seraj">
                    <div class="company-info">
                        <img src="{{ asset('images/seraj.png') }}" alt="Seraj Media" class="company-logo">
                        <div class="company-details">
                            <h3 class="company-name">Seraj Media</h3>
                            <p class="company-tagline">by Oneic Media</p>
                            <p class="company-brief">Outdoor Advertising & Video Production</p>
                        </div>
                    </div>
                </div>
                
                <div class="company-card" data-company="ides">
                    <div class="company-info">
                        <img src="{{ asset('images/ides.png') }}" alt="Ides Design" class="company-logo">
                        <div class="company-details">
                            <h3 class="company-name">Ides Design</h3>
                            <p class="company-tagline">by Oneic Media</p>
                            <p class="company-brief">Creative Design & Brand Identity</p>
                        </div>
                    </div>
                </div>
                
                <div class="company-card" data-company="anmat">
                    <div class="company-info">
                        <img src="{{ asset('images/anmat.png') }}" alt="Anmat" class="company-logo">
                        <div class="company-details">
                            <h3 class="company-name">Anmat</h3>
                            <p class="company-tagline">by Oneic Media</p>
                            <p class="company-brief">Digital Solutions & Technology</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Visual Grid -->
            <div class="visual-grid-container">
                <div class="visual-grid">
                    <div class="grid-item main-image">
                        <img src="{{ asset('images/ooh.jpg') }}" alt="Main showcase" class="grid-image">
                        <div class="image-overlay"></div>
                    </div>
                    
                    <div class="grid-item secondary-image">
                        <img src="{{ asset('images/branding.jpg') }}" alt="Secondary showcase" class="grid-image">
                        <div class="image-overlay"></div>
                    </div>
                    
                    <div class="grid-item stats-card">
                        <div class="stats-content">
                            <div class="stats-number">1397.76 x 260.09</div>
                            <div class="stats-label">Resolution<br>Standards</div>
                        </div>
                    </div>
                    
                    <div class="grid-item tertiary-image">
                        <img src="{{ asset('images/branding.jpg') }}" alt="Tertiary showcase" class="grid-image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="our-services-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="services-title">Our Services</h2>
                <div class="services-list">
                    <div class="service-item">
                        <h4>Creative Design</h4>
                        <p>Brand identity, logo design, and visual communication solutions.</p>
                    </div>
                    <div class="service-item">
                        <h4>Branding</h4>
                        <p>Complete branding strategies and brand development services.</p>
                    </div>
                    <div class="service-item">
                        <h4>Digital Marketing</h4>
                        <p>Online marketing campaigns and digital presence optimization.</p>
                    </div>
                    <div class="service-item">
                        <h4>Video Production</h4>
                        <p>Professional video content creation and post-production services.</p>
                    </div>
                    <div class="service-item">
                        <h4>Web & Mobile Development</h4>
                        <p>Custom websites and mobile applications development.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="services-content">
                    <p>Our comprehensive suite of services covers every aspect of modern business needs. From creative design to digital solutions, we provide end-to-end services that help businesses grow and succeed in today's competitive market.</p>
                    
                    <p>Each service is backed by our experienced team and proven methodologies, ensuring quality results that exceed expectations and drive measurable business outcomes.</p>
                    
                    <div class="services-highlight">
                        <div class="highlight-item">
                            <span class="highlight-number">50+</span>
                            <span class="highlight-text">Projects Completed</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-number">25+</span>
                            <span class="highlight-text">Happy Clients</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Client Journey Section -->
<section class="client-journey-section">
    <div class="container">
        <h2 class="journey-title text-center">Client Journey</h2>
        <div class="journey-timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>Discovery</h4>
                    <p>Understanding your needs and goals</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>Strategy</h4>
                    <p>Developing the perfect solution</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>Execution</h4>
                    <p>Bringing your vision to life</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>Delivery</h4>
                    <p>Exceeding your expectations</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
/* CSS Variables matching the design system */
:root {
    --primary-color: #1a1a1a;
    --secondary-color: #666666;
    --accent-color: #0066cc;
    --light-gray: #f5f5f5;
    --medium-gray: #e0e0e0;
    --white: #ffffff;
    --text-primary: #1a1a1a;
    --text-secondary: #666666;
    --text-muted: #999999;
    --border-color: #e0e0e0;
    --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
    --shadow-medium: 0 4px 20px rgba(0,0,0,0.15);
    --border-radius: 8px;
    --border-radius-large: 16px;
}

/* Hero Section */
.aboutus-hero {
    min-height: 400px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.aboutus-bg-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.aboutus-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 26, 26, 0.7);
    z-index: 2;
}

.aboutus-hero-content {
    position: relative;
    z-index: 3;
    color: var(--white);
}

.aboutus-main-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.aboutus-subtitle {
    font-size: 1.25rem;
    font-weight: 300;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0.9;
}

/* Client Logos Section */
.client-logos-section {
    background: var(--white);
    padding: 40px 0;
    border-bottom: 1px solid var(--border-color);
}

.client-logo {
    height: 40px;
    width: auto;
    max-width: 120px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s ease;
}

.client-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
}

.swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
}

/* Who Chooses Us Section */
.who-chooses-us-section {
    background: var(--light-gray);
    padding: 80px 0;
}

.section-header {
    margin-bottom: 60px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

.section-description {
    font-size: 1.125rem;
    color: var(--text-secondary);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

.main-content-wrapper {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 60px;
    align-items: start;
}

/* Companies Sidebar */
.companies-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.company-card {
    background: var(--white);
    border-radius: var(--border-radius-large);
    padding: 30px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.company-card:hover,
.company-card.active {
    border-color: var(--accent-color);
    box-shadow: var(--shadow-medium);
    transform: translateY(-5px);
}

.company-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.company-logo {
    width: 60px;
    height: 60px;
    object-fit: contain;
    flex-shrink: 0;
}

.company-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 5px 0;
}

.company-tagline {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin: 0 0 10px 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.company-brief {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.4;
}

/* Visual Grid */
.visual-grid-container {
    position: relative;
}

.visual-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
    height: 500px;
}

.grid-item {
    border-radius: var(--border-radius-large);
    overflow: hidden;
    position: relative;
    background: var(--white);
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
}

.grid-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
}

.main-image {
    grid-column: 1 / -1;
    grid-row: 1;
}

.secondary-image {
    grid-column: 1;
    grid-row: 2;
}

.stats-card {
    grid-column: 2;
    grid-row: 2;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
}

.tertiary-image {
    display: none; /* Hidden in this grid layout */
}

.grid-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.grid-item:hover .grid-image {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(26, 26, 26, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.grid-item:hover .image-overlay {
    opacity: 1;
}

.stats-content {
    text-align: center;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: -0.02em;
}

.stats-label {
    font-size: 0.875rem;
    font-weight: 500;
    opacity: 0.9;
    line-height: 1.3;
}

/* Our Services Section */
.our-services-section {
    background: var(--white);
    padding: 80px 0;
}

.services-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 2rem;
}

.services-list {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.service-item h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.service-item p {
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.6;
}

.services-content {
    padding-left: 40px;
}

.services-content p {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.services-highlight {
    display: flex;
    gap: 40px;
    margin-top: 40px;
}

.highlight-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.highlight-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent-color);
    display: block;
}

.highlight-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 5px;
}

/* Client Journey Section */
.client-journey-section {
    background: var(--light-gray);
    padding: 80px 0;
}

.journey-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 3rem;
}

.journey-timeline {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
}

.journey-timeline::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--border-color);
    z-index: 1;
}

.timeline-item {
    flex: 1;
    text-align: center;
    position: relative;
    z-index: 2;
}

.timeline-dot {
    width: 30px;
    height: 30px;
    background: var(--accent-color);
    border: 4px solid var(--white);
    border-radius: 50%;
    margin: 0 auto 20px auto;
    box-shadow: var(--shadow-light);
}

.timeline-content h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.timeline-content p {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .main-content-wrapper {
        grid-template-columns: 300px 1fr;
        gap: 40px;
    }
    
    .visual-grid {
        height: 450px;
    }
}

@media (max-width: 992px) {
    .aboutus-main-title {
        font-size: 2.5rem;
    }
    
    .aboutus-subtitle {
        font-size: 1.125rem;
    }
    
    .main-content-wrapper {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    
    .companies-sidebar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .visual-grid {
        height: 400px;
    }
    
    .services-content {
        padding-left: 0;
        margin-top: 40px;
    }
}

@media (max-width: 768px) {
    .aboutus-hero {
        min-height: 300px;
    }
    
    .aboutus-main-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .companies-sidebar {
        grid-template-columns: 1fr;
    }
    
    .company-card {
        padding: 20px;
    }
    
    .visual-grid {
        grid-template-columns: 1fr;
        height: auto;
        gap: 15px;
    }
    
    .grid-item {
        height: 200px;
    }
    
    .main-image {
        grid-column: 1;
        grid-row: 1;
    }
    
    .secondary-image {
        grid-column: 1;
        grid-row: 2;
    }
    
    .stats-card {
        grid-column: 1;
        grid-row: 3;
        height: 150px;
    }
    
    .journey-timeline {
        flex-direction: column;
        gap: 30px;
    }
    
    .journey-timeline::before {
        display: none;
    }
    
    .services-highlight {
        justify-content: center;
        gap: 60px;
    }
}

@media (max-width: 576px) {
    .client-logos-section {
        padding: 30px 0;
    }
    
    .who-chooses-us-section,
    .our-services-section,
    .client-journey-section {
        padding: 60px 0;
    }
    
    .company-info {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .company-logo {
        width: 50px;
        height: 50px;
    }
    
    .stats-number {
        font-size: 1.25rem;
    }
}

/* Swiper Initialization */
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const isRTL = document.documentElement.dir === 'rtl';

    // Initialize Swiper
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
    });

    // Company Cards Interaction
    document.querySelectorAll('.company-card').forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            document.querySelectorAll('.company-card').forEach(c => c.classList.remove('active'));
            // Add active class to clicked card
            this.classList.add('active');
        });
    });

    // Smooth scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.company-card, .grid-item, .service-item, .timeline-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
</script>

@endsection
