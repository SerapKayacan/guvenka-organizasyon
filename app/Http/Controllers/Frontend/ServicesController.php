<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function showByCategory($slug, $view = 'frontend.services')
    {
        $serviceCategory = ServiceCategory::where('is_active', true)->where('slug', $slug)->with('services')->firstOrFail();

        SEOTools::setTitle($serviceCategory->title);
        SEOTools::setDescription($serviceCategory->meta_description ?: 'Güvenka Organizasyon ' . $serviceCategory->title . ' hizmetleri hakkında detaylı bilgi alın.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords($serviceCategory->tags->pluck('name')->toArray() ?: ['organizasyon hizmetleri', 'etkinlik yönetimi', 'güvenka organizasyon']);

        return view($view, [
            'serviceCategory' => $serviceCategory,
            'services'        => $serviceCategory->services,
        ]);
    }




}
