@csrf

<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input
        type="text"
        id="title"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $activity->title ?? '') }}"
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="activity_date" class="form-label">Tanggal Kegiatan</label>
    <input
        type="date"
        id="activity_date"
        name="activity_date"
        class="form-control @error('activity_date') is-invalid @enderror"
        value="{{ old('activity_date', isset($activity->activity_date) ? \Carbon\Carbon::parse($activity->activity_date)->format('Y-m-d') : '') }}"
    >
    @error('activity_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category" class="form-label">Kategori</label>
    <input
        type="text"
        id="category"
        name="category"
        class="form-control @error('category') is-invalid @enderror"
        value="{{ old('category', $activity->category ?? '') }}"
    >
    @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
        <option value="">-- Pilih Status --</option>
        @foreach(['Planned', 'Ongoing', 'Done'] as $statusOption)
            <option value="{{ $statusOption }}" {{ old('status', $activity->status ?? '') == $statusOption ? 'selected' : '' }}>
                {{ $statusOption }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea
        id="description"
        name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="3"
    >{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>