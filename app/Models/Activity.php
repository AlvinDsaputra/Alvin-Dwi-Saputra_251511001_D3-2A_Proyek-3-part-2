<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'activity_date',
        'status',
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('code', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            });
        });

        // 2. Filter berdasarkan category_id
        $query->when($filters['category_id'] ?? null, function ($q, $categoryId) {
            $q->where('category_id', $categoryId);
        });

        // 3. Filter berdasarkan status
        $query->when($filters['status'] ?? null, function ($q, $status) {
            $q->where('status', $status);
        });

        // 4. Sort berdasarkan tanggal (start_at / activity_date)
        $query->when($filters['sort'] ?? 'latest', function ($q, $sort) {
            $dateColumn = 'activity_date'; // ganti ke 'start_at' jika nama kolommu start_at
            if ($sort === 'oldest') {
                $q->orderBy($dateColumn, 'asc');
            } else {
                $q->orderBy($dateColumn, 'desc');
            }
        });
    }
}