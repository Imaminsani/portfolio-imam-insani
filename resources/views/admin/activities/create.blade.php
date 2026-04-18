@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')

@section('actions')
  <a href="{{ route('admin.activities.index') }}" class="btn-admin btn-admin-ghost">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-calendar-plus"></i>
      Informasi Kegiatan
    </div>
  </div>
  <div class="form-card">
    <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="title">
            Nama Kegiatan <span class="required">*</span>
          </label>
          <input type="text" id="title" name="title"
            class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
            placeholder="Contoh: Seminar Nasional Teknologi 2024"
            value="{{ old('title') }}" required>
          @error('title')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="type">
            Jenis Kegiatan <span class="required">*</span>
          </label>
          <select id="type" name="type" class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}" required>
            <option value="" disabled selected>— Pilih Jenis —</option>
            @foreach(['Seminar', 'Workshop', 'Lomba / Kompetisi', 'Organisasi', 'Konferensi', 'Pelatihan', 'Volunteer', 'Lainnya'] as $type)
              <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
          </select>
          @error('type')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Deskripsi Kegiatan</label>
        <textarea id="description" name="description" class="form-textarea"
          placeholder="Ceritakan kegiatan ini: apa yang Anda lakukan, apa yang Anda pelajari...">{{ old('description') }}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="location">Lokasi</label>
          <input type="text" id="location" name="location" class="form-input"
            placeholder="Contoh: Jakarta, Online, Bandung..."
            value="{{ old('location') }}">
        </div>
        <div class="form-group">
          <label class="form-label" for="year">
            Tahun <span class="required">*</span>
          </label>
          <input type="text" id="year" name="year"
            class="form-input {{ $errors->has('year') ? 'is-invalid' : '' }}"
            placeholder="{{ date('Y') }}" value="{{ old('year') }}" required>
          @error('year')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="image">Foto Kegiatan</label>
        <input type="file" id="image" name="image" class="form-input" accept="image/*" onchange="previewImage(this)">
        <div class="form-hint"><i class="fa-regular fa-image"></i> Format JPG, PNG, atau WEBP. Maksimal 2MB.</div>
        <img id="img-preview" class="img-preview" alt="Preview">
        @error('image')
          <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
      </div>

      <div class="form-footer" style="margin: 0 -1.75rem -1.75rem; border-radius: 0 0 var(--radius) var(--radius);">
        <span style="font-size:0.8rem;color:var(--text-dim);">
          <i class="fa-solid fa-circle-info"></i> Fields dengan * wajib diisi
        </span>
        <button type="submit" class="btn-admin btn-admin-primary" style="padding:0.7rem 1.75rem;">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Kegiatan
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
