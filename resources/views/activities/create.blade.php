<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kegiatan Baru</title>
</head>
<body>
    <div style="margin: 20px;">
        <h2>Tambah Kegiatan Baru</h2>
        <form action="{{ route('activities.store') }}" method="POST">
            @include('activities._form')
        </form>
    </div>
</body>
</html>