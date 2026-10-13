@section('title', 'Blog Listesi')
@extends('admin.layouts.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Blog Listesi</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Gösterge Paneli</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Blog Listesi</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"/>
                                <path d="M10.4357 15.65L7.24372 12.458C6.9313 12.1456 6.9313 11.639 7.24372 11.3266C7.55614 11.0142 8.0627 11.0142 8.37512 11.3266L11 13.9515L16.6249 8.32662C16.9373 8.0142 17.4439 8.0142 17.7563 8.32662C18.0687 8.63904 18.0687 9.1456 17.7563 9.45802L11.5643 15.65C11.2519 15.9624 10.7481 15.9624 10.4357 15.65Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="d-flex flex-column">
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                              rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-find="search"
                                       class="form-control form-control-solid w-250px ps-14" placeholder="Arama" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Yeni Blog Yazısı</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="dataTable">
                            <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">No</th>
                                <th>Görsel</th>
                                <th class="min-w-250px">Başlık</th>
                                <th class="min-w-120px">Kategori</th>
                                <th class="min-w-120px">Yayın Tarihi</th>
                                <th class="min-w-100px">Durum</th>
                                <th class="text-end min-w-70px">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            @foreach ($blogs as $blog)
                                <tr id="order-{{ $blog->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($blog->image && file_exists(public_path($blog->image)))
                                            <img src="{{ asset($blog->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:4px;">
                                        @else
                                            <img src="{{ asset('assets/frontend/images/post1.jpg') }}" style="width:60px;height:45px;object-fit:cover;border-radius:4px;opacity:0.6;">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-find="code">
                                            {{ $blog->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info">{{ $blog->category ?? 'Genel' }}</span>
                                    </td>
                                    <td>
                                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d.m.Y H:i') : '-' }}
                                    </td>
                                    <td>
                                        @if ($blog->is_active)
                                            <div class="badge badge-light-success">Aktif</div>
                                        @else
                                            <div class="badge badge-light-danger">Pasif</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" data-toggle="tooltip" title="Görüntüle" class="btn btn-icon btn-light btn-hover-primary btn-sm me-1">
                                            <i class="far fa-eye text-primary icon-lg"></i>
                                        </a>
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" data-toggle="tooltip" title="Düzenle" class="btn btn-icon btn-light btn-hover-primary btn-sm me-1">
                                            <i class="far fa-edit text-warning icon-lg"></i>
                                        </a>
                                        <a href="#" type="button" data-toggle="tooltip" title="Sil" class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                           data-url="{{ route('admin.blog.destroy', $blog->id) }}"
                                           data-method="delete"
                                           data-id="{{ $blog->id }}"
                                           data-count="0">
                                            <i class="far fas fa-trash-alt text-danger icon-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('') }}assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{ asset('') }}assets/js/admin/datatable.js"></script>
    <script src="{{ asset('') }}assets/js/admin/delete.js"></script>
@endsection
