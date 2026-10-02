@csrf

<!-- 1. Kode Kegiatan -->
<div class="mb-3">
    <label for="code" class="form-label">Kode Kegiatan</label>
    <input
        type="text"
        id="code"
        name="code"
        class="form-control @error('code') is-invalid @enderror"
        value="{{ old('code', $activity->code ?? '') }}"
        placeholder="Contoh: ACT-001"
    >
    @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- 2. Judul Kegiatan -->
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

<!-- 3. Tanggal Kegiatan -->
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

<!-- 4. Kategori (Relasi Category) -->
<div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select 
        name="category_id" 
        id="category_id" 
        class="form-select @error('category_id') is-invalid @enderror"
    >
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
            <option 
                value="{{ $category->id }}" 
                {{ old('category_id', $activity->category_id ?? '') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- 5. Status -->
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
        <option value="">-- Pilih Status --</option>
        @foreach(['Planned', 'Ongoing', 'Completed', 'Cancelled'] as $statusOption)
            <option value="{{ $statusOption }}" {{ old('status', $activity->status ?? '') == $statusOption ? 'selected' : '' }}>
                {{ $statusOption }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- 6. Deskripsi -->
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