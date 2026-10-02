<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan Baru</title>
</head>
<body>
    <div style="margin: 20px; max-width: 600px;">
        <h2>Tambah Kegiatan Baru</h2>

        <p><a href="{{ route('activities.index') }}">« Kembali ke Daftar Kegiatan</a></p>

        <!-- Pesan Error Validasi (Penting agar tahu jika input salah) -->
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px 15px; margin-bottom: 20px; border-radius: 4px;">
                <strong>Gagal menyimpan data:</strong>
                <ul style="margin: 5px 0 0 20px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('activities.store') }}" method="POST">
            @csrf <!-- Wajib ada untuk keamanan submit form Laravel -->
            
            @include('activities._form')
        </form>
    </div>
</body>
</html>