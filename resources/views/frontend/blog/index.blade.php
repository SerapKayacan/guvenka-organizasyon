@extends('frontend.layouts.master')
@section('content')
<section class="padding-medium">
    <div class="container-fluid padding-side">
      <h2 class="display-3 fw-normal text-center mb-5">Blog ve Etkinlikler</h2>
      <div class="row mt-5">
        @foreach($blogs as $blog)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="blog-post position-relative overflow-hidden rounded-4">
            <img src="{{ asset($blog->image) }}" class="blog-img img-fluid rounded-4" alt="{{ $blog->title }}" style="width: 100%; height: 450px; object-fit: cover;">
            <div class="position-absolute bottom-0 p-5">
              <a href="{{ route('blog.show', $blog->slug) }}"><span class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">{{ $blog->category }}</span></a>
              <h4 class="display-6 fw-normal mt-2"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h4>
              <p class="m-0 align-items-center text-white"><svg width="19" height="19" style="fill: white;">
                  <use xlink:href="#clock"></use>
                </svg> {{ \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="mt-4">
        {{ $blogs->links() }}
      </div>
    </div>
</section>
@endsection
