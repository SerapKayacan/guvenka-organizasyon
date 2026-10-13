<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Artesaos\SEOTools\Facades\SEOTools;

class AboutUsController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::withCount('services')->orderBy('sort_order','ASC')->get();

        SEOTools::setTitle('Hakkımızda');
        SEOTools::setDescription('Güvenka Organizasyon hakkında bilgi alın. Düğün, kına, nişan, sünnet, doğum günü ve kurumsal etkinliklerinizde profesyonel çözümler sunuyoruz.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords(['güvenka organizasyon', 'hakkımızda', 'düğün organizasyonu', 'kına organizasyonu', 'istanbul organizasyon firması']);

        return view('frontend.about-us', [
            'serviceCategories' => $serviceCategories,
        ]);
    }
}
