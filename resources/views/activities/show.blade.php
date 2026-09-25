<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kegiatan</title>
</head>
<body>
    <a href="{{ route('activities.index') }}">&larr; Kembali ke Daftar</a>
    <h1>{{ $activity->title }}</h1>
    <p><strong>Kategori:</strong> {{ $activity->category }}</p>
    <p><strong>Status:</strong> {{ $activity->status }}</p>
    <p><strong>Tanggal:</strong> {{ $activity->activity_date->format('d M Y') }}</p>
    <p><strong>Deskripsi:</strong> {{ $activity->description ?? '-' }}</p>
</body>
</html>