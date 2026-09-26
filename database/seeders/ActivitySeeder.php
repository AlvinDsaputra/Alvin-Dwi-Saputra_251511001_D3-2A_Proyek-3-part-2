<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Slicing UI Dashboard',
                'description' => 'Pengerjaan tampilan aplikasi web.',
                'activity_date' => '2026-10-15',
                'category' => 'Praktikum',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Setup Database & Migration',
                'description' => 'Membuat skema database awal.',
                'activity_date' => '2026-09-20',
                'category' => 'Tugas',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Evaluasi Modul 2 JavaScript',
                'description' => 'Review materi DOM dan Async JS.',
                'activity_date' => '2026-09-25',
                'category' => 'Evaluasi',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
