<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Stop-words to filter when multiple search words are present.
     */
    protected array $stopWords = [
        've', 'ile', 'veya', 'de', 'da', 'bir', 'icin', 'için', 'en', 'gibi',
        'bu', 'şu', 'o', 'mi', 'mı', 'mu', 'mü', 'ne', 'göre', 'kadar', 'olan'
    ];

    public function search(Request $request)
    {
        $rawQuery = trim((string) $request->input('query', ''));

        SEOTools::setTitle($rawQuery !== '' ? 'Arama: ' . $rawQuery . ' - Güvenka Organizasyon' : 'Arama - Güvenka Organizasyon');
        SEOTools::setDescription('Güvenka Organizasyon arama sonuçları' . ($rawQuery !== '' ? ': ' . $rawQuery : '.'));
        SEOTools::opengraph()->addProperty('type', 'website');

        if ($rawQuery === '') {
            return view('frontend.search-result', [
                'query'        => '',
                'words'        => [],
                'services'     => collect(),
                'blogs'        => collect(),
                'categories'   => collect(),
                'totalResults' => 0,
            ]);
        }

        // Tokenize search query into words
        $words = $this->extractWords($rawQuery);

        if (empty($words)) {
            return view('frontend.search-result', [
                'query'        => $rawQuery,
                'words'        => [],
                'services'     => collect(),
                'blogs'        => collect(),
                'categories'   => collect(),
                'totalResults' => 0,
            ]);
        }

        // 1. SERVICES SEARCH
        $services = Service::where('is_active', true)
            ->where(function ($queryBuilder) use ($words) {
                foreach ($words as $word) {
                    $variants = $this->getWordVariants($word);
                    $queryBuilder->orWhere(function ($subQ) use ($variants) {
                        foreach ($variants as $variant) {
                            $subQ->orWhere('title', 'LIKE', "%{$variant}%")
                                 ->orWhere('detail', 'LIKE', "%{$variant}%")
                                 ->orWhere('sort_detail', 'LIKE', "%{$variant}%")
                                 ->orWhere('category_page_detail', 'LIKE', "%{$variant}%")
                                 ->orWhere('meta_description', 'LIKE', "%{$variant}%")
                                 ->orWhereHas('tags', function ($tq) use ($variant) {
                                     $tq->where('name', 'LIKE', "%{$variant}%");
                                 })
                                 ->orWhereHas('getCategory', function ($cq) use ($variant) {
                                     $cq->where('title', 'LIKE', "%{$variant}%");
                                 });
                        }
                    });
                }
            })
            ->with(['getCategory', 'tags'])
            ->get();

        // Rank services by relevance
        $services = $services->sortByDesc(function ($service) use ($words, $rawQuery) {
            return $this->calculateServiceRelevance($service, $words, $rawQuery);
        })->values();

        // 2. BLOG SEARCH
        $blogs = Blog::where('is_active', true)
            ->where(function ($queryBuilder) use ($words) {
                foreach ($words as $word) {
                    $variants = $this->getWordVariants($word);
                    $queryBuilder->orWhere(function ($subQ) use ($variants) {
                        foreach ($variants as $variant) {
                            $subQ->orWhere('title', 'LIKE', "%{$variant}%")
                                 ->orWhere('category', 'LIKE', "%{$variant}%")
                                 ->orWhere('content', 'LIKE', "%{$variant}%");
                        }
                    });
                }
            })
            ->latest('published_at')
            ->get();

        // Rank blogs by relevance
        $blogs = $blogs->sortByDesc(function ($blog) use ($words, $rawQuery) {
            return $this->calculateBlogRelevance($blog, $words, $rawQuery);
        })->values();

        // 3. CATEGORIES SEARCH
        $categories = ServiceCategory::where('is_active', true)
            ->where(function ($queryBuilder) use ($words) {
                foreach ($words as $word) {
                    $variants = $this->getWordVariants($word);
                    $queryBuilder->orWhere(function ($subQ) use ($variants) {
                        foreach ($variants as $variant) {
                            $subQ->orWhere('title', 'LIKE', "%{$variant}%")
                                 ->orWhere('description', 'LIKE', "%{$variant}%");
                        }
                    });
                }
            })
            ->with('services')
            ->get();

        $totalResults = $services->count() + $blogs->count();

        return view('frontend.search-result', [
            'query'        => $rawQuery,
            'words'        => $words,
            'services'     => $services,
            'blogs'        => $blogs,
            'categories'   => $categories,
            'totalResults' => $totalResults,
        ]);
    }

    /**
     * Extract clean words from query.
     */
    protected function extractWords(string $query): array
    {
        $cleaned = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $query);
        $rawWords = preg_split('/\s+/u', mb_strtolower($cleaned, 'UTF-8'), -1, PREG_SPLIT_NO_EMPTY);

        $words = array_values(array_filter($rawWords, function ($w) {
            return mb_strlen($w, 'UTF-8') >= 2;
        }));

        // Filter stop words if multiple words exist
        if (count($words) > 1) {
            $filtered = array_values(array_filter($words, function ($w) {
                return !in_array($w, $this->stopWords, true);
            }));
            if (!empty($filtered)) {
                $words = $filtered;
            }
        }

        return array_unique($words);
    }

    /**
     * Generate spelling variants for Turkish characters and ASCII alternatives.
     */
    protected function getWordVariants(string $word): array
    {
        $variants = [$word];

        $trToAscii = [
            'ç' => 'c', 'Ç' => 'c',
            'ğ' => 'g', 'Ğ' => 'g',
            'ı' => 'i', 'I' => 'i', 'İ' => 'i',
            'ö' => 'o', 'Ö' => 'o',
            'ş' => 's', 'Ş' => 's',
            'ü' => 'u', 'Ü' => 'u',
        ];

        $ascii = strtr($word, $trToAscii);
        if ($ascii !== $word) {
            $variants[] = $ascii;
        }

        $commonMap = [
            'dugun'         => 'düğün',
            'kina'          => 'kına',
            'nisan'         => 'nişan',
            'sunnet'        => 'sünnet',
            'acilis'        => 'açılış',
            'dogum'         => 'doğum',
            'gunu'          => 'günü',
            'surpriz'       => 'sürpriz',
            'fuar'          => 'fuar',
            'bebek'         => 'baby',
            'organizasyon'  => 'organizasyonu',
            'organizasyonu' => 'organizasyon',
        ];

        if (isset($commonMap[$ascii])) {
            $variants[] = $commonMap[$ascii];
        }

        return array_unique($variants);
    }

    /**
     * Calculate relevance score for service.
     */
    protected function calculateServiceRelevance(Service $service, array $words, string $rawQuery): int
    {
        $score = 0;
        $lowerTitle = mb_strtolower($service->title ?? '', 'UTF-8');
        $lowerRaw = mb_strtolower($rawQuery, 'UTF-8');

        // Exact match of full phrase in title
        if (str_contains($lowerTitle, $lowerRaw)) {
            $score += 150;
        }

        $categoryTitle = mb_strtolower($service->getCategory->title ?? '', 'UTF-8');
        $sortDetail = mb_strtolower($service->sort_detail ?? '', 'UTF-8');
        $detail = mb_strtolower(strip_tags($service->detail ?? ''), 'UTF-8');
        $categoryDetail = mb_strtolower(strip_tags($service->category_page_detail ?? ''), 'UTF-8');

        $matchedWordsCount = 0;

        foreach ($words as $word) {
            $variants = $this->getWordVariants($word);
            $wordHit = false;

            foreach ($variants as $v) {
                $lv = mb_strtolower($v, 'UTF-8');

                if (str_contains($lowerTitle, $lv)) {
                    $score += 40;
                    $wordHit = true;
                }
                if (str_contains($sortDetail, $lv)) {
                    $score += 20;
                    $wordHit = true;
                }
                if (str_contains($categoryTitle, $lv)) {
                    $score += 15;
                    $wordHit = true;
                }
                if (str_contains($categoryDetail, $lv) || str_contains($detail, $lv)) {
                    $score += 10;
                    $wordHit = true;
                }
            }

            if ($wordHit) {
                $matchedWordsCount++;
            }
        }

        // Bonus if ALL words matched
        if ($matchedWordsCount === count($words) && count($words) > 1) {
            $score += 80;
        }

        return $score;
    }

    /**
     * Calculate relevance score for blog post.
     */
    protected function calculateBlogRelevance(Blog $blog, array $words, string $rawQuery): int
    {
        $score = 0;
        $lowerTitle = mb_strtolower($blog->title ?? '', 'UTF-8');
        $lowerRaw = mb_strtolower($rawQuery, 'UTF-8');

        if (str_contains($lowerTitle, $lowerRaw)) {
            $score += 150;
        }

        $category = mb_strtolower($blog->category ?? '', 'UTF-8');
        $content = mb_strtolower(strip_tags($blog->content ?? ''), 'UTF-8');

        $matchedWordsCount = 0;

        foreach ($words as $word) {
            $variants = $this->getWordVariants($word);
            $wordHit = false;

            foreach ($variants as $v) {
                $lv = mb_strtolower($v, 'UTF-8');

                if (str_contains($lowerTitle, $lv)) {
                    $score += 40;
                    $wordHit = true;
                }
                if (str_contains($category, $lv)) {
                    $score += 20;
                    $wordHit = true;
                }
                if (str_contains($content, $lv)) {
                    $score += 10;
                    $wordHit = true;
                }
            }

            if ($wordHit) {
                $matchedWordsCount++;
            }
        }

        if ($matchedWordsCount === count($words) && count($words) > 1) {
            $score += 80;
        }

        return $score;
    }
}

