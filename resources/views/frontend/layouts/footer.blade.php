<section id="footer" style="padding-top: 4px; padding-bottom: 10px;">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <footer class="row">
        <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
          <img src="{{ asset('assets/frontend/images/logo.jpg') }}" alt="logo-footer" class="img-fluid" style="background-color: white; padding: 10px; border-radius: 8px;">
          <p class="mt-3">Güvenka Organizasyon, İstanbul'da unutulmaz özel günleriniz ve kurumsal organizasyonlarınız için her zaman yanınızda.</p>
          <ul class="social-links d-flex flex-wrap list-unstyled mt-4 mb-0">
            <li>
              <a href="https://www.facebook.com/profile.php?id=100064028560042&sk=about" target="_blank">
                <svg class="social me-4" width="20" height="20">
                  <use xlink:href="#facebook"></use>
                </svg>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="social me-4" width="20" height="20">
                  <use xlink:href="#twitter"></use>
                </svg>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="social me-4" width="20" height="20">
                  <use xlink:href="#linkedin"></use>
                </svg>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/guvenkagroup" target="_blank">
                <svg class="social me-4" width="20" height="20">
                  <use xlink:href="#instagram"></use>
                </svg>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="social me-4" width="20" height="20">
                  <use xlink:href="#youtube"></use>
                </svg>
              </a>
            </li>
          </ul>
        </div>
        
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <h4 class="display-6 fw-normal">İletişim</h4>
          <ul class="nav flex-column">
            <li class="location text-capitalize d-flex align-items-center">
              <svg class="color me-1" width="20" height="20">
                <use xlink:href="#location"></use>
              </svg>Güvenka Organizasyon
            </li>
            <li class="text-capitalize ms-4">
              İstanbul, Türkiye
            </li>
            <li class="phone text-capitalize d-flex align-items-center mt-2">
              <svg class="color me-1" width="20" height="20">
                <use xlink:href="#phone"></use>
              </svg>0535 300 80 52
            </li>
            <li class="email d-flex align-items-center mt-2" style="text-transform: none;">
              <svg class="color me-1" width="20" height="20">
                <use xlink:href="#email"></use>
              </svg>info@guvenkagroup.com
            </li>
          </ul>
        </div>
        <div class="col-md-6 col-lg-2 mb-5 mb-lg-0">
          <h4 class="display-6 fw-normal">Hızlı Linkler</h4>
          <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('home') }}" class="p-0"> Ana Sayfa </a></li>
            <li class="nav-item"><a href="{{ route('about-us.index') }}" class="p-0"> Hakkımızda </a></li>
            <li class="nav-item"><a href="{{ route('blog.index') }}" class="p-0"> Blog </a></li>
            <li class="nav-item"><a href="{{ route('contact.index') }}" class="p-0"> İletişim </a></li>
          </ul>
        </div>
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <h4 class="display-6 fw-normal">Hizmetlerimiz</h4>
          <ul class="nav flex-column">
            @php
                $footerServices = \App\Models\Service::where('is_active', true)->orderBy('sort_order', 'ASC')->take(6)->get();
            @endphp
            @foreach($footerServices as $footerService)
            <li class="nav-item"><a href="{{ route('services-detail.show', $footerService->slug) }}" class="p-0"> {{ $footerService->title }} </a></li>
            @endforeach
          </ul>
        </div>
        
        <div class="col-12 text-center mt-4 pt-4 border-top">
          <p class="m-0">© Tüm Hakları Saklıdır {{ date('Y') }} Güvenka Organizasyon.</p>
        </div>
      </footer>
  </section>

<!-- Sticky Side Buttons -->
<div class="sticky-side-buttons">
    <a href="tel:+905353008052" class="sticky-btn sticky-btn-call" aria-label="Bizi Arayın">
        <iconify-icon icon="mdi:phone" width="24" height="24"></iconify-icon>
        <span class="sticky-btn-label">0535 300 80 52</span>
    </a>
    <a href="https://wa.me/905353008052" target="_blank" rel="noopener noreferrer" class="sticky-btn sticky-btn-whatsapp" aria-label="WhatsApp">
        <iconify-icon icon="mdi:whatsapp" width="24" height="24"></iconify-icon>
        <span class="sticky-btn-label">WhatsApp</span>
    </a>
    <a href="https://www.facebook.com/profile.php?id=100064028560042&sk=about" target="_blank" rel="noopener noreferrer" class="sticky-btn sticky-btn-facebook" aria-label="Facebook">
        <iconify-icon icon="mdi:facebook" width="24" height="24"></iconify-icon>
    </a>
    <a href="https://www.instagram.com/guvenkagroup" target="_blank" rel="noopener noreferrer" class="sticky-btn sticky-btn-instagram" aria-label="Instagram">
        <iconify-icon icon="mdi:instagram" width="24" height="24"></iconify-icon>
    </a>
    <a href="https://www.linkedin.com/company/guvenkagroup" target="_blank" rel="noopener noreferrer" class="sticky-btn sticky-btn-linkedin" aria-label="LinkedIn">
        <iconify-icon icon="mdi:linkedin" width="24" height="24"></iconify-icon>
    </a>
</div>
<!-- End Sticky Side Buttons -->

 <script src="{{ asset('assets/frontend/js/jquery-1.11.0.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script type="text/javascript" src="{{ asset('assets/frontend/js/script.js') }}"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>
</html>
