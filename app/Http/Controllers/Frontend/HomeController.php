<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Service;
use App\Models\TabPanel;
use App\Models\Blog;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::where('is_active', true)->withCount('services')->orderBy('sort_order','ASC')->get();
        $carousels = Carousel::where('is_active', true)->orderBy('sort_order','ASC')->get();
        $tabPanels = TabPanel::where('is_active', true)->orderBy('sort_order','ASC')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order','ASC')->get();
        $blogs = Blog::where('is_active', true)->latest('published_at')->take(3)->get();

        SEOTools::setTitle('Ana Sayfa');
        SEOTools::setDescription('Güvenka Organizasyon olarak İstanbul\'da düğün, kına, nişan, sünnet, doğum günü, baby shower ve kurumsal etkinlikleriniz için yaratıcı ve profesyonel çözümler sunuyoruz.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords(['güvenka organizasyon', 'düğün organizasyonu', 'kına organizasyonu', 'nişan organizasyonu', 'doğum günü organizasyonu', 'sünnet organizasyonu', 'kurumsal etkinlik', 'istanbul organizasyon']);

        return view('frontend.home', [
            'serviceCategories' => $serviceCategories,
            'carousels'         => $carousels,
            'tabPanels'         => $tabPanels,
            'services'          => $services,
            'blogs'             => $blogs,
        ]);
    }

}
