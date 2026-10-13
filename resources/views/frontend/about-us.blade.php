@extends('frontend.layouts.master')
@section('content')
  <!-- About Us Main Section (Styled matching Home) -->
  <section id="about-us" class="padding-large pt-3 ">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <h2 class="display-4 text-center fw-normal col-lg-8 offset-lg-2">Güvenka Organizasyon Hayallerinizi Gerçeğe Dönüştürüyoruz</h2>
      <div class="row align-items-start mt-3 mt-lg-5">
        <div class="col-lg-6">
          <div class="p-4 p-lg-5">
            <p class="fs-5" style="line-height: 1.8;">
              Güvenka Organizasyon olarak; düğün, kına, nişan, doğum günü, sünnet, fuar, baby shower, sürpriz evlilik teklifi ve açılış organizasyonlarınız için yaratıcı ve profesyonel çözümler sunuyoruz. Her etkinliği kendine özgü bir konsept olarak ele alıyor, planlama ve dekorasyondan uygulamaya kadar tüm süreci titizlikle yönetiyoruz.
            </p>
            <p class="" style="line-height: 1.8;">
              Amacımız, özel anlarınızı unutulmaz deneyimlere dönüştürmek ve her organizasyonda beklentilerinizin ötesine geçen kaliteli, şık ve özenli çözümler sunmaktır. Sektördeki yenilikçi yaklaşımımız, güçlü teknik altyapımız ve tecrübeli ekibimizle en mutlu günlerinizi kusursuz bir şölene dönüştürüyoruz.
            </p>
            <a href="{{ route('contact.index') }}" class="btn btn-arrow btn-primary mt-3">
              <span>Bize Ulaşın<svg width="18" height="18">
                  <use xlink:href="#arrow-right"></use>
                </svg></span>
            </a>
          </div>
          <img src="{{ asset('assets/frontend/images/about-1.jpg') }}" alt="Güvenka Organizasyon" class="img-fluid rounded-4 mt-4 w-100" style="object-fit: cover;">
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <img src="{{ asset('assets/frontend/images/about-2.jpg') }}" alt="Özel Günleriniz" class="img-fluid rounded-4 w-100" style="object-fit: cover;">
          <img src="{{ asset('assets/frontend/images/about-3.jpg') }}" alt="Kusursuz Hizmet" class="img-fluid rounded-4 mt-4 w-100" style="object-fit: cover;">
        </div>
      </div>
    </div>
  </section>

  <!-- Info / Counter Section -->
  <section id="info" class="padding-medium pt-0">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">25K <span
              class="position-absolute top-50 end-50 translate-middle z-n1 ps-lg-4 pt-lg-4"><img
                src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern" class="img-fluid"></span></h3>
          <p class="text-capitalize fs-5">Mutlu Müşteri</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">160 <span
              class="position-absolute top-50 translate-middle z-n1"><img src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern"
                class="img-fluid"></span></h3>
          <p class="text-capitalize fs-5">Organizasyon</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">25 <span
              class="position-absolute top-100 pb-5 translate-middle z-n1"><img src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern"
                class="img-fluid"></span></h3>
          <p class="text-capitalize fs-5">Yılın Organizasyonu</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">200 <span
              class="position-absolute top-50 end-50 pb-lg-4 pe-lg-2 translate-middle z-n1"><img
                src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern" class="img-fluid"></span></h3>
          <p class="text-capitalize fs-5">Ekip Üyesi</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission & Vision Section -->
  <section id="values" class="padding-large pt-0">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-6">
          <div class="bg-secondary rounded-5 p-5 h-100 d-flex flex-column justify-content-center">
            <span class="text-primary text-uppercase fw-semibold mb-2 d-inline-block">Hedeflerimiz</span>
            <h3 class="display-5 fw-normal mb-3">Vizyonumuz</h3>
            <p class="fs-5 text-secondary-emphasis" style="line-height: 1.8;">
              Yaratıcı vizyonumuz, yenilikçi konseptlerimiz ve üstün hizmet kalitemizle etkinlik ve organizasyon sektöründe Türkiye'nin en seçkin, güvenilir ve ilham veren markası olmak; her kutlamaya değer katmaktır.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-primary text-white rounded-5 p-5 h-100 d-flex flex-column justify-content-center">
            <span class="text-primary text-uppercase fw-semibold mb-2 d-inline-block">İlkelerimiz</span>
            <h3 class="display-5 fw-normal text-white mb-3">Misyonumuz</h3>
            <p class="fs-5 text-white-50" style="line-height: 1.8;">
              Müşterilerimizin hayallerini ve özel anlarını en ince detayına kadar dinleyerek; estetik, titizlik ve samimiyetle harmanlayıp beklentilerin ötesinde kusursuz organizasyon deneyimleri sunmaktır.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Feature End -->


    

@endsection
