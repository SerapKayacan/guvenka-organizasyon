@extends('frontend.layouts.master')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid py-5 mb-5" style="background: linear-gradient(135deg, #0B2154, #1a3a7a);">
        <div class="container py-3">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="h6 text-white text-uppercase mb-3">// Referanslarımız //</div>
                <h1 class="text-white mb-2">Tamamladığımız İşler</h1>
                <p class="text-white-50 mb-0">Yıllar İçinde Gerçekleştirdiğimiz Projeler Ve Güvendiğimiz Kurumlar</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Security References Start -->
    @if($securityReferences->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($securityReferences as $i => $reference)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ ($i % 3) * 0.15 }}s">
                    <div class="h-100 overflow-hidden" style="border-radius:16px;box-shadow:0 4px 24px rgba(11,33,84,0.1);border:3px solid #0B2154;">
                        <div style="height:200px;overflow:hidden;border-radius:14px 14px 0 0;position:relative;">
                           @if($reference->hasMedia('image'))
                                <img src="{{ $reference->getFirstMediaUrl('image','large') }}"
                                     class="w-100 h-100" style="object-fit:cover;" alt="{{ $reference->name }}">
                           
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background:rgba(11,33,84,0.08);">
                                    <i class="fa fa-shield-alt fa-4x" style="color:#0B2154;opacity:0.2;"></i>
                                </div>
                            @endif  
                            @if($reference->location)
                            <div class="position-absolute bottom-0 start-0 m-2 px-2 py-1 d-flex align-items-center gap-1"
                                 style="background:rgba(0,0,0,0.55);border-radius:6px;">
                                <i class="fa fa-map-marker-alt text-white" style="font-size:0.75rem;"></i>
                                <small class="text-white" style="font-size:0.75rem;">{{ $reference->location }}</small>
                            </div>
                            @endif
                        </div>
                        <div class="p-4 bg-white" style="border-radius:0 0 14px 14px;">
                            <h5 class="fw-bold mb-3" style="color:#0B2154;">{{ $reference->name }}</h5>
                            @if($reference->description)
                            <p class="text-muted mb-0" style="font-size:0.88rem;line-height:1.7;">{{ $reference->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Security References End -->

    @if($securityReferences->count() > 0 && $cleaningReferences->count() > 0)
    <div style="height:4px;background:linear-gradient(90deg,#0B2154,#D81324);"></div>
    @endif

    

    @if($securityReferences->count() === 0 && $cleaningReferences->count() === 0)
    <div class="container-xxl py-5">
        <div class="container text-center py-5">
            <i class="fa fa-info-circle fa-3x text-muted mb-3 d-block"></i>
            <p class="text-muted">Henüz referans eklenmemiştir.</p>
        </div>
    </div>
    @endif

    <!-- Partner Logos Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
                <div class="h6 text-primary text-uppercase mb-2" style="letter-spacing:2px;">// Çalıştığımız Kurumlar //</div>
                <h2 class="mb-0">Bize Güvenen Markalar</h2>
            </div>
            <div class="row g-4 align-items-center justify-content-center wow fadeInUp" data-wow-delay="0.2s">

                @foreach($partners as $partner)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="d-flex align-items-center justify-content-center p-3"
                         style="background:#f8f9fa;border-radius:12px;height:90px;border:1px solid #eee;transition:all 0.3s;"
                         onmouseover="this.style.boxShadow='0 4px 20px rgba(11,33,84,0.15)';this.style.borderColor='#0B2154';"
                         onmouseout="this.style.boxShadow='none';this.style.borderColor='#eee';">
                        @if($partner->hasMedia('image'))
                            <img src="{{ $partner->getFirstMediaUrl('image', 'thumb') }}"
                                 alt="{{ $partner->name }}"
                                 style="max-height:60px;max-width:100%;object-fit:contain;filter:grayscale(30%);"
                                 onmouseover="this.style.filter='grayscale(0)'"
                                 onmouseout="this.style.filter='grayscale(30%)'">
                        @else
                            <span class="fw-semibold text-center" style="color:#0B2154;font-size:0.8rem;line-height:1.4;">{{ $partner->name }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Partner Logos End -->

    <!-- CTA Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background:#0B2154;">
        <div class="container">
            <div class="row align-items-center gx-5">
                <div class="col-lg-8 py-3">
                    <h2 class="text-white mb-2">Siz de Referanslarımız Arasında Yer Alın</h2>
                    <p class="mb-0" style="color:rgba(255,255,255,0.7);">Organizasyon hizmetlerimiz hakkında bilgi almak ve teklif talep etmek için bizimle iletişime geçin.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('contact.index') }}" class="btn btn-primary py-3 px-5">
                        Bize Ulaşın<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA End -->

@endsection
