<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>

    <style>
        /* Mengontrol ukuran panah SVG agar proporsional */
        nav svg {
            width: 16px !important;
            height: 16px !important;
            vertical-align: middle;
        }

        /* Merapikan tampilan link pagination */
        nav div {
            display: inline-block;
        }

        nav a, nav span {
            padding: 6px 12px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h2>Daftar Kegiatan</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('activities.create') }}">Tambah Kegiatan Baru</a>
    </p>

    <!-- Form Search, Filter, & Sort (Eksperimen 3) -->
    <form method="GET" action="{{ route('activities.index') }}" style="margin-bottom: 15px;">
        <!-- Search Title -->
        <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}">

        <!-- Filter Category -->
        <select name="category_id">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <!-- Filter Status -->
        <select name="status">
            <option value="">-- Semua Status --</option>
            <option value="Planned" {{ request('status') == 'Planned' ? 'selected' : '' }}>Planned</option>
            <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
            <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
        </select>

        <!-- Sorting -->
        <select name="sort">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        </select>

        <button type="submit">Cari & Filter</button>
        <a href="{{ route('activities.index') }}"><button type="button">Reset</button></a>
    </form>

    <hr>

    @forelse($activities as $activity)
        <div>
            <h3>
                <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->title }}</a>
            </h3>
            <p>Kategori: {{ $activity->category->name ?? '-' }}</p>
            <p>Tanggal: {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}</p>
            <p>Status: <strong>{{ $activity->status }}</strong></p>
            
            <a href="{{ route('activities.edit', $activity->id) }}">Edit</a>

            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse

    <!-- Link Navigasi Pagination -->
    <div style="margin-top: 20px;">
        <!-- Pagination Custom Ringkas & Bersih -->
<div style="margin-top: 25px; text-align: center; font-family: sans-serif;">
    @if ($activities->onFirstPage())
        <span style="color: #aaa; margin-right: 15px;">« Previous</span>
    @else
        <a href="{{ $activities->previousPageUrl() }}" style="margin-right: 15px; font-weight: bold; text-decoration: none; color: #007bff;">« Previous</a>
    @endif

    <span style="margin: 0 10px;">
        Halaman <strong>{{ $activities->currentPage() }}</strong> dari <strong>{{ $activities->lastPage() }}</strong>
    </span>

    @if ($activities->hasMorePages())
        <a href="{{ $activities->nextPageUrl() }}" style="margin-left: 15px; font-weight: bold; text-decoration: none; color: #007bff;">Next »</a>
    @else
        <span style="color: #aaa; margin-left: 15px;">Next »</span>
    @endif
</div>
    </div>
</body>
</html>