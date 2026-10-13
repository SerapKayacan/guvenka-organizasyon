<?php

use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServicesCategoryController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\Frontend\ServicesDetailController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\TabPanelController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\WebhookGitHub;
use App\Http\Controllers\Frontend\ReferencesController;
use Illuminate\Support\Facades\Route;

// Frontend routes — blocked by coming soon page when COMING_SOON=true
Route::middleware(['coming.soon'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('hizmet-kategorileri')->group(function () {
        Route::get('/', [ServicesCategoryController::class, 'index'])->name('services-category.index');
    });

    Route::prefix('hizmetler')->group(function () {
        Route::get('/{slug}', [ServicesController::class, 'showByCategory'])->name('services.byCategory');
    });

    Route::prefix('hizmet-detayi')->group(function () {
        Route::get('/{slug}', [ServicesDetailController::class, 'show'])->name('services-detail.show');
    });

    Route::prefix('iletisim')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('contact.index');
        Route::post('/gonder', [ContactController::class, 'submit'])->name('contact.submit');
        Route::post('/kariyer-gonder', [ContactController::class, 'submitCv'])->name('contact.submitCv');
    });

    Route::prefix('hakkimizda')->group(function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('about-us.index');
    });

    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
    });

    Route::get('/references', [ReferencesController::class, 'index'])->name('references.index');

    Route::get('/ara', [SearchController::class, 'search'])->name('search');
});

Route::prefix('carousel')->group(function () {
    Route::get('/', [CarouselController::class, 'index'])->name('carousel.index');
    Route::get('/yeni', [CarouselController::class, 'create'])->name('carousel.create');
    Route::post('/yeni', [CarouselController::class, 'store'])->name('carousel.store');
    Route::get('/duzenle/{id}', [CarouselController::class, 'edit'])->name('carousel.edit');
    Route::put('/duzenle/{id}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::delete('/sil/{id}', [CarouselController::class, 'destroy'])->name('carousel.destroy');
});

Route::prefix('tab-panel')->group(function () {
    Route::get('/', [TabPanelController::class, 'index'])->name('tab-panel.index');
    Route::get('/yeni', [TabPanelController::class, 'create'])->name('tab-panel.create');
    Route::post('/yeni', [TabPanelController::class, 'store'])->name('tab-panel.store');
    Route::get('/duzenle/{id}', [TabPanelController::class, 'edit'])->name('tab-panel.edit');
    Route::put('/duzenle/{id}', [TabPanelController::class, 'update'])->name('tab-panel.update');
    Route::delete('/sil/{id}', [TabPanelController::class, 'destroy'])->name('tab-panel.destroy');
});

Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'loginPage'])->middleware('guest')->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('kullanici')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/yeni', [UserController::class, 'create'])->name('create');
        Route::post('/yeni', [UserController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/profil', [UserController::class, 'profile'])->name('profile');
        Route::put('/profileUpdate', [UserController::class, 'profileUpdate'])->name('profileUpdate');
    });

    Route::prefix('hizmet-kategorisi')->name('service-category.')->group(function () {
        Route::get('/', [ServiceCategoryController::class, 'index'])->name('index');
        Route::get('/yeni', [ServiceCategoryController::class, 'create'])->name('create');
        Route::post('/yeni', [ServiceCategoryController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [ServiceCategoryController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [ServiceCategoryController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [ServiceCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('hizmet')->name('service.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/yeni', [ServiceController::class, 'create'])->name('create');
        Route::post('/yeni', [ServiceController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

    Route::prefix('referans')->name('reference.')->group(function () {
        Route::get('/', [ReferenceController::class, 'index'])->name('index');
        Route::get('/yeni', [ReferenceController::class, 'create'])->name('create');
        Route::post('/yeni', [ReferenceController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [ReferenceController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [ReferenceController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [ReferenceController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('kurum')->name('partner.')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/yeni', [PartnerController::class, 'create'])->name('create');
        Route::post('/yeni', [PartnerController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [PartnerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('blog')->name('admin.blog.')->group(function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('/yeni', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/yeni', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}', [AdminBlogController::class, 'edit'])->name('edit');
        Route::put('/duzenle/{id}', [AdminBlogController::class, 'update'])->name('update');
        Route::delete('/sil/{id}', [AdminBlogController::class, 'destroy'])->name('destroy');
    });
});
