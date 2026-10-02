<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Activity;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $cat1 = Category::firstOrCreate(
            ['name' => 'Workshop'],
            ['slug' => Str::slug('Workshop')]
        );

        $cat2 = Category::firstOrCreate(
            ['name' => 'Seminar'],
            ['slug' => Str::slug('Seminar')]
        );

        $activities = [
            ['category_id' => $cat1->id, 'title' => 'Workshop Dasar Laravel 11', 'description' => 'Mempelajari routing dan controller', 'activity_date' => '2026-10-01', 'status' => 'Planned'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Eloquent Relational', 'description' => 'Materi foreign key dan belongsTo', 'activity_date' => '2026-10-02', 'status' => 'Ongoing'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Form Request Validation', 'description' => 'Membuat aturan validasi kustom', 'activity_date' => '2026-10-03', 'status' => 'Done'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Slicing UI CSS', 'description' => 'Membuat tampilan web responsif', 'activity_date' => '2026-10-04', 'status' => 'Planned'],
            ['category_id' => $cat1->id, 'title' => 'Workshop RESTful API Basics', 'description' => 'Pengenalan endpoint JSON', 'activity_date' => '2026-10-05', 'status' => 'Ongoing'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Automation Testing', 'description' => 'Pengujian otomatis dengan PHPUnit', 'activity_date' => '2026-10-06', 'status' => 'Done'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Migration & Seeder', 'description' => 'Kelola struktur database', 'activity_date' => '2026-10-07', 'status' => 'Planned'],
            ['category_id' => $cat1->id, 'title' => 'Workshop Git & GitHub Workflow', 'description' => 'Manajemen branch dan merge', 'activity_date' => '2026-10-08', 'status' => 'Done'],

            ['category_id' => $cat2->id, 'title' => 'Seminar Karir Web Developer', 'description' => 'Peluang industri software dev', 'activity_date' => '2026-10-09', 'status' => 'Planned'],
            ['category_id' => $cat2->id, 'title' => 'Seminar Artificial Intelligence', 'description' => 'Integrasi AI pada aplikasi web', 'activity_date' => '2026-10-10', 'status' => 'Ongoing'],
            ['category_id' => $cat2->id, 'title' => 'Seminar Cybersecurity Basic', 'description' => 'Pencegahan SQL Injection & XSS', 'activity_date' => '2026-10-11', 'status' => 'Done'],
            ['category_id' => $cat2->id, 'title' => 'Seminar Cloud & DevOps', 'description' => 'Pengenalan Docker dan deployment', 'activity_date' => '2026-10-12', 'status' => 'Planned'],
            ['category_id' => $cat2->id, 'title' => 'Seminar Clean Code SOLID', 'description' => 'Penulisan kode yang mudah dirawat', 'activity_date' => '2026-10-13', 'status' => 'Ongoing'],
            ['category_id' => $cat2->id, 'title' => 'Seminar UI/UX Design System', 'description' => 'Prinsip antarmuka ramah pengguna', 'activity_date' => '2026-10-14', 'status' => 'Done'],
            ['category_id' => $cat2->id, 'title' => 'Seminar Optimasi Database', 'description' => 'Mencegah masalah N+1 query', 'activity_date' => '2026-10-15', 'status' => 'Planned'],
        ];

        foreach ($activities as $act) {
            $act['category'] = Category::find($act['category_id'])->name ?? 'Umum';
            Activity::create($act);
        }
    }
}