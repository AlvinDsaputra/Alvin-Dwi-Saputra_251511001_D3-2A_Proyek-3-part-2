namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Menggunakan scopeFilter & Pagination 10 item dengan Query String
        $activities = Activity::with('category')
            ->filter($request->only(['search', 'category_id', 'status', 'sort']))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request)
    {
        $data = $request->validated();
        // Aturan Task 2: Status awal otomatis 'draft'
        $data['status'] = 'draft';

        Activity::create($data);

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dibuat sebagai draft.');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $categories = Category::all();
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated());

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // Task 3: Soft Delete
    public function destroy(Activity $activity)
    {
        $activity->delete(); // Mengisi kolom deleted_at

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dipindahkan ke sampah (Soft Delete).');
    }

    // Task 3: Menampilkan Halaman Trash
    public function trash()
    {
        $activities = Activity::onlyTrashed()->with('category')->paginate(10);

        return view('activities.trash', compact('activities'));
    }

    // Task 3: Aksi Restore
    public function restore($id)
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->restore(); // Mengosongkan kolom deleted_at

        return redirect()->route('activities.trash')->with('success', 'Kegiatan berhasil dikembalikan.');
    }

    // Task 2: Aksi Publish (Hanya dari 'draft')
    public function publish(Activity $activity)
    {
        if ($activity->status !== 'draft') {
            return back()->withErrors(['error' => 'Hanya kegiatan berstatus draft yang dapat dipublish.']);
        }

        $activity->update(['status' => 'published']);

        return back()->with('success', 'Kegiatan berhasil dipublish.');
    }

    // Task 2: Aksi Complete (Hanya dari 'published')
    public function complete(Activity $activity)
    {
        if ($activity->status !== 'published') {
            return back()->withErrors(['error' => 'Hanya kegiatan berstatus published yang dapat diselesaikan.']);
        }

        $activity->update(['status' => 'completed']);

        return back()->with('success', 'Kegiatan berhasil diselesaikan.');
    }
}