@extends('layouts.app')

@section('title', 'Website')

@section('content')
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  color: #000;
  overflow-x: hidden;
}

/* Hero Section */
.hero-section {
  position: relative;
  height: 620px;
  background: #161c2d;
  background-image: url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=2000&auto=format&fit=crop');
  background-size: cover;
  background-position: center;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(60, 73, 112, 0.3) 0%, rgba(22, 28, 45, 0.8) 100%);
  z-index: 1;
}

.navbar {
  position: relative;
  z-index: 10;
  padding: 76px 89px;
}

.navbar-brand {
  font-weight: 700;
  font-size: 34.2px;
  color: #000;
  letter-spacing: -0.19px;
}

.nav-link {
  font-size: 24px;
  color: #000 !important;
  letter-spacing: -0.14px;
  transition: color 0.3s;
}

.nav-link:hover {
  color: #3c4970 !important;
}

.language-selector {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 24px;
  color: #000;
}

.hero-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 10;
  text-align: center;
  width: 100%;
  padding: 0 20px;
}

.hero-title {
  font-size: 32px;
  color: #ffffff;
  font-weight: 400;
  line-height: 1.5;
}

/* About Section */
.about-section {
  padding: 96px 148px;
}

.section-title {
  font-weight: 700;
  font-size: 95.4px;
  color: #3c4970;
  letter-spacing: -1.91px;
  line-height: 1.1;
}

.about-content {
  font-size: 21.6px;
  line-height: 1.6;
}

.about-content p {
  margin-bottom: 1.5rem;
}

/* Who Chooses Us Section */
.who-chooses-section {
  padding: 96px 148px;
  background: rgba(230, 230, 230, 0.2);
}

.section-description {
  font-size: 21.6px;
  line-height: 1.5;
}

.who-card {
  position: relative;
  overflow: hidden;
  border-radius: 20px;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  background-color: #3c4970;
  box-shadow: 0 8px 24px rgba(0,0,0,.08);
}

.who-card::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,.18) 0%, rgba(0,0,0,.35) 100%);
}

.who-card:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,.14); }

.who-card h3 {
  position: relative;
  z-index: 1;
  font-size: 24px;
  color: #ffffff;
  text-align: center;
  font-weight: 500;
  line-height: 1.3;
  text-shadow: 0 2px 8px rgba(0,0,0,.35);
}

.who-card-large { height: 560px; }

.who-card-small { height: 260px; }

/* Services Section */
.services-section {
  padding: 96px 153px;
}

.services-list {
  display: flex;
  flex-direction: column;
  gap: 48px;
}

.service-item {
  display: grid;
  grid-template-columns: 1fr 332px 1fr;
  gap: 32px;
  align-items: start;
}

.service-title {
  font-size: 32.4px;
  letter-spacing: -0.65px;
  font-weight: 400;
}

.service-line {
  height: 35px;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="332" height="8"><line x1="0" y1="4" x2="332" y2="4" stroke="%23000" stroke-width="2"/></svg>') no-repeat center;
  background-size: contain;
}

.service-description {
  font-size: 21.6px;
  letter-spacing: -0.43px;
  max-width: 487px;
}

/* Journey Section */
.journey-section {
  padding: 96px 153px;
  background: rgba(230, 230, 230, 0.2);
}

.journey-timeline {
  display: flex;
  justify-content: space-between;
  max-width: 1414px;
  margin: 0 auto;
  position: relative;
}

.journey-timeline::before {
  content: '';
  position: absolute;
  top: 210px;
  left: 0;
  right: 0;
  height: 0;
  border-top: 2px dashed #000;
  z-index: 0;
}


.journey-stage {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  z-index: 1;
}

.stage-number {
  font-size: 20.2px;
  margin-bottom: 48px;
}

