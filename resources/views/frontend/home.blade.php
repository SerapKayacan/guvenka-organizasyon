@extends('frontend.layouts.master')
@section('content')
 <section id="slider" data-aos="fade-up">
    <div class="container-fluid padding-side pt-2">
      <div class="d-flex rounded-5"
        style="background-image: url({{ asset('assets/frontend/images/flower.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 85vh; background-position: center;">
        <div class="row align-items-center m-auto pt-5 px-4 px-lg-0">
          <div class="text-start col-md-6 col-lg-5 col-xl-6 offset-lg-1">
            <h2 class="display-1 fw-normal">Güvenka Organizasyon Özel Günlerinizde Yanınızda.</h2>
            <a href="{{ route('services-category.index') }}" class="btn btn-arrow btn-primary mt-3">
              <span>Keşfet <svg width="18" height="18">
                  <use xlink:href="#arrow-right"></use>
                </svg></span>
            </a>
          </div>
         
        </div>
      </div>
    </div>
  </section>

  <section id="about-us" class="padding-large">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <h3 class="display-4 text-center fw-normal col-lg-4 offset-lg-4">Güvenka Organizasyon Hayallerinizi Gerçeğe Dönüştürüyoruz</h3>
      <div class="row align-items-start mt-3 mt-lg-5">
        <div class="col-lg-6">
          <div class="p-5">
            <p>Güvenka Organizasyon olarak; düğün, kına, nişan, doğum günü, sünnet, fuar, baby shower, sürpriz evlilik teklifi ve açılış organizasyonlarınız için yaratıcı ve profesyonel çözümler sunuyoruz. Her etkinliği kendine özgü bir konsept olarak ele alıyor, planlama ve dekorasyondan uygulamaya kadar tüm süreci titizlikle yönetiyoruz.
Amacımız, özel anlarınızı unutulmaz deneyimlere dönüştürmek ve her organizasyonda beklentilerinizin ötesine geçen kaliteli, şık ve özenli çözümler sunmaktır.</p>
            <a href="{{ route('about-us.index') }}" class="btn btn-arrow btn-primary mt-3">
              <span>Bizi Tanıyın<svg width="18" height="18">
                  <use xlink:href="#arrow-right"></use>
                </svg></span>
            </a>
          </div>
          <img src="{{ asset('assets/frontend/images/about-1.jpg') }}" alt="img" class="img-fluid rounded-4 mt-4">
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <img src="{{ asset('assets/frontend/images/about-2.jpg') }}" alt="img" class="img-fluid rounded-4">
          <img src="{{ asset('assets/frontend/images/about-3.jpg') }}" alt="img" class="img-fluid rounded-4 mt-4">

        </div>
      </div>
    </div>
  </section>

  <section id="info">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">25K <span
              class="position-absolute top-50 end-50 translate-middle z-n1 ps-lg-4 pt-lg-4"><img
                src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern" class="img-fluid"></span></h3>
          <p class="text-capitalize">Mutlu Müşteri</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">160 <span
              class="position-absolute top-50 translate-middle z-n1"><img src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern"
                class="img-fluid"></span></h3>
          <p class="text-capitalize">Organizasyon</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">25 <span
              class="position-absolute top-100 pb-5 translate-middle z-n1"><img src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern"
                class="img-fluid"></span></h3>
          <p class="text-capitalize">Yılın Organizasyonu</p>
        </div>
        <div class="col-md-3 text-center mb-4 mb-lg-0">
          <h3 class="display-1 fw-normal text-primary position-relative">200 <span
              class="position-absolute top-50 end-50 pb-lg-4 pe-lg-2 translate-middle z-n1"><img
                src="{{ asset('assets/frontend/images/pattern1.png') }}" alt="pattern" class="img-fluid"></span></h3>
          <p class="text-capitalize">Ekip Üyesi</p>
        </div>
      </div>
    </div>
  </section>

  <section id="room" class="padding-medium">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <div class="text-center mb-4">
        <h3 class="display-4 fw-normal">Hizmetlerimiz</h3>
      </div>
    <div class="swiper room-swiper mt-2">
      <div class="swiper-wrapper">
        <!-- Dynamic Services Loop -->
        @foreach($services as $service)
        <div class="swiper-slide">
      <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
        <img src="{{ $service->getFirstMediaUrl('banner', 'large') ?: ($service->getFirstMediaUrl('banner') ?: asset('assets/frontend/images/opening.jpeg')) }}"
             alt="{{ $service->title }}"
             class="post-image img-fluid rounded-4" style="height: 500px; width: 100%; object-fit: cover;">

        <div class="product-description position-absolute p-5 text-start">
          <h4 class="display-6 fw-normal text-white">
            {{ $service->title }}
          </h4>

          <p class="product-paragraph text-white">
            {{ $service->sort_detail ?? '' }}
          </p>

          <a href="{{ route('services-detail.show', $service->slug) }}">
            <p class="text-decoration-underline text-white m-0 mt-2">
              Detaylı Bilgi
            </p>
          </a>
        </div>
      </div>

      <div class="room-content text-center mt-3">
        <h4 class="display-6 fw-normal">
          <a href="{{ route('services-detail.show', $service->slug) }}">
            {{ $service->title }}
          </a>
        </h4>
      </div>
    </div>
    @endforeach

  </div>
  <div class="swiper-pagination room-pagination position-relative mt-5"></div>
</div>

  <section id="blog" class="padding-medium pt-0 ">
    <div class="container-fluid padding-side" data-aos="fade-up">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div>
          <h3 class="display-3 fw-normal text-center">Blog & Etkinlikler</h3>
        </div>
        <a href="{{ route('blog.index') }}" class="btn btn-arrow btn-primary mt-3">
          <span>Daha Fazla<svg width="18" height="18">
              <use xlink:href="#arrow-right"></use>
            </svg></span>
        </a>
      </div>
      <div class="row mt-5">
        @foreach($blogs as $blog)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="blog-post position-relative overflow-hidden rounded-4">
            <img src="{{ asset($blog->image) }}" class="blog-img img-fluid rounded-4" alt="{{ $blog->title }}" style="width: 100%; height: 450px; object-fit: cover;">
            <div class="position-absolute bottom-0 p-5">
              <a href="{{ route('blog.show', $blog->slug) }}"><span class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">{{ $blog->category }}</span></a>
              <h4 class="display-6 fw-normal mt-2"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h4>
              <p class="m-0 align-items-center"><svg width="19" height="19">
                  <use xlink:href="#clock"></use>
                </svg> {{ \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>


@endsection
