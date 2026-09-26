<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
</head>
<body>
    <h2>Daftar Kegiatan</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('activities.create') }}">Tambah Kegiatan Baru</a>
    </p>

    <hr>

    @forelse($activities as $activity)
        <div>
            <h3>
                <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->title }}</a>
            </h3>
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
</body>
</html>