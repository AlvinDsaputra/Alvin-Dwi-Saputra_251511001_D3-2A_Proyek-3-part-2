<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sampah Kegiatan (Trash)</title>
</head>
<body>
    <h2>Daftar Kegiatan Terhapus (Trash)</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('activities.index') }}">← Kembali ke Daftar Utama</a></p>
    <hr>

    @forelse($activities as $activity)
        <div style="margin-bottom: 15px;">
            <h3>[{{ $activity->code }}] {{ $activity->title }}</h3>
            <p>Kategori: {{ $activity->category->name ?? '-' }}</p>
            <p>Dihapus pada: {{ $activity->deleted_at->format('d M Y H:i') }}</p>
            
            <form action="{{ route('activities.restore', $activity->id) }}" method="POST" style="display:inline;">
                @csrf @method('PATCH')
                <button type="submit" style="background: #198754; color: white;">Restore (Pulihkan)</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Tidak ada kegiatan di dalam sampah.</p>
    @endforelse

    <div style="margin-top: 20px;">
        {{ $activities->links() }}
    </div>
</body>
</html>