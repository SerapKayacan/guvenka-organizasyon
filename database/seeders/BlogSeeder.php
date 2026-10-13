<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'title' => 'Düğün Organizasyonunda Yeni Trendler 2026',
                'category' => 'Düğün',
                'content' => '<p>2026 sezonunda düğün organizasyonlarında minimal ve doğa ile iç içe konseptler ön plana çıkıyor. Güvenka Organizasyon olarak, hayalinizdeki düğünü gerçeğe dönüştürürken en modern trendleri takip ediyoruz. Sade detaylarla zenginleştirilmiş, misafirlerinizin unutamayacağı bir etkinlik hazırlamak bizim işimiz.</p>',
                'image' => 'assets/frontend/images/post1.jpg',
            ],
            [
                'title' => 'Romantik ve Unutulmaz: Sürpriz Evlilik Teklifi Fikirleri',
                'category' => 'Evlilik Teklifi',
                'content' => '<p>Hayatınızın en özel sorusunu sorarken sıradanlıktan uzaklaşmak ister misiniz? Boğazda özel bir yatta mı yoksa doğanın ortasında romantik bir çadır konseptinde mi? En iyi evlilik teklifi organizasyon fikirlerini sizinle paylaşıyoruz. Bizimle birlikte detayları planlayarak “Evet!” cevabını garantiye alın.</p>',
                'image' => 'assets/frontend/images/post2.jpg',
            ],
            [
                'title' => 'Kurumsal Açılış Organizasyonlarının Püf Noktaları',
                'category' => 'Kurumsal',
                'content' => '<p>İşletmenizin açılış günü, müşterileriniz üzerindeki ilk ve en önemli izlenimdir. Başarılı bir açılış organizasyonu için gereken dikkat çekici konseptler, profesyonel hostes destekleri ve müzik gruplarının öneminden bahsediyoruz. Güvenka Organizasyon güvencesiyle markanızı öne çıkarın.</p>',
                'image' => 'assets/frontend/images/post3.jpg',
            ],
            [
                'title' => 'Gelenekselden Moderne: Mükemmel Kına Gecesi',
                'category' => 'Kına',
                'content' => '<p>Kına geceleri, geleneklerimizin en güzel yansımalarındandır. Ancak bu geleneği modern dokunuşlarla çok daha eğlenceli hale getirebiliriz. Zarif bindallılar, şık tahtlar ve özel gösterilerle misafirlerinize unutulmaz bir gece yaşatın. En özel kına gecesi detaylarını burada bulabilirsiniz.</p>',
                'image' => 'assets/frontend/images/post4.jpg',
            ],
            [
                'title' => 'Baby Shower Davetleri İçin Konsept Önerileri',
                'category' => 'Baby Shower',
                'content' => '<p>Anne adaylarının heyecanını sevdikleriyle paylaştığı Baby Shower etkinliklerinde hangi temaları seçmelisiniz? Renkli balonlar, tatlı masaları ve özel hediyeliklerle sevimli ve sıcak bir ortam yaratmanın ipuçlarını keşfedin. Güvenka Organizasyon, sizin için en tatlı konseptleri hayata geçiriyor.</p>',
                'image' => 'assets/frontend/images/post5.jpg',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create([
                'title'        => $blog['title'],
                'slug'         => Str::slug($blog['title']),
                'category'     => $blog['category'],
                'content'      => $blog['content'],
                'image'        => $blog['image'],
                'is_active'    => true,
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
