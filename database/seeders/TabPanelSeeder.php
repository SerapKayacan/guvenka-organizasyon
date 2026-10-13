<?php

namespace Database\Seeders;

use App\Models\TabPanel;
use Illuminate\Database\Seeder;

class TabPanelSeeder extends Seeder
{
    public function run(): void
    {
        TabPanel::create([
            'title'      => 'Organizasyon Hizmetleri',
            'sort_order' => 1,
            'is_active'  => true,
        ]);

        TabPanel::create([
            'title'      => 'Kurumsal Etkinlik Yönetimi',
            'sort_order' => 2,
            'is_active'  => true,
        ]);
    }
}
