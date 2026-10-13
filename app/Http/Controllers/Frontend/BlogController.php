<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        SEOTools::setTitle('Blog & Etkinlikler');
        SEOTools::setDescription('Güvenka Organizasyon blog yazıları. Düğün, kına, nişan, evlilik teklifi ve organizasyon dünyasından en son trendler, konsept önerileri ve ilham verici fikirler.');
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::metatags()->setKeywords(['güvenka organizasyon blog', 'organizasyon trendleri', 'düğün fikirleri', 'kına konseptleri']);

        // 9 items per page fits most grid layouts nicely
        $blogs = Blog::where('is_active', true)->latest('published_at')->paginate(9);
        return view('frontend.blog.index', compact('blogs'));
    }

    /**
     * Display the specified blog.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_active', true)->firstOrFail();

        SEOTools::setTitle($blog->title);
        SEOTools::setDescription(Str::limit(strip_tags($blog->content), 160));
        SEOTools::opengraph()->addProperty('type', 'article');
        if ($blog->image) {
            SEOTools::addImages(asset($blog->image));
        }
        
        // Fetch recent blogs for the sidebar or related posts
        $recentBlogs = Blog::where('is_active', true)
                           ->where('id', '!=', $blog->id)
                           ->latest('published_at')
                           ->take(5)
                           ->get();

        return view('frontend.blog.show', compact('blog', 'recentBlogs'));
    }
}
