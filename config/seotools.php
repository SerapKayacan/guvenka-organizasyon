<?php

return [
    'meta' => [
        'defaults' => [
            'title'        => 'Güvenka Organizasyon',
            'titleBefore'  => false,
            'description'  => 'Güvenka Organizasyon olarak İstanbul\'da düğün, kına, nişan, sünnet, doğum günü, baby shower ve kurumsal etkinlikleriniz için profesyonel organizasyon çözümleri sunuyoruz.',
            'separator'    => ' - ',
            'keywords'     => [
                'güvenka organizasyon', 'organizasyon firması', 'düğün organizasyonu', 'kına organizasyonu',
                'nişan organizasyonu', 'sünnet organizasyonu', 'doğum günü organizasyonu', 'baby shower organizasyonu',
                'açılış organizasyonu', 'istanbul organizasyon', 'kurumsal etkinlik', 'davet organizasyonu',
                'etkinlik yönetimi', 'istanbul davet', 'özel gün organizasyonu',
            ],
            'canonical'    => 'full',
            'robots'       => 'all',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'Güvenka Organizasyon',
            'description' => 'Güvenka Organizasyon olarak İstanbul\'da düğün, kına, nişan, sünnet ve kurumsal etkinlikleriniz için profesyonel organizasyon çözümleri sunuyoruz.',
            'url'         => null,
            'type'        => false,
            'site_name'   => 'Güvenka Organizasyon',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card' => 'summary',
            'site' => '@guvenkagroup',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'Güvenka Organizasyon',
            'description' => 'Güvenka Organizasyon olarak İstanbul\'da düğün, kına, nişan, sünnet ve kurumsal etkinlikleriniz için profesyonel organizasyon çözümleri sunuyoruz.',
            'url'         => null,
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
