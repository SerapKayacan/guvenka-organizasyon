@extends('frontend.layouts.master')
@section('content')
<section class="padding-medium">
    <div class="container-fluid padding-side">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <img src="{{ $service->hasMedia('banner') ? $service->getFirstMediaUrl('banner','large') : asset('assets/frontend/images/opening.jpeg') }}" class="img-fluid rounded-4 mb-4" alt="{{ $service->title }}" style="width: 100%; max-height: 600px; object-fit: cover;">
                <span class="bg-primary text-white px-3 py-1 rounded-2 fs-6">{{ $service->getCategory->title ?? 'Hizmetler' }}</span>
                <h1 class="display-4 mt-3 mb-4">{{ $service->title }}</h1>
                <div class="blog-content" style="font-size: 1.1rem; line-height: 1.8;">
                    {!! $service->detail !!}
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="p-4 bg-light rounded-4">
                    <h3 class="mb-4">Diğer Hizmetler</h3>
                    @php
                        $otherServices = \App\Models\Service::where('is_active', true)->where('id', '!=', $service->id)->inRandomOrder()->take(4)->get();
                    @endphp
                    @foreach($otherServices as $other)
                    <div class="d-flex mb-4 align-items-center">
                        <img src="{{ $other->hasMedia('banner') ? $other->getFirstMediaUrl('banner','large') : asset('assets/frontend/images/opening.jpeg') }}" class="img-fluid rounded-3" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $other->title }}">
                        <div class="ms-3">
                            <h6 class="mb-1"><a href="{{ route('services-detail.show', $other->slug) }}" class="text-decoration-none text-dark">{{ $other->title }}</a></h6>
                            <small class="text-muted">{{ $other->getCategory->title ?? 'Hizmetler' }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
