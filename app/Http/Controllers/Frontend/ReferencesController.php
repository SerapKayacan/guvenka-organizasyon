<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use App\Models\Partner;
use Artesaos\SEOTools\Facades\SEOTools;

class ReferencesController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Referanslarımız');
        SEOTools::setDescription('Güvenka Organizasyon olarak başarıyla gerçekleştirdiğimiz projeler, organizasyonlar ve bize güvenen markalar.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords(['güvenka organizasyon referanslar', 'çalıştığımız kurumlar', 'etkinlik referansları']);

        $securityReferences = Reference::where('is_active', true)
            ->where('category', 'security')
            ->orderBy('sort_order')
            ->get();

        $cleaningReferences = Reference::where('is_active', true)
            ->where('category', 'cleaning')
            ->orderBy('sort_order')
            ->get();

        $partners = Partner::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.references', compact('securityReferences', 'cleaningReferences', 'partners'));
    }
}