.stage-connector {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.connector-line {
  width: 1px;
  background: #000;
}

.connector-top {
  height: 98px;
  margin-bottom: 16px;
}

.connector-dot {
  width: 37px;
  height: 37px;
  background: #3c4970;
  border-radius: 50%;
}

.connector-bottom {
  height: 114px;
  margin-top: 16px;
}

.stage-title {
  font-size: 20.2px;
  text-align: center;
  margin-top: 48px;
}

/* يمنع التغيير في ترتيب العناصر أو التصميم في الشاشات الصغيرة */
@media (max-width: 991px) {
  .journey-timeline {
    display: flex !important;
    flex-wrap: nowrap !important;
    overflow-x: auto !important;
    justify-content: space-between !important;
  }

  .journey-stage {
    min-width: 250px; /* تحكم في عرض كل عنصر */
    flex-shrink: 0;
    text-align: center;
  }

  .journey-timeline::before {
    content: '';
    position: absolute;
    top: 210px;
    left: 0;
    right: 0;
    height: 0;
    border-top: 1px dashed #000;
    z-index: 0;
  }

  /* يخلي الخط المتقطع واضح فوق العناصر */
  .journey-stage,
  .stage-connector {
    position: relative;
    z-index: 1;
  }
}

/* Portfolio Section */
.portfolio-section {
  padding: 96px 148px;
}

.portfolio-tabs {
  display: flex;
  gap: 13px;
  flex-wrap: wrap;
}

.portfolio-tab {
  padding: 9.45px 76.95px;
  border-radius: 13.5px;
  font-size: 21.6px;
  border: none;
  background: #f3f3f3;
  color: #2c385a;
  transition: all 0.3s;
  cursor: pointer;
}

.portfolio-tab.active {
  background: #2c385a;
  color: #ffffff;
}

.portfolio-tab:hover {
  opacity: 0.8;
}

.portfolio-main-image img {
  width: 100%;
  height: 554px;
  object-fit: cover;
}

.portfolio-info {
  background: #f3f3f3;
  border-radius: 0 13.5px 0 0;
  padding: 32px;
}

.portfolio-nav {
  display: flex;
  gap: 8px;
}

.nav-btn {
  width: 36px;
  height: 36px;
  background: #f3f3f3;
  border: none;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.3s;
}

.nav-btn:hover {
  background: #e0e0e0;
}

.portfolio-counter {
  font-size: 21.6px;
  font-weight: 700;
}

.portfolio-counter .current {
  color: #000;
}

.portfolio-counter .total {
  color: #c5c5c5;
}

.portfolio-category-title {
  font-size: 32.4px;
  margin: 16px 0;
  font-weight: 400;
}

.portfolio-description {
  font-size: 16.2px;
}

/* CTA Section */
.cta-section {
  position: relative;
  height: 576px;
  background: #2c385a;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(60, 73, 112, 0.3) 0%, rgba(44, 56, 90, 0.8) 100%);
  z-index: 1;
}

.cta-section .container {
  position: relative;
  z-index: 10;
}

.cta-title {
  font-size: 50px;
  color: #ffffff;
  font-weight: 500;
  letter-spacing: -1.59px;
  line-height: 1.27;
  margin-bottom: 32px;
}

.cta-description {
  font-size: 22px;
  color: #ffffff;
  font-weight: 500;
  line-height: 1.52;
  margin-bottom: 48px;
  max-width: 1324px;
  margin-left: auto;
  margin-right: auto;
}

.btn-cta {
  background: #ffffff;
  color: #161c2d;
  border-radius: 8px;
  padding: 24px 48px;
  font-size: 17px;
  font-weight: 700;
  letter-spacing: -0.50px;
  border: none;
  transition: background 0.3s;
}

.btn-cta:hover {
  background: #f0f0f0;
}

/* Footer */
.footer-section {
  background: #ffffff;
  padding: 64px 264px;
}

.footer-divider {
  border-top: 1px solid #000;
  margin: 0 0 64px 0;
}

.footer-heading {
  font-size: 16.2px;
  color: #161c2d;
  opacity: 0.7;
  letter-spacing: -0.11px;
  line-height: 1.73;
  margin-bottom: 16px;
  font-weight: 400;
}

.footer-links {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 8px;
}

.footer-links a {
  font-size: 18.3px;
  color: #161c2d;
  text-decoration: none;
  letter-spacing: -0.22px;
  line-height: 2.36;
  transition: color 0.3s;
}

.footer-links a:hover {
  color: #576ba4;
}

.contact-links a {
  color: #576ba4;
  font-weight: 600;
}

.contact-links a:hover {
  color: #3c4970;
}

.footer-copyright {
  font-size: 16.2px;
  color: #161c2d;
  letter-spacing: -0.11px;
  line-height: 1.73;
  margin: 0;
}

/* Responsive */
@media (max-width: 1400px) {
  .about-section,
  .who-chooses-section,
  .services-section,
  .journey-section,
  .portfolio-section {
    padding-left: 60px;
    padding-right: 60px;
  }

  .footer-section {
    padding-left: 60px;
    padding-right: 60px;
  }
}

@media (max-width: 992px) {
  .section-title {
    font-size: 60px;
  }

  .service-item {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .service-line {
    display: none;
  }

  .journey-timeline {
    flex-wrap: wrap;
    gap: 48px;
  }

  .journey-timeline::before {
    display: none;
  }

  .who-card-large,
  .who-card-small {
    height: 300px;
  }
}

@media (max-width: 768px) {
  .navbar {
    padding: 40px 20px;
  }

  .hero-title {
    font-size: 24px;
  }

  .section-title {
    font-size: 40px;
  }

  .about-section,
  .who-chooses-section,
  .services-section,
  .journey-section,
  .portfolio-section,
  .footer-section {
    padding: 48px 20px;
  }

  .cta-title {
    font-size: 32px;
  }

  .cta-description {
    font-size: 18px;
  }
}
  /* Slider sizing to keep all images uniform */
  .project-main { height: 554px; }
  .project-main .swiper-slide img { height: 554px; width: 100%; object-fit: cover; display:block; border-radius: 8px; }
  .project-thumbs { height: 202px; }
  .project-thumbs .swiper-wrapper { align-items: stretch; }
  .project-thumbs .swiper-slide { width: calc((100% - 16px)/3) !important; }
  .project-thumbs .swiper-slide img { height: 202px; width: 100%; object-fit: cover; display:block; border-radius: 8px; }
</style>
  <!-- Header Section -->
  <div class="hero-section">


    <div class="hero-content">
      <h1 class="hero-title">
        We Create Style And Atmosphere.<br>
        spaces You'll Never Forget.
      </h1>
    </div>
</div>

  <!-- About Section -->
  <section id="about" class="about-section py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="section-title pt-3 mt-5 mb-5" style="position: absolute;">About Us</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 offset-lg-6">
          <div class="about-content">
            <p>We Are A Creative Marketing Agency That Transforms Ideas Into Style, And Businesses Into Spaces People Want To Return To.</p>
            <p>we Create Powerful Visual Identities And Memorable Atmospheres â€” From Interior And Exterior Design To Branding, Video, And Advertising.</p>
            <p>caffes, Restaurants, Shops, And Other Companies Choose Us When They Want To Stand Out, Attract Attention, And Keep Their Clients From The Very First Glance.</p>
            <p>we Handle Projects Of Any Complexity â€” From Concept To Execution.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Who Chooses Us Section -->
  <section class="who-chooses-section py-5">
    <div class="container">
      <div class="row mb-4 align-items-end">
        <div class="col-lg-6"><h2 class="section-title m-0">Who Choses Us</h2></div>
        <div class="col-lg-6"><p class="section-description m-0">Our Solutions Are Designed For Those Who Want Their Space And Visual Identity To Speak For Their Business:</p></div>
      </div>
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="who-card who-card-large" style="background-image:url('https://images.unsplash.com/photo-1520880867055-1e30d1cb001c?q=80&w=1600&auto=format&fit=crop');">
            <h3>Offices And Workspaces</h3>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row g-4">
            <div class="col-6">
              <div class="who-card who-card-small" style="background-image:url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop');">
                <h3>Cafes, Bars,<br>& Restaurants</h3>
              </div>
            </div>
            <div class="col-6">
              <div class="who-card who-card-small" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=1200&auto=format&fit=crop');">
                <h3>Construction Companies</h3>
              </div>
            </div>
            <div class="col-6">
              <div class="who-card who-card-small" style="background-image:url('https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=1200&auto=format&fit=crop');">
                <h3>Boutiques,<br>Showrooms,<br>& Retail Stores</h3>
              </div>
            </div>
            <div class="col-6">
              <div class="who-card who-card-small" style="background-image:url('https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?q=80&w=1200&auto=format&fit=crop');">
                <h3>Real Estate Agencies</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="services-section py-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-lg-6">
          <h2 class="section-title">Our Services</h2>
        </div>
        <div class="col-lg-6">
          <p class="section-description">Our Solutions Are Designed For Those Who Want Their Space And Visual Identity To Speak For Their Business:</p>
        </div>
      </div>

      <div class="services-list">
        <div class="service-item">
          <div class="service-title">Interior & Exterior Design</div>
          <div class="service-line"></div>
          <div class="service-description">We create interiors and exteriors that reflect the essence of your brand. From planning to final touches.</div>
        </div>

        <div class="service-item">
          <div class="service-title">Branding</div>
          <div class="service-line"></div>
          <div class="service-description">We develop brand identities that stand out and make an impact: logos, visual systems, packaging, brand guidelines, and signature design solutions.</div>
        </div>

        <div class="service-item">
          <div class="service-title">OOH Marketing<br>(Out-of-Home)</div>
          <div class="service-line"></div>
          <div class="service-description">We develop brand identities that stand out and make an impact: logos, visual systems, packaging, brand guidelines, and signature design solutions.</div>
        </div>

        <div class="service-item">
          <div class="service-title">Digital Marketing</div>
          <div class="service-line"></div>
          <div class="service-description">Comprehensive online promotion â€” website creation, content development, social media management, contextual advertising, social media targeting, and creatives that attract clients and strengthen your digital presence.</div>
        </div>

        <div class="service-item">
          <div class="service-title">Video Production</div>
          <div class="service-line"></div>
          <div class="service-description">We produce videos that engage: promotional videos, ads, mood clips, 3D visualizations, and storytelling content. We film real video and create 3D animations â€” all to capture your brand's mood with precision and emotion.</div>
        </div>

        <div class="service-item">
          <div class="service-title">Permits and Certifications</div>
          <div class="service-line"></div>
          <div class="service-description">We assist with obtaining all the necessary permits and certifications for opening cafÃ©s and restaurants: health & safety approvals, licenses, ISO certifications, and other essential documents required for legal and confident business operations.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Client Journey Section -->
  <section class="journey-section py-5">
    <div class="container">
      <h2 class="section-title mb-5">Client Journey</h2>

      <div class="journey-timeline">
        <div class="journey-stage">
          <div class="stage-number">Stage 01</div>
          <div class="stage-connector">
            <div class="connector-line connector-top"></div>
            <div class="connector-dot"></div>
            <div class="connector-line connector-bottom"></div>
          </div>
          <div class="stage-title">Concept</div>
        </div>

        <div class="journey-stage">
          <div class="stage-number">Stage 02</div>
          <div class="stage-connector">
            <div class="connector-line connector-top"></div>
            <div class="connector-dot"></div>
            <div class="connector-line connector-bottom"></div>
          </div>
          <div class="stage-title">Documentation<br>consultation</div>
        </div>

        <div class="journey-stage">
          <div class="stage-number">Stage 03</div>
          <div class="stage-connector">
            <div class="connector-line connector-top"></div>
            <div class="connector-dot"></div>
            <div class="connector-line connector-bottom"></div>
          </div>
          <div class="stage-title">Budget &<br>estimation</div>
        </div>

        <div class="journey-stage">
          <div class="stage-number">Stage 04</div>
          <div class="stage-connector">
            <div class="connector-line connector-top"></div>
            <div class="connector-dot"></div>
            <div class="connector-line connector-bottom"></div>
          </div>
          <div class="stage-title">Approval &<br>handover Support</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio-section py-5">
  <div class="container">
    <h2 class="section-title mb-4">Our projects</h2>
    <p class="section-description mb-4">Our Solutions Are Designed For Those Who Want Their Space And Visual Identity To Speak For Their Business:</p>

    <div class="portfolio-tabs mb-4">
      <button class="portfolio-tab active" data-category="restaurants">Restaurants</button>
      <button class="portfolio-tab" data-category="boutiques">Boutiques</button>
      <button class="portfolio-tab" data-category="offices">Offices</button>
      <button class="portfolio-tab" data-category="villa">Villa</button>
      <button class="portfolio-tab" data-category="real-estate">Real Estate</button>
      <button class="portfolio-tab" data-category="exhibitions">Exhibitions</button>
    </div>

    <div class="portfolio-content">
      <div class="row g-3">
        <div class="col-lg-8">
          <!-- Swiper Main -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
          <div class="swiper project-main rounded">
            <div class="swiper-wrapper">
              <div class="swiper-slide" data-cat="Restaurants" data-desc="Contemporary restaurant interiors with warm lighting and bold textures.">
                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Restaurant interior">
              </div>
              <div class="swiper-slide" data-cat="Boutiques" data-desc="Boutique retail displays designed to highlight product storytelling.">
                <img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Boutique store">
              </div>
              <div class="swiper-slide" data-cat="Offices" data-desc="Minimal workspaces that balance focus, collaboration, and comfort.">
                <img src="https://images.unsplash.com/photo-1520880867055-1e30d1cb001c?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Office workspace">
              </div>
              <div class="swiper-slide" data-cat="Villa" data-desc="Timeless residential design with natural materials and light.">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Villa interior">
              </div>
              <div class="swiper-slide" data-cat="Real Estate" data-desc="Show apartments styled to maximize light and space.">
                <img src="https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Real estate staging">
              </div>
              <div class="swiper-slide" data-cat="Exhibitions" data-desc="Immersive brand spaces and modular exhibition booths.">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Exhibition booth">
              </div>
              <div class="swiper-slide" data-cat="Restaurants" data-desc="Signature dining ambience with custom millwork.">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=1600&auto=format&fit=crop" class="img-fluid w-100" alt="Restaurant concept">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="portfolio-info">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="portfolio-nav">
                <button class="nav-btn" id="prevProject" aria-label="Previous project">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2"/></svg>
                </button>
                <button class="nav-btn" id="nextProject" aria-label="Next project">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2"/></svg>
                </button>
              </div>
              <div class="portfolio-counter">
                <span class="current">01</span>
                <span class="total"> / 07</span>
              </div>
            </div>
            <h3 class="portfolio-category-title">Restaurants</h3>
            <p class="portfolio-description">Contemporary restaurant interiors with warm lighting and bold textures.</p>
          </div>
          <!-- Swiper Thumbs -->
          <div class="swiper project-thumbs mt-3">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 1"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 2"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1520880867055-1e30d1cb001c?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 3"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 4"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 5"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 6"></div>
              <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded" alt="Thumb 7"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script><script>
  document.addEventListener('DOMContentLoaded', function(){
    // Gather initial slides data from DOM (so tabs can rebuild)
    function collectSlides(){
      const nodes = Array.from(document.querySelectorAll('.project-main .swiper-slide'));
      return nodes.map(n=>({
        src: n.querySelector('img')?.getAttribute('src') || '',
        alt: n.querySelector('img')?.getAttribute('alt') || '',
        cat: n.getAttribute('data-cat') || 'Projects',
        desc: n.getAttribute('data-desc') || ''
      }));
    }

    let allSlides = collectSlides();
    const mainSel = '.project-main .swiper-wrapper';
    const thumbSel = '.project-thumbs .swiper-wrapper';

    let thumbs, main;

    // Initialize thumbs first
    thumbs = new Swiper('.project-thumbs', { slidesPerView: 3, spaceBetween: 8, watchSlidesProgress: true, watchSlidesVisibility: true });
    // Then main and bind events using the swiper instance argument
    main = new Swiper('.project-main', {
      loop: true,
      speed: 650,
      grabCursor: true,
      autoplay: { delay: 3500, disableOnInteraction: false },
      thumbs: { swiper: thumbs },
      on: { slideChange: function(swiper){ updateInfo(swiper); } }
    });

    function updateInfo(swiper){
      const sw = swiper || main;
      if(!sw) return;
      const realIndex = sw.realIndex;
      const slide = sw.slides[sw.activeIndex];
      const cat = slide?.getAttribute('data-cat') || 'Projects';
      const desc = slide?.getAttribute('data-desc') || '';
      document.querySelector('.portfolio-category-title').textContent = cat;
      document.querySelector('.portfolio-description').textContent = desc;
      const total = document.querySelectorAll('.project-main .swiper-slide:not(.swiper-slide-duplicate)').length;
      document.querySelector('.portfolio-counter .current').textContent = String(realIndex+1).padStart(2,'0');
      document.querySelector('.portfolio-counter .total').textContent = ' / ' + String(total).padStart(2,'0');
    }

    function build(category){
      const target = category ? allSlides.filter(s=> s.cat.toLowerCase() === category.toLowerCase()) : allSlides.slice();
      // Fallback if no slides match
      const data = target.length ? target : allSlides.slice();
      const mainWrap = document.querySelector(mainSel);
      const thumbWrap = document.querySelector(thumbSel);
      mainWrap.innerHTML = data.map(s=>`<div class="swiper-slide" data-cat="${s.cat}" data-desc="${s.desc}"><img src="${s.src}" alt="${s.alt}" class="img-fluid w-100"/></div>`).join('');
      thumbWrap.innerHTML = data.map(s=>`<div class="swiper-slide"><img src="${s.src}" alt="thumb ${s.alt}" class="img-fluid rounded"/></div>`).join('');
      // Re-init swipers cleanly
      main.destroy(true,true); thumbs.destroy(true,true);
      thumbs = new Swiper('.project-thumbs', { slidesPerView: 3, spaceBetween: 8, watchSlidesProgress: true, watchSlidesVisibility: true });
      main = new Swiper('.project-main', { loop:true, speed:650, grabCursor:true, autoplay:{delay:3500,disableOnInteraction:false}, thumbs:{swiper:thumbs}, on:{ slideChange:function(sw){ updateInfo(sw); } }});
      updateInfo();
    }

    document.getElementById('prevProject').addEventListener('click', () => main.slidePrev());
    document.getElementById('nextProject').addEventListener('click', () => main.slideNext());

    document.querySelectorAll('.portfolio-tab').forEach(btn => {
      btn.addEventListener('click', function(){
        document.querySelectorAll('.portfolio-tab').forEach(b=>b.classList.remove('active'));
        this.classList.add('active');
        build(this.dataset.category);
      });
    });

    // Initialize counter values based on initial DOM
    updateInfo();
  });
</script>



</section>
@endsection





