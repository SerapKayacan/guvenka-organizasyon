@extends('frontend.layouts.master')

@section('content')
<main id="search-results-page">

    <!-- Search Hero Header -->
    <section id="search-hero" class="pt-3 pb-2" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="p-4 p-md-5 rounded-5 position-relative overflow-hidden" 
                 style="background: linear-gradient(135deg, #F9F6F3 0%, #F5EFEB 100%); border: 1px solid #EAE5DD;">
                
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        
                        <!-- Breadcrumb & Badge -->
                        <div class="d-inline-flex align-items-center gap-2 mb-3">
                            <a href="{{ route('home') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">Ana Sayfa</a>
                            <span class="text-muted" style="font-size: 0.8rem;">/</span>
                            <span class="badge px-3 py-2 rounded-pill fw-normal" 
                                  style="background-color: rgba(209, 104, 6, 0.12); color: var(--primary-color); font-size: 0.85rem; letter-spacing: 0.5px;">
                                Arama Sonuçları
                            </span>
                        </div>

                        <!-- Title -->
                        @if(!empty($query))
                            <h1 class="display-3 fw-normal mb-2">
                                “<span class="text-primary">{{ $query }}</span>”
                            </h1>
                            <p class="text-muted fs-5 mb-4">
                                için yapılan aramada <strong class="text-dark">{{ $totalResults }}</strong> sonuç bulundu.
                            </p>
                        @else
                            <h1 class="display-3 fw-normal mb-2">
                                Hizmet ve Etkinlik <span class="text-primary">Arama</span>
                            </h1>
                            <p class="text-muted fs-5 mb-4">
                                Özel günleriniz için aradığınız organizasyon hizmetlerini veya blog yazılarını keşfedin.
                            </p>
                        @endif

                        <!-- Search Form Bar -->
                        <form action="{{ route('search') }}" method="GET" class="search-form-hero position-relative mx-auto mt-2 mb-3" style="max-width: 650px;">
                            <div class="d-flex align-items-center bg-white rounded-pill p-2 shadow-sm border" style="border-color: #EAE5DD !important;">
                                <div class="ps-3 pe-2 text-muted d-flex align-items-center">
                                    <svg width="22" height="22" style="color: var(--primary-color);">
                                        <use xlink:href="#search"></use>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="query" 
                                       class="form-control border-0 bg-transparent shadow-none px-2 py-2 fs-6" 
                                       placeholder="Örn: düğün, nişan, kına, fuar organizasyonu..."
                                       value="{{ $query ?? '' }}"
                                       required
                                       aria-label="Arama Terimi">
                                <button type="submit" class="btn btn-arrow btn-primary rounded-pill py-2 px-4 flex-shrink-0">
                                    <span>Ara <svg width="16" height="16"><use xlink:href="#arrow-right"></use></svg></span>
                                </button>
                            </div>
                        </form>

                        <!-- Parsed Search Words Badges -->
                        @if(!empty($words))
                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 mt-3">
                                <span class="text-muted small me-1">Aranan Kelimeler:</span>
                                @foreach($words as $w)
                                    <span class="badge rounded-pill bg-white text-dark border px-3 py-2 fw-normal shadow-2xs">
                                        #{{ $w }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Popular Keywords Quick Filters -->
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 mt-3 pt-2">
                            <span class="text-muted small me-1">Önerilen Aramalar:</span>
                            @php
                                $popularTags = [
                                    'Düğün Organizasyonu', 
                                    'Kına Gecesi', 
                                    'Nişan', 
                                    'Sürpriz Evlilik Teklifi', 
                                    'Açılış', 
                                    'Baby Shower', 
                                    'Doğum Günü', 
                                    'Fuar'
                                ];
                            @endphp
                            @foreach($popularTags as $tag)
                                <a href="{{ route('search', ['query' => $tag]) }}" 
                                   class="quick-tag-pill badge rounded-pill bg-white text-muted border px-3 py-2 text-decoration-none transition-all">
                                    {{ $tag }}
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section id="search-content" class="padding-medium pt-4 pb-5">
        <div class="container-fluid padding-side">

            {{-- CASE 1: Results Found --}}
            @if($totalResults > 0)

                <!-- Quick Navigation Pills if both services and blogs exist -->
                @if($services->count() > 0 && $blogs->count() > 0)
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <div class="d-flex gap-2">
                            <a href="#services-results" class="btn btn-sm btn-primary rounded-pill px-3 py-2">
                                Hizmetler ({{ $services->count() }})
                            </a>
                            <a href="#blogs-results" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2">
                                Blog Yazıları ({{ $blogs->count() }})
                            </a>
                        </div>
                        <div class="text-muted small mt-2 mt-md-0">
                            En alakalı sonuçlar yukarıda sıralanmıştır.
                        </div>
                    </div>
                @endif

                <!-- 1. SERVICES SECTION -->
                @if($services->count() > 0)
                    <div id="services-results" class="mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <h3 class="display-5 fw-normal m-0">
                                    Hizmetlerimiz <span class="text-primary">({{ $services->count() }})</span>
                                </h3>
                                <p class="text-muted m-0 mt-1 small">Aradığınız kriterlere uygun Güvenka organizasyon hizmetleri</p>
                            </div>
                            <a href="{{ route('services-category.index') }}" class="btn btn-sm btn-arrow btn-section-link d-inline-flex">
                                <span>Tüm Faaliyet Alanlarımız <svg width="14" height="14"><use xlink:href="#arrow-right"></use></svg></span>
                            </a>
                        </div>

                        <div class="row g-4">
                            @foreach ($services as $service)
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 50, 400) }}">
                                    <div class="service-search-card bg-white rounded-4 overflow-hidden shadow-sm h-100 d-flex flex-column border transition-all">
                                        
                                        <!-- Service Image & Category Badge -->
                                        <div class="position-relative overflow-hidden service-img-wrapper" style="height: 260px; background-color: #1A1A1A;">
                                            @php
                                                $imageUrl = $service->hasMedia('banner') 
                                                    ? $service->getFirstMediaUrl('banner', 'large') 
                                                    : asset('assets/frontend/images/opening.jpeg');
                                            @endphp
                                            <a href="{{ route('services-detail.show', $service->slug) }}" class="d-block w-100 h-100">
                                                <img src="{{ $imageUrl }}" 
                                                     alt="{{ $service->title }}"
                                                     class="w-100 h-100 service-img" 
                                                     style="object-fit: cover; transition: transform 0.6s ease;">
                                            </a>
                                            <span class="position-absolute top-0 end-0 m-3 badge rounded-pill px-3 py-2 category-badge"
                                                  style="background: rgba(255, 255, 255, 0.95); color: var(--primary-color); font-weight: 500; font-size: 0.85rem; box-shadow: 0 4px 12px rgba(0,0,0,0.12);">
                                                {{ $service->getCategory->title ?? 'Hizmet' }}
                                            </span>
                                        </div>

                                        <!-- Card Body -->
                                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                                            <div>
                                                <h4 class="display-6 fw-normal mb-2">
                                                    <a href="{{ route('services-detail.show', $service->slug) }}" class="text-dark text-decoration-none service-title-link">
                                                        {{ $service->title }}
                                                    </a>
                                                </h4>
                                                
                                                <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                                                    {{ Str::limit($service->sort_detail ?: strip_tags($service->category_page_detail ?: $service->detail), 125) }}
                                                </p>
                                            </div>

                                            <!-- Card Footer Actions -->
                                            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                                <a href="{{ route('services-detail.show', $service->slug) }}" class="btn btn-arrow btn-primary py-2 px-3">
                                                    <span>İncele <svg width="16" height="16"><use xlink:href="#arrow-right"></use></svg></span>
                                                </a>

                                                <a href="https://wa.me/905353008052?text={{ urlencode('Merhaba, ' . $service->title . ' hakkında detaylı bilgi ve fiyat teklifi almak istiyorum.') }}"
                                                   target="_blank" 
                                                   rel="noopener noreferrer" 
                                                   class="btn btn-sm rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 whatsapp-btn"
                                                   style="background-color: #25D366; color: white; border: none; font-size: 0.85rem;"
                                                   title="WhatsApp ile Bilgi Alın">
                                                    <iconify-icon icon="mdi:whatsapp" width="18" height="18"></iconify-icon>
                                                    <span>Teklif Al</span>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 2. BLOGS SECTION -->
                @if($blogs->count() > 0)
                    <div id="blogs-results" class="mt-5 pt-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <h3 class="display-5 fw-normal m-0">
                                    Blog ve Etkinlikler <span class="text-primary">({{ $blogs->count() }})</span>
                                </h3>
                                <p class="text-muted m-0 mt-1 small">Arama konusu ile ilgili ipuçları, konsept önerileri ve makaleler</p>
                            </div>
                            <a href="{{ route('blog.index') }}" class="btn btn-sm btn-arrow btn-section-link d-inline-flex">
                                <span>Tüm Blog Yazılarını Gör <svg width="14" height="14"><use xlink:href="#arrow-right"></use></svg></span>
                            </a>
                        </div>

                        <div class="row g-4">
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 50, 400) }}">
                                    <div class="blog-post position-relative overflow-hidden rounded-4 shadow-sm h-100" style="min-height: 380px;">
                                        <img src="{{ asset($blog->image) }}" 
                                             class="blog-img img-fluid rounded-4 w-100 h-100" 
                                             alt="{{ $blog->title }}" 
                                             style="object-fit: cover;">
                                        
                                        <div class="position-absolute bottom-0 p-4 w-100" 
                                             style="background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.88) 100%);">
                                            @if($blog->category)
                                                <a href="{{ route('blog.show', $blog->slug) }}">
                                                    <span class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6 d-inline-block mb-2">
                                                        {{ $blog->category }}
                                                    </span>
                                                </a>
                                            @endif
                                            
                                            <h4 class="display-6 fw-normal text-white mt-1 mb-2">
                                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-white text-decoration-none">
                                                    {{ $blog->title }}
                                                </a>
                                            </h4>
                                            
                                            <p class="m-0 align-items-center text-white-50" style="font-size: 0.9rem;">
                                                <svg width="16" height="16" style="fill: white;" class="me-1">
                                                    <use xlink:href="#clock"></use>
                                                </svg> 
                                                {{ \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            {{-- CASE 2: No Results Found (Empty State) --}}
            @else
                <div class="empty-search-state py-5 text-center" data-aos="fade-up">
                    <div class="p-5 rounded-5 mx-auto bg-light border shadow-sm" style="max-width: 800px;">
                        
                        <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 90px; height: 90px; background-color: rgba(209, 104, 6, 0.1);">
                            <svg width="45" height="45" style="color: var(--primary-color);">
                                <use xlink:href="#search"></use>
                            </svg>
                        </div>

                        <h2 class="display-4 fw-normal mb-3">
                            “{{ $query }}” ile Eşleşen Sonuç Bulunamadı
                        </h2>

                        <p class="text-muted fs-5 mb-4 mx-auto" style="max-width: 600px; line-height: 1.8;">
                            Aradığınız terime uygun bir organizasyon hizmeti ya da makale kaydı bulunamadı. 
                            Lütfen yazım hatası olup olmadığını kontrol edin veya aşağıdaki popüler kategorilerden birini seçin.
                        </p>

                        <!-- Secondary search bar -->
                        <form action="{{ route('search') }}" method="GET" class="position-relative mx-auto mb-4" style="max-width: 500px;">
                            <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                                <input type="text" name="query" class="form-control border-0 px-4 py-3" placeholder="Farklı bir kelime deneyin...">
                                <button class="btn btn-primary px-4" type="submit">Ara</button>
                            </div>
                        </form>

                        <!-- Suggestion Pills -->
                        <div class="mb-4">
                            <p class="text-muted small mb-2">Öne Çıkan Hizmetlerimiz:</p>
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                @foreach(['Düğün Organizasyonu', 'Nişan Organizasyonu', 'Kına Gecesi', 'Sürpriz Evlilik Teklifi', 'Açılış', 'Doğum Günü'] as $recTag)
                                    <a href="{{ route('search', ['query' => $recTag]) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1">
                                        {{ $recTag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4 pt-2">
                            <a href="{{ route('services-category.index') }}" class="btn btn-arrow btn-primary">
                                <span>Tüm Hizmetlerimizi Gör <svg width="18" height="18"><use xlink:href="#arrow-right"></use></svg></span>
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-dark rounded-3 px-4 py-2 d-inline-flex align-items-center">
                                İletişime Geçin
                            </a>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Consultation & CTA Section -->
    <section id="search-cta" class="padding-small pt-0 pb-5" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="p-4 p-md-5 rounded-5 position-relative overflow-hidden text-center text-md-start"
                 style="background: linear-gradient(135deg, #1A1A1A 0%, #2A2A2A 100%); color: white;">
                
                <div class="row align-items-center justify-content-between g-4">
                    <div class="col-lg-7">
                        <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: var(--primary-color); font-weight: 500;">
                            Özel Günleriniz İçin Buradayız
                        </span>
                        <h3 class="display-4 fw-normal text-white mb-3">
                            Hayalinizdeki Organizasyonu Birlikte Gerçekleştirelim
                        </h3>
                        <p class="text-white-50 m-0 fs-6" style="line-height: 1.8;">
                            Düğün, kına, nişan, evlilik teklifi veya kurumsal açılış organizasyonlarınız için en özel konseptleri ve detaylı bütçe teklifini almak için hemen uzman ekibimizle görüşün.
                        </p>
                    </div>
                    
                    <div class="col-lg-5 text-center text-md-end">
                        <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-3">
                            <a href="tel:+905353008052" class="btn btn-light rounded-pill py-3 px-4 d-inline-flex align-items-center justify-content-center gap-2 fw-semibold">
                                <iconify-icon icon="mdi:phone" width="20" height="20" style="color: var(--primary-color);"></iconify-icon>
                                <span>0535 300 80 52</span>
                            </a>
                            <a href="https://wa.me/905353008052?text={{ urlencode('Merhaba, Güvenka Organizasyon hizmetleri hakkında bilgi almak istiyorum.') }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="btn rounded-pill py-3 px-4 d-inline-flex align-items-center justify-content-center gap-2 fw-semibold"
                               style="background-color: #25D366; color: white;">
                                <iconify-icon icon="mdi:whatsapp" width="20" height="20"></iconify-icon>
                                <span>WhatsApp Destek</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<style>
/* Scoped styles for Search Results Page */
.service-search-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.service-search-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08) !important;
}
.service-search-card:hover .service-img {
    transform: scale(1.06);
}
.service-title-link:hover {
    color: var(--primary-color) !important;
}
.quick-tag-pill:hover {
    background-color: var(--primary-color) !important;
    color: #ffffff !important;
    border-color: var(--primary-color) !important;
}
.whatsapp-btn:hover {
    filter: brightness(0.92);
}
.service-img-wrapper {
    overflow: hidden;
}
.btn-section-link {
    background-color: var(--secondary-color) !important;
    color: var(--dark-color) !important;
    border: 1px solid #EAE5DD !important;
    font-size: 0.92rem !important;
    font-weight: 500 !important;
    text-transform: capitalize;
    border-radius: 50px !important;
    padding: 0.55rem 1.6rem !important;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease-in-out;
}
.btn-section-link span {
    color: var(--dark-color) !important;
    transition: color 0.3s ease;
}
.btn-section-link:hover {
    background-color: var(--primary-color) !important;
    color: #ffffff !important;
    border-color: var(--primary-color) !important;
    box-shadow: 0 4px 14px rgba(209, 104, 6, 0.25) !important;
}
.btn-section-link:hover span {
    color: #ffffff !important;
}
.btn-section-link svg {
    color: inherit;
}
</style>
@endsection

