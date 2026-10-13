<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        ServiceCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $category = ServiceCategory::create([
            'title' => 'Organizasyon Hizmetleri',
            'slug' => 'organizasyon-hizmetleri',
            'is_active' => true,
            'sort_order' => 1
        ]);

        $services = [
            [
                'title' => 'Açılış Organizasyonu',
                'image' => 'assets/frontend/images/opening.jpeg',
                'summary' => 'İşletmenizin açılışını unutulmaz bir etkinliğe dönüştürüyor, konsept ve dekorasyondan tüm organizasyon detaylarına kadar profesyonel çözümler sunuyoruz.'
            ],
            [
                'title' => 'Baby Shower Organizasyonu',
                'image' => 'assets/frontend/images/babyshower.jpg',
                'summary' => 'Anne ve bebeğin bu özel gününü özenle hazırlanan konsept, dekorasyon ve eğlenceli detaylarla unutulmaz bir kutlamaya dönüştürüyoruz.'
            ],
            [
                'title' => 'Doğum Günü Organizasyonu',
                'image' => 'assets/frontend/images/birthday.jpg',
                'summary' => 'Her yaşa ve konsepte uygun doğum günü organizasyonları hazırlıyor, özel gününüzü eğlenceli ve unutulmaz anlara dönüştürüyoruz.'
            ],
            [
                'title' => 'Düğün Organizasyonu',
                'image' => 'assets/frontend/images/wedding.jpg',
                'summary' => 'Hayalinizdeki düğünü gerçeğe dönüştürüyor, dekorasyon, konsept ve organizasyonun tüm detaylarını sizin için planlıyoruz.'
            ],
            [
                'title' => 'Sürpriz Evlilik Teklifi',
                'image' => 'assets/frontend/images/mariageproposal.jpg',
                'summary' => 'Hayatınızın en özel sorusunu unutulmaz bir ana dönüştürüyor, romantik konseptler ve sürpriz detaylarla yanınızda oluyoruz.'
            ],
            [
                'title' => 'Kına Organizasyonu',
                'image' => 'assets/frontend/images/henna.jpg',
                'summary' => 'Geleneksel kına gecelerini modern ve şık konseptlerle buluşturuyor, gecenizin her detayını özenle planlıyoruz.'
            ],
            [
                'title' => 'Nişan Organizasyonu',
                'image' => 'assets/frontend/images/engagement.jpg',
                'summary' => 'Nişan gününüz için zarif ve şık konseptler hazırlıyor, mekan dekorasyonundan masa düzenine kadar tüm detayları planlıyoruz.'
            ],
            [
                'title' => 'Sünnet Organizasyonu',
                'image' => 'assets/frontend/images/circumcision.jpg',
                'summary' => 'Çocuğunuzun bu özel gününü eğlenceli ve renkli konseptlerle planlıyor, unutulmaz bir sünnet organizasyonu gerçekleştiriyoruz.'
            ],
            [
                'title' => 'Fuar Organizasyonu',
                'image' => 'assets/frontend/images/fair.jpg',
                'summary' => 'Markanızı en iyi şekilde yansıtacak fuar organizasyonları hazırlıyor, stand tasarımı ve etkinlik süreçlerinde profesyonel destek sunuyoruz.'
            ],
        ];

        foreach ($services as $index => $s) {
            Service::create([
                'category_id' => $category->id,
                'title' => $s['title'],
                'slug' => Str::slug($s['title']),
                'sort_detail' => $s['summary'],
                'detail' => '<p>' . $s['summary'] . '</p><p>Güvenka Organizasyon olarak en yüksek kaliteyi sunmayı hedefliyoruz. Bize ulaşarak detaylı fiyat teklifi alabilirsiniz.</p>',
                'is_active' => true,
                'sort_order' => $index + 1
            ]);
            // Notice: Image needs to be saved to spatie media library or a custom column.
            // Since Service has 'hasMedia' in ServicesDetailController, it's Spatie. We can skip associating media for the seeder to save complexity and just use the static image on the frontend if needed, OR we can add a 'image' column in frontend loop if we map it manually. Wait, in home.blade.php I'll just map slug to image for simplicity, or we can use the db image logic if we add it. 
        }
    }
}
