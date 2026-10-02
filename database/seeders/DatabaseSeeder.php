<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori Dasar
        $cat1 = Category::firstOrCreate(['name' => 'Tugas', 'slug' => 'tugas']);
        $cat2 = Category::firstOrCreate(['name' => 'Workshop', 'slug' => 'workshop']);
        $cat3 = Category::firstOrCreate(['name' => 'Seminar', 'slug' => 'seminar']);

        // 2. Buat Data Kegiatan Contoh
        for ($i = 1; $i <= 10; $i++) {
            Activity::create([
                'category_id'   => $i % 2 == 0 ? $cat1->id : $cat2->id,
                'title'         => "Kegiatan Contoh Ke-$i",
                'description'   => "Deskripsi contoh untuk kegiatan ke-$i",
                'activity_date' => now()->subDays(10 - $i)->format('Y-m-d'),
                'status'        => $i % 3 == 0 ? 'Done' : ($i % 2 == 0 ? 'Ongoing' : 'Planned'),
            ]);
        }
    }
}