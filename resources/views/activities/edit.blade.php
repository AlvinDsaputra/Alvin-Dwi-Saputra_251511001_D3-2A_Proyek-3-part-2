<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4" style="max-width: 600px;">
        <h2>Edit Kegiatan</h2>

        <p><a href="{{ route('activities.index') }}" class="text-decoration-none">« Kembali ke Daftar Kegiatan</a></p>

        <!-- Pesan Error Validasi Utama -->
        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <strong>Gagal memperbarui data:</strong>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('activities.update', $activity->id) }}" method="POST">
            @method('PUT')
            
            @include('activities._form', ['activity' => $activity])
        </form>
    </div>
</body>
</html>