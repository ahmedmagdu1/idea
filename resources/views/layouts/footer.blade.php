

<section class="cta-section position-relative">
  <div class="cta-bg"></div>
  <div class="container h-100">
    <div class="cta-content text-center d-flex flex-column justify-content-center align-items-center h-100">
      <h2 class="cta-title mb-4">
        {{ __('main.cta_title') }}
      </h2>
      <div class="cta-lead mb-2">
        {{ __('main.cta_lead1') }}
      </div>
      <div class="cta-lead mb-4">
        {{ __('main.cta_lead2') }}
      </div>
      <a href="{{ url('/contact') }}" class="btn cta-btn px-5 py-3 fw-bold">
        {{ __('main.cta_btn') }}
      </a>
    </div>
  </div>
</section>

<style>
.cta-section {
  position: relative;
  width: 100vw;
  min-height: 576px;
  height: 576px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}
.cta-section .cta-bg {
  position: absolute;
  inset: 0;
  width: 100vw;
  height: 100%;
  background:
    linear-gradient(0deg, rgba(31,44,86,0.77) 100%, rgba(25,38,72,0.71) 70%, rgba(28,36,58,0.64) 30%, rgba(36,56,90,0.19) 0%),
    url('{{ asset('images/cta-bg.png') }}') center center/cover no-repeat;
  z-index: 1;
  opacity: 1;
}
.cta-content {
  position: relative;
  z-index: 2;
  color: #fff;
  height: 100%;
  width: 100%;
}
.cta-title {
  font-size: 2.65rem;
  font-weight: 700;
  line-height: 1.14;
  font-family: 'Poppins', 'Tajawal', Arial, sans-serif;
  letter-spacing: -1.2px;
  color: #fff;
}
.cta-lead {
  font-size: 1.23rem;
  font-weight: 400;
  color: #e4eaf5;
  letter-spacing: 0.01em;
}
.cta-btn {
  background: #fff;
  color: #24385A;
  border-radius: 14px;
  box-shadow: 0 2px 24px #24385a22;
  font-size: 1.09rem;
  font-family: inherit;
  padding: 1.02rem 2.6rem;
  min-width: 155px;
  border: none;
  transition: background .16s, color .15s, box-shadow .18s;
}
.cta-btn:hover, .cta-btn:focus {
  background: #24385A;
  color: #fff;
  box-shadow: 0 8px 32px #24385a44;
  outline: none;
}
@media (max-width: 991px) {
  .cta-section { min-height: 340px; height: 380px; }
  .cta-title { font-size: 1.5rem;}
  .cta-lead { font-size: 1rem;}
}
</style>

<footer class="footer-section">
    <div class="container pt-5 mt-3">
        <div class="row footer-top pb-2 mb-3">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="row g-3 justify-content-between">
                    <!-- Company -->
                    <div class="col-6 col-md-3">
                        <div class="footer-head">Company</div>
                        <ul class="footer-links">
                            <li><a href="{{ url('/about') }}">{{ __('main.footer_about') }}</a></li>
                            <li><a href="{{ url('/contact') }}">{{ __('main.footer_contact') }}</a></li>
                            <li><a href="{{ url('/careers') }}">{{ __('main.footer_careers') }}</a></li>
                            <li><a href="{{ url('/press') }}">{{ __('main.footer_press') }}</a></li>
                        </ul>
                    </div>
                    <!-- Services -->
                    <div class="col-6 col-md-3">
                        <div class="footer-head">Services</div>
                        <ul class="footer-links">
                            <li><a href="{{ url('/services') }}">{{ __('main.service_ooh') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_interior') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_branding') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_digital') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_video') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_web') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_event') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_gifts') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_game') }}</a></li>
                            <li><a href="{{ url('/services') }}">{{ __('main.service_permits') }}</a></li>
                        </ul>
                    </div>
                    <!-- Legal -->
                    <div class="col-6 col-md-2">
                        <div class="footer-head">Legal</div>
                        <ul class="footer-links">
                            <li><a href="{{ url('/privacy-policy') }}">{{ __('main.footer_privacy') }}</a></li>
                            <li><a href="{{ url('/terms') }}">{{ __('main.footer_terms') }}</a></li>
                        </ul>
                    </div>
                    <!-- Contact us -->
                    <div class="col-6 col-md-4">
                        <div class="footer-head">{{ __('main.footer_contactus') }}</div>
                        <div class="footer-contact">
                            @php
                                $email = \App\Models\Setting::get('contact_email', 'support@ideagroup.om');
                                $phone = \App\Models\Setting::get('contact_phone', '+968 000000000');
                                $tel = preg_replace('/[^0-9+]/', '', (string) $phone);
                            @endphp
                            <a href="mailto:{{ $email }}" class="footer-mail">{{ $email }}</a><br>
                            <a href="tel:{{ $tel }}" class="footer-phone">{{ $phone }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Divider -->
        <div class="footer-divider my-2"></div>
        <div class="row footer-bottom pb-2">
            <div class="col-12 col-lg-10 mx-auto d-flex flex-wrap justify-content-between align-items-center">
                <div class="footer-copy small text-muted">
                    © 2025 Copyright, All Right Reserved
                </div>
                <div class="footer-social">
                    <a href="https://twitter.com/ideagroupom" target="_blank" rel="noopener noreferrer" class="footer-social-link"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.facebook.com/ideagroup.om" target="_blank" rel="noopener noreferrer" class="footer-social-link"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/ideagroup.om/" target="_blank" rel="noopener noreferrer" class="footer-social-link"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/idea-group-oman/" target="_blank" rel="noopener noreferrer" class="footer-social-link"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
.footer-section {
    background: #fff;
    font-family: 'Poppins', 'Tajawal', Arial, sans-serif;
    font-size: 1.03rem;
    letter-spacing: 0.02em;
}
.footer-head {
    font-size: 1rem;
    color: #9198a6;
    font-weight: 500;
    margin-bottom: 30px;
    letter-spacing: 0.01em;
}
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-links li {
    margin-bottom: 7px;
}
.footer-links a {
    color: #222;
    text-decoration: none;
    transition: color 0.15s;
    font-size: 1.02rem;
}
.footer-links a:hover { color: #223257; }
.footer-contact {
    color: #223257;
    font-size: 1.06rem;
    font-weight: 600;
    margin-top: 8px;
}
.footer-mail, .footer-phone {
    color: #4668ab;
    font-size: 1.07rem;
    font-weight: 700;
    letter-spacing: 0.01em;
    display: block;
    margin-bottom: 3px;
    text-decoration: none;
    transition: color 0.15s;
}
.footer-mail:hover, .footer-phone:hover { color: #223257; }
.footer-divider {
    border-bottom: 1.5px solid #f1f1f1;
    width: 100%;
}
.footer-copy {
    font-size: 0.97rem;
    color: #999;
    margin-top: 5px;
}
.footer-social {
    display: flex;
    gap: 18px;
    align-items: center;
}
.footer-social-link {
    color: #495875;
    font-size: 1.17rem;
    transition: color 0.13s;
}
.footer-social-link:hover {
    color: #223257;
}
@media (max-width: 991px) {
    .footer-section .footer-head { font-size: 1.07rem;}
    .footer-social { gap: 14px; }
}
@media (max-width: 767px) {
    .footer-section { font-size: 0.98rem; }
    .footer-top .row > div { margin-bottom: 23px; }
    .footer-bottom { flex-direction: column; gap: 10px; }
}
</style>
