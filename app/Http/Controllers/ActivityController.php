<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    protected ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function index(Request $request): View
    {
        $categories = Category::all(); // Rapih: menggunakan import Category di atas

        $activities = Activity::with('category')
            ->filter($request->only(['search', 'category_id', 'status', 'sort']))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $this->activityService->createActivity($request->validated());

        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        // TAMBAHAN KRUSIAL: Ambil kategori agar dropdown di form edit tidak error
        $categories = Category::all(); 
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity
    ): RedirectResponse {
        if ($activity->status === 'Done' && $request->status === 'Planned') {
            return back()->withErrors([
                'status' => 'Status yang sudah Done tidak boleh dikembalikan ke Planned!'
            ])->withInput();
        }

        $this->activityService->updateActivity($activity, $request->validated());

        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $this->activityService->deleteActivity($activity);

        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }
}