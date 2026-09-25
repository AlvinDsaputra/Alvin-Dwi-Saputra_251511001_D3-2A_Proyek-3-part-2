<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kegiatan</title>
</head>
<body>
    <h1>Daftar Kegiatan</h1>
    @forelse ($activities as $activity)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h3>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h3>
            <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: <strong>{{ $activity->status }}</strong></p>
        </div>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
</body>
</html>