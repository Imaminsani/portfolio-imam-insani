@extends('layouts.admin')

@section('title', 'Tambah Project Baru')

@section('actions')
  <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-admin-ghost">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-laptop-code"></i>
      Informasi Project
    </div>
  </div>
  <div class="form-card">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="title">
            Judul Project <span class="required">*</span>
          </label>
          <input type="text" id="title" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
            placeholder="Contoh: Aplikasi Kasir UMKM"
            value="{{ old('title') }}" required>
          @error('title')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="link">Link Demo / GitHub</label>
          <input type="url" id="link" name="link" class="form-input {{ $errors->has('link') ? 'is-invalid' : '' }}"
            placeholder="https://github.com/username/repo"
            value="{{ old('link') }}">
          <div class="form-hint">Opsional — link ke halaman live atau repositori.</div>
          @error('link')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">
          Deskripsi Project <span class="required">*</span>
        </label>
        <textarea id="description" name="description"
          class="form-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}"
          placeholder="Ceritakan project ini: apa fungsinya, teknologi yang digunakan, dan hasil yang dicapai..."
          required>{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="image">Gambar / Screenshot Project</label>
        <input type="file" id="image" name="image"
          class="form-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
          accept="image/*" onchange="previewImage(this)">
        <div class="form-hint"><i class="fa-regular fa-image"></i> Format JPG, PNG, atau WEBP. Maksimal 2MB. Disarankan rasio 16:9.</div>
        <img id="img-preview" class="img-preview" alt="Preview">
        @error('image')
          <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <div class="form-check-row">
          <input type="checkbox" id="is_featured" name="is_featured" value="1"
            {{ old('is_featured') ? 'checked' : '' }}>
          <label for="is_featured">
            <i class="fa-solid fa-star" style="color:var(--accent-amber);"></i>
            Jadikan sebagai <strong>Featured Project</strong> — akan tampil menonjol di portfolio
          </label>
        </div>
      </div>

      <div class="form-footer" style="margin: 0 -1.75rem -1.75rem; border-radius: 0 0 var(--radius) var(--radius);">
        <span style="font-size:0.8rem;color:var(--text-dim);">
          <i class="fa-solid fa-circle-info"></i> Fields dengan * wajib diisi
        </span>
        <button type="submit" class="btn-admin btn-admin-primary" style="padding:0.7rem 1.75rem;">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Project
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
    reader.onload = (e) => {
      preview.src = e.target.result;
      preview.classList.add('show');
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection
