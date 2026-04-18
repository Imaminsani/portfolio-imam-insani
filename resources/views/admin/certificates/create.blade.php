@extends('layouts.admin')

@section('title', 'Tambah Sertifikat')

@section('actions')
  <a href="{{ route('admin.certificates.index') }}" class="btn-admin btn-admin-ghost">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-award"></i>
      Informasi Sertifikat
    </div>
  </div>
  <div class="form-card">
    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="title">
            Nama Sertifikat <span class="required">*</span>
          </label>
          <input type="text" id="title" name="title"
            class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
            placeholder="Contoh: Google IT Support Professional Certificate"
            value="{{ old('title') }}" required>
          @error('title')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="issuer">
            Diterbitkan Oleh <span class="required">*</span>
          </label>
          <input type="text" id="issuer" name="issuer"
            class="form-input {{ $errors->has('issuer') ? 'is-invalid' : '' }}"
            placeholder="Contoh: Google, Dicoding, Coursera..."
            value="{{ old('issuer') }}" required>
          @error('issuer')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="year">
            Tahun Diperoleh <span class="required">*</span>
          </label>
          <input type="text" id="year" name="year"
            class="form-input {{ $errors->has('year') ? 'is-invalid' : '' }}"
            placeholder="{{ date('Y') }}" value="{{ old('year') }}" required>
          @error('year')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="link">Link Verifikasi</label>
          <input type="url" id="link" name="link" class="form-input"
            placeholder="https://..." value="{{ old('link') }}">
          <div class="form-hint">Opsional — link untuk memverifikasi keaslian sertifikat.</div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="image">Foto / Scan Sertifikat</label>
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
          <i class="fa-solid fa-floppy-disk"></i> Simpan Sertifikat
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
