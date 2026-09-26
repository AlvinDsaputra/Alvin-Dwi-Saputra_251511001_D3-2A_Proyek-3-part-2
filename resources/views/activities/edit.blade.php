<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kegiatan</title>
</head>
<body>
    <div style="margin: 20px;">
        <h2>Edit Kegiatan</h2>
        <form action="{{ route('activities.update', $activity->id) }}" method="POST">
            @method('PUT')
            @include('activities._form', ['activity' => $activity])
        </form>
    </div>
</body>
</html>