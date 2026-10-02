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

    public function store(StoreActivityRequest $request)
    {
        $data = $request->validated();
        // Aturan Task 2: Status awal otomatis 'draft'
        $data['status'] = 'draft';

        Activity::create($data);

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dibuat sebagai draft.');
    }

    // Aksi 1: Publish (Hanya dari 'draft')
    public function publish(Activity $activity)
    {
        if ($activity->status !== 'draft') {
            return back()->withErrors(['error' => 'Hanya kegiatan berstatus draft yang dapat dipublish.']);
        }

        // Catatan BR-05: Jika ada syarat tambahan (misal wajib deskripsi), cek di sini
        $activity->update(['status' => 'published']);

        return back()->with('success', 'Kegiatan berhasil dipublish.');
    }

    // Aksi 2: Complete (Hanya dari 'published')
    public function complete(Activity $activity)
    {
        if ($activity->status !== 'published') {
            return back()->withErrors(['error' => 'Hanya kegiatan berstatus published yang dapat diselesaikan.']);
        }

        $activity->update(['status' => 'completed']);

        return back()->with('success', 'Kegiatan berhasil diselesaikan.');
    }
}