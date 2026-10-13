<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class ServicesCategoryController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::with('services')->where('is_active', true)->orderBy('sort_order', 'ASC')->get();

        SEOTools::setTitle('Hizmetlerimiz');
        SEOTools::setDescription('Güvenka Organizasyon etkinlik ve davet yönetimi kategorileri. Düğün, nişan, kına, açılış, doğum günü ve kurumsal organizasyon çözümleri.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords(['organizasyon hizmetleri', 'düğün organizasyonu', 'kına organizasyonu', 'nişan organizasyonu', 'açılış organizasyonu', 'güvenka organizasyon']);

        return view('frontend.services-category', [
            'serviceCategories' => $serviceCategories,
        ]);

    }

}
