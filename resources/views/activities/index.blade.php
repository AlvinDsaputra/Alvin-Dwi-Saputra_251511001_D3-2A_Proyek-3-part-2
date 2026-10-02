<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan</title>
</head>
<body>
    <h2>Daftar Kegiatan</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->has('error'))
        <p style="color: red;">{{ $errors->first('error') }}</p>
    @endif

    <p><a href="{{ route('activities.create') }}">Tambah Kegiatan Baru (Draft)</a></p>

    <!-- Form Search, Filter, & Sort -->
    <form method="GET" action="{{ route('activities.index') }}" style="margin-bottom: 15px;">
        <!-- Search Code atau Title -->
        <input type="text" name="search" placeholder="Cari kode atau judul..." value="{{ request('search') }}">

        <!-- Filter Category -->
        <select name="category_id">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>

        <!-- Filter Status (draft, published, completed) -->
        <select name="status">
            <option value="">-- Semua Status --</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <!-- Sort -->
        <select name="sort">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        </select>

        <button type="submit">Cari & Filter</button>
        <a href="{{ route('activities.index') }}"><button type="button">Reset</button></a>
    </form>

    <hr>

    @forelse($activities as $activity)
        <div style="margin-bottom: 15px;">
            <h3>
                <span style="color: #666;">[{{ $activity->code }}]</span>
                <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->title }}</a>
            </h3>
            <p>Kategori: {{ $activity->category->name ?? '-' }}</p>
            <p>Tanggal: {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}</p>
            <p>Status: <strong>{{ ucfirst($activity->status) }}</strong></p>
            
            <!-- Tombol Aksi Transisi Status (Task 2) -->
            @if($activity->status === 'draft')
                <form action="{{ route('activities.publish', $activity->id) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="submit" style="background: #0d6efd; color: white;">Publish</button>
                </form>
            @elseif($activity->status === 'published')
                <form action="{{ route('activities.complete', $activity->id) }}" method="POST" style="display:inline;">
                    @csrf @method('PATCH')
                    <button type="submit" style="background: #198754; color: white;">Complete</button>
                </form>
            @endif

            <a href="{{ route('activities.edit', $activity->id) }}">Edit</a>

            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data ini?');">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Belum ada kegiatan yang sesuai.</p>
    @endforelse

    <!-- Link Pagination -->
    <div style="margin-top: 20px;">
        {{ $activities->links() }}
    </div>
</body>
</html>