<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'activity_date',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    } // <-- Cukup satu kurung tutup untuk method category()

    // Method scopeFilter HARUS berada di dalam class Activity
    public function scopeFilter($query, array $filters)
    {
        // 1. Search berdasarkan title
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->where('title', 'like', '%' . $search . '%');
        });

        // 2. Filter category_id
        $query->when($filters['category_id'] ?? null, function ($q, $categoryId) {
            $q->where('category_id', $categoryId);
        });

        // 3. Filter status
        $query->when($filters['status'] ?? null, function ($q, $status) {
            $q->where('status', $status);
        });

        // 4. Sort berdasarkan tanggal (terbaru/terlama)
        $query->when($filters['sort'] ?? null, function ($q, $sort) {
            if ($sort === 'oldest') {
                $q->orderBy('activity_date', 'asc');
            } else {
                $q->orderBy('activity_date', 'desc');
            }
        }, function ($q) {
            $q->orderBy('activity_date', 'desc');
        });
    }
} 