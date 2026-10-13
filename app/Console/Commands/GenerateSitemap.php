<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    public function handle()
    {
        // The Crawler
        SitemapGenerator::create(config('app.url') ?: 'https://www.guvenkagroup.com')
            ->hasCrawled(function (Url $url) {
                // Some logic here
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
