@extends('layouts.admin')

@section('title', 'Edit Kegiatan')

@section('actions')
  <a href="{{ route('admin.activities.index') }}" class="btn-admin btn-admin-ghost">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-pen-to-square"></i>
      Edit: {{ Str::limit($activity->title, 40) }}
    </div>
    <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST"
          onsubmit="return confirm('Hapus kegiatan \'{{ addslashes($activity->title) }}\' secara permanen?')">
      @csrf @method('DELETE')
      <button type="submit" class="btn-admin btn-admin-danger">
        <i class="fa-solid fa-trash"></i> Hapus
      </button>
    </form>
  </div>
  <div class="form-card">
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="title">
            Nama Kegiatan <span class="required">*</span>
          </label>
          <input type="text" id="title" name="title" class="form-input"
            value="{{ old('title', $activity->title) }}" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="type">
            Jenis Kegiatan <span class="required">*</span>
          </label>
          <select id="type" name="type" class="form-select" required>
            @foreach(['Seminar', 'Workshop', 'Lomba / Kompetisi', 'Organisasi', 'Konferensi', 'Pelatihan', 'Volunteer', 'Lainnya'] as $type)
              <option value="{{ $type }}" {{ old('type', $activity->type) === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Deskripsi</label>
        <textarea id="description" name="description" class="form-textarea">{{ old('description', $activity->description) }}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="location">Lokasi</label>
          <input type="text" id="location" name="location" class="form-input"
            value="{{ old('location', $activity->location) }}">
        </div>
        <div class="form-group">
          <label class="form-label" for="year">
            Tahun <span class="required">*</span>
          </label>
          <input type="text" id="year" name="year" class="form-input"
            value="{{ old('year', $activity->year) }}" required>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Foto Kegiatan</label>
        @if($activity->image)
          <div style="margin-bottom:0.75rem;">
            <img src="{{ asset('uploads/'.$activity->image) }}"
              style="max-height:150px; border-radius:10px; border:1px solid var(--border);" alt="Current">
            <div class="form-hint" style="margin-top:0.4rem;">Foto saat ini. Upload baru untuk mengganti.</div>
          </div>
        @endif
        <input type="file" name="image" class="form-input" accept="image/*" onchange="previewImage(this)">
        <img id="img-preview" class="img-preview" alt="Preview">
      </div>

      <div class="form-footer" style="margin: 0 -1.75rem -1.75rem; border-radius: 0 0 var(--radius) var(--radius);">
        <span style="font-size:0.8rem;color:var(--text-dim);">
          Terakhir diupdate: {{ $activity->updated_at->format('d M Y, H:i') }}
        </span>
        <button type="submit" class="btn-admin btn-admin-primary" style="padding:0.7rem 1.75rem;">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
  const preview = document.getElementById('img-preview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => { preview.src = e.target.result; preview.classList.add('show'); };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection
