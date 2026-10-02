@csrf

<div class="mb-3">
    <label for="code" class="form-label">Kode Kegiatan</label>
    <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $activity->code ?? '') }}" required>
    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $activity->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $activity->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="activity_date" class="form-label">Tanggal Kegiatan</label>
    <input type="date" id="activity_date" name="activity_date" class="form-control @error('activity_date') is-invalid @enderror" value="{{ old('activity_date', isset($activity->activity_date) ? \Carbon\Carbon::parse($activity->activity_date)->format('Y-m-d') : '') }}" required>
    @error('activity_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<!-- Catatan: Input Dropdown Status DIHAPUS dari form ini sesuai Aturan Task 2 Point 4 -->

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>