@extends('frontend.layouts.master')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(135deg, #0B2154, #1a3a7a);">
        <div class="container py-3">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="h6 text-white text-uppercase mb-3">// Hizmetlerimiz //</div>
                <h1 class="text-white mb-2">Organizasyon Çözümleri</h1>
                <p class="text-white-50 mb-0">Özel günleriniz ve kurumsal davetleriniz için en profesyonel organizasyon seçeneklerini keşfedin</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            @foreach($serviceCategories as $index => $cat)
                @php
                    // Dinamik tasarım için renk tonları (Kurumsal Lacivert ve Vurgu Kırmızı kullanılıyor)
                    $isEven = $index % 2 == 0;
                    $color = $isEven ? '#0B2154' : '#D81324';
                    $rgbColor = $isEven ? '11,33,84' : '216,19,36';
                    $btnClass = $isEven ? 'btn-primary' : 'btn-danger';
                @endphp
                
                <div class="row g-5 align-items-center mb-5 pb-5 {{ !$isEven ? 'flex-row-reverse' : '' }}">
                    
                    <!-- Görsel / İkon Vitrin Kısmı -->
                    <div class="col-lg-5 wow {{ !$isEven ? 'fadeInRight' : 'fadeInLeft' }}" data-wow-delay="0.1s">
                        <div class="position-relative h-100 overflow-hidden d-flex align-items-center justify-content-center" 
                             style="min-height: 400px; background: rgba({{ $rgbColor }}, 0.04); border: 8px solid #ffffff; border-radius: 24px; box-shadow: 0 15px 40px rgba({{ $rgbColor }}, 0.15);">
                            
                            @if($cat->getFirstMediaUrl('banner'))
                                <img src="{{ $cat->getFirstMediaUrl('banner') }}" alt="{{ $cat->title }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover; border-radius: inherit;">
                            @else
                                <div class="text-center p-5">
                                    <div class="mb-4" style="font-size: 8rem; color: {{ $color }}; opacity: 0.95;">
                                        {!! $cat->icon !!}
                                    </div>
                                    <h3 style="color: {{ $color }};" class="fw-bolder">{{ $cat->title }}</h3>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    
                    <!-- Detaylı İçerik ve Hizmet Listesi Kısmı -->
                    <div class="col-lg-7 wow {{ !$isEven ? 'fadeInLeft' : 'fadeInRight' }}" data-wow-delay="0.3s">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:6px;height:45px;background:{{ $color }};border-radius:3px;"></div>
                            <h2 class="mb-0 fw-bold">{{ $cat->title }}</h2>
                        </div>
                        
                        <p class="mb-5 text-secondary fs-5" style="line-height: 1.8;">
                            {{ strip_tags($cat->description) }}
                        </p>
                        
                        @if($cat->services->where('is_active', true)->count() > 0)
                            <div class="row g-3 mb-5 bg-light p-4 rounded-4 shadow-sm" style="border-left: 4px solid {{ $color }};">
                                @foreach($cat->services->where('is_active', true) as $service)
                                    <div class="col-md-6">
                                        <a href="{{ route('services-detail.show', ['slug' => $service->slug]) }}" 
                                           class="d-flex align-items-center gap-3 text-dark text-decoration-none fw-semibold border-bottom border-white pb-3 pt-2">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle shadow-sm" 
                                                 style="width:30px;height:30px;background:{{ $color }};color:white;font-size:12px;">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                            {{ $service->title }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="mt-2 text-{{ !$isEven ? 'end' : 'start' }}">
                            <a href="{{ route('services.byCategory', ['slug' => $cat->slug]) }}" 
                               class="btn {{ $btnClass }} py-3 px-5 rounded-pill shadow-sm fw-bold">
                                {{ $cat->title }} Detayları İncele <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Bölümler Arası Ayıraç -->
                @if(!$loop->last)
                    <div class="row mb-5 pb-5">
                        <div class="col-12 text-center">
                            <div style="width:80px;height:4px;background:linear-gradient(90deg, #0B2154, #D81324);margin:0 auto;border-radius:2px;opacity:0.6;"></div>
                        </div>
                    </div>
                @endif
                
            @endforeach
        </div>
    </div>

    <!-- CTA Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background:#0B2154;">
        <div class="container">
            <div class="row align-items-center gx-5">
                <div class="col-lg-8 py-3">
                    <h2 class="text-white mb-2">Hizmetlerimiz Hakkında Bilgi Alın</h2>
                    <p class="mb-0" style="color:rgba(255,255,255,0.7);">Size özel teklif ve detaylı fiyatlandırma için bizimle hemen iletişime geçin.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('contact.index') }}" class="btn btn-primary py-3 px-5 shadow-sm rounded-pill">
                        Bize Ulaşın <i class="fa fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA End -->

@endsection
