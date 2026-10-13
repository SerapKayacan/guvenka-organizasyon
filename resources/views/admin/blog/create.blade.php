@section('title', 'Yeni Blog Yazısı')
@extends('admin.layouts.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Yeni Blog Yazısı</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Gösterge Paneli</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.blog.index') }}" class="text-muted text-hover-primary">Blog Listesi</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Yeni</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @if ($errors->any())
                    <div class="alert alert-danger mb-5">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush pt-5">
                            <div class="card-body pt-5">

                                <!-- Kapak Görseli -->
                                <div class="mb-10 row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Kapak Görseli</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a class="uploadImage btn btn-primary text-white btn-sm">
                                                        <i class="far fa-file-image"></i> Görsel Seç
                                                    </a>
                                                    <input type="file" accept="image/jpeg,image/png,image/jpg,image/webp" name="image" class="d-none">
                                                    <a class="removeImage btn btn-danger text-white btn-sm">
                                                        <i class="fa fa-trash"></i> Kaldır
                                                    </a>
                                                    <div class="row col-md-12 thumb-output p-2">
                                                        <img class="thumb img-thumbnail" src="" style="max-height: 200px;">
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-7">Blog kapak görseli ekleyin (Önerilen boyut: 1200x800px veya dikey 900x1200px).</div>
                                    </div>
                                </div>

                                <!-- Başlık -->
                                <div class="mb-10 row">
                                    <div class="col-sm-12">
                                        <label class="required form-label">Başlık</label>
                                        <input class="form-control" name="title" value="{{ old('title') }}" placeholder="Blog başlığını girin..." required/>
                                        <div class="text-muted fs-7">Bu alan zorunludur. SEO dostu bağlantı (slug) otomatik oluşturulacaktır.</div>
                                    </div>
                                </div>

                                <!-- Kategori & Yayın Tarihi & Durum -->
                                <div class="mb-10 row">
                                    <div class="col-sm-4">
                                        <label class="form-label">Kategori</label>
                                        <input class="form-control" name="category" list="categoryList" value="{{ old('category') }}" placeholder="Kategori seçin veya yazın..."/>
                                        <datalist id="categoryList">
                                            <option value="Düğün">
                                            <option value="Kına">
                                            <option value="Nişan">
                                            <option value="Evlilik Teklifi">
                                            <option value="Kurumsal">
                                            <option value="Baby Shower">
                                            <option value="Doğum Günü">
                                            <option value="Sünnet">
                                            <option value="Açılış">
                                            <option value="Genel">
                                        </datalist>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Yayın Tarihi</label>
                                        <input type="datetime-local" class="form-control" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"/>
                                        <div class="text-muted fs-7">Boş bırakılırsa şu anki tarih kaydedilir.</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="required form-label">Durum</label>
                                        <select name="is_active" class="form-control" required>
                                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Pasif</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- İçerik -->
                                <div class="mb-10 row">
                                    <div class="col-sm-12">
                                        <label class="required form-label">İçerik</label>
                                        <textarea class="form-control ckeditors" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                                        <div class="text-muted fs-7">Blog detay içeriğini girin. Görsel ve biçimlendirme araçlarını kullanabilirsiniz.</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-light me-5">Vazgeç</a>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('') }}assets/js/admin/media.js"></script>
    <script src="{{ asset('') }}assets/plugins/custom/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('') }}assets/js/admin/ckeditor.js"></script>
@endsection
