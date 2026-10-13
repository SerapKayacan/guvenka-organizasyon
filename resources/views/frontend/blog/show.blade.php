@extends('frontend.layouts.master')
@section('content')
<section class="padding-medium">
    <div class="container-fluid padding-side">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <img src="{{ asset($blog->image) }}" class="img-fluid rounded-4 mb-4" alt="{{ $blog->title }}" style="width: 100%; max-height: 600px; object-fit: cover;">
                <span class="bg-primary text-white px-3 py-1 rounded-2 fs-6">{{ $blog->category }}</span>
                <h1 class="display-4 mt-3 mb-4">{{ $blog->title }}</h1>
                <div class="blog-content" style="font-size: 1.1rem; line-height: 1.8;">
                    {!! $blog->content !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 bg-light rounded-4">
                    <h3 class="mb-4">Son Yazılar</h3>
                    @foreach($recentBlogs as $recent)
                    <div class="d-flex mb-4 align-items-center">
                        <img src="{{ asset($recent->image) }}" class="img-fluid rounded-3" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $recent->title }}">
                        <div class="ms-3">
                            <h6 class="mb-1"><a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none text-dark">{{ $recent->title }}</a></h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($recent->published_at)->format('d M, Y') }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
