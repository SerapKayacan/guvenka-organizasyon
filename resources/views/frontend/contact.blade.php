@extends('frontend.layouts.master')
@section('content')
<!-- Contact Start -->
<section id="contact-content" class="pt-3 mb-4">
    <div class="container-fluid padding-side">
        <div class="text-center mx-auto mb-5" data-aos="fade-up" style="max-width: 600px;">
            <h4 class="display-6 text-primary fw-normal mb-2">İletişim</h4>
            <h1 class="display-5 fw-normal mb-4">Size Bir Telefon Kadar Yakınız</h1>
        </div>
        <div class="row g-5 align-items-stretch">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="d-flex flex-column gap-4 h-100">
                    <div class="bg-light d-flex align-items-center w-100 p-4 rounded-4 contact-card transition-hover">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary rounded-circle" style="width: 45px; height: 45px;">
                            <i class="fa fa-map-marker-alt text-white fs-5"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 text-muted">Adres</p>
                            <h5 class="mb-0 fw-normal">Orta Mh. Kılıç Alipaşa Sk.<br>No:20A Kartal/İstanbul</h5>
                        </div>
                    </div>
                    <div class="bg-light d-flex align-items-center w-100 p-4 rounded-4 contact-card transition-hover">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary rounded-circle" style="width: 45px; height: 45px;">
                            <i class="fa fa-phone-alt text-white fs-5"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 text-muted">Telefon</p>
                            <h5 class="mb-0 fw-normal">0216 514 80 83</h5>
                        </div>
                    </div>
                    <div class="bg-light d-flex align-items-center w-100 p-4 rounded-4 contact-card transition-hover">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary rounded-circle" style="width: 45px; height: 45px;">
                            <i class="fa fa-mobile-alt text-white fs-5"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 text-muted">Mobil</p>
                            <h5 class="mb-0 fw-normal">0535 300 80 52</h5>
                        </div>
                    </div>
                    <div class="bg-light d-flex align-items-center w-100 p-4 rounded-4 contact-card transition-hover">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary rounded-circle" style="width: 45px; height: 45px;">
                            <i class="fa fa-envelope-open text-white fs-5"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-1 text-muted">Mail</p>
                            <h5 class="mb-0 fw-normal">info@guvenkagroup.com</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white p-3 rounded-4 shadow-sm border h-100 d-flex flex-column justify-content-center">
                    <h3 class="display-6 fw-normal mb-3">Mesaj Gönderin</h3>
                    <p class="mb-4 text-muted">Bizimle iletişime geçmek için aşağıdaki formu doldurabilirsiniz. En kısa sürede size geri dönüş yapılacaktır.</p>
                    <form>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3 bg-light border-0" id="name" placeholder="Adınız">
                                    <label for="name">Adınız</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control rounded-3 bg-light border-0" id="email" placeholder="E-posta Adresiniz">
                                    <label for="email">E-posta Adresiniz</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3 bg-light border-0" id="subject" placeholder="Konu">
                                    <label for="subject">Konu</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-3 bg-light border-0" placeholder="Mesajınızı buraya yazın" id="message" style="height: 150px"></textarea>
                                    <label for="message">Mesajınız</label>
                                </div>
                            </div>
                            <div class="col-12 mt-0">
                                <button class="btn btn-primary btn-arrow rounded-3 px-5 py-2 d-inline-flex align-items-center" type="submit">
                                    <span>Mesaj Gönder <svg width="18" height="18" class="ms-2">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact End -->

<!-- Google Map Start -->
<section id="map" class="padding-medium pt-0" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <div class="rounded-5 overflow-hidden shadow-sm" style="position: relative;">
            <iframe class="w-100 d-block" style="height: 500px; border:0;"
                src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d96428.79017231654!2d29.09078955928521!3d40.9508220689109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m3!3m2!1d40.9786274!2d29.125241199999998!4m5!1s0x14cac57f69349da7%3A0x88091e1d326bff19!2zR8O8dmVua2EgR3JvdXAsIE9ydGEsIEvEsWzEscOnIEFsaSBQYcWfYSBTay4gMjBBLCAzNDg4MCBLYXJ0YWwvxLBzdGFuYnVs!3m2!1d40.911994899999996!2d29.2049813!5e0!3m2!1str!2str!4v1786977451450!5m2!1str!2str"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</section>
<!-- Google Map End -->

<style>
    .contact-card.transition-hover {
        transition: all 0.3s ease;
    }
    .contact-card.transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.05)!important;
    }
</style>
@endsection
