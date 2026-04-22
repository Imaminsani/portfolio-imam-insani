@extends('layouts.admin')

@section('title', 'Kelola Bio & Profil')

@section('content')
<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PATCH')

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">

    {{-- Hero Section --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">
          <i class="fa-solid fa-rocket"></i> Hero Section
        </div>
      </div>
      <div class="form-card">
        <div class="form-group">
          <label class="form-label">Nama Branding</label>
          <input type="text" name="name" class="form-input"
            value="{{ old('name', $about->name) }}"
            placeholder="Muhammad Imam Insani">
          <div class="form-hint">Nama yang tampil di navbar dan title halaman.</div>
        </div>
        <div class="form-group">
          <label class="form-label">Hero Title</label>
          <input type="text" name="hero_title" class="form-input"
            value="{{ old('hero_title', $about->hero_title) }}"
            placeholder="Membangun masa depan digital yang elegan.">
        </div>
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label">Hero Subtitle / Tagline</label>
          <textarea name="hero_subtitle" class="form-textarea" style="min-height:100px;"
            placeholder="Deskripsi singkat di bawah hero title...">{{ old('hero_subtitle', $about->hero_subtitle) }}</textarea>
        </div>
      </div>
    </div>

    {{-- Social Links --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">
          <i class="fa-solid fa-share-nodes"></i> Social & Contact Links
        </div>
      </div>
      <div class="form-card">
        <div class="form-group">
          <label class="form-label"><i class="fa-brands fa-github" style="color:var(--text-muted);"></i> GitHub URL</label>
          <input type="url" name="github_url" class="form-input"
            value="{{ old('github_url', $about->github_url) }}"
            placeholder="https://github.com/username">
        </div>
        <div class="form-group">
          <label class="form-label"><i class="fa-brands fa-linkedin" style="color:var(--text-muted);"></i> LinkedIn URL</label>
          <input type="url" name="linkedin_url" class="form-input"
            value="{{ old('linkedin_url', $about->linkedin_url) }}"
            placeholder="https://linkedin.com/in/username">
        </div>
        @if(isset($about->email) || true)
        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label"><i class="fa-solid fa-envelope" style="color:var(--text-muted);"></i> Email</label>
          <input type="email" name="email" class="form-input"
            value="{{ old('email', $about->email ?? '') }}"
            placeholder="imaminsani@email.com">
          <div class="form-hint">Digunakan pada tombol "Kirim Email" di section Contact.</div>
        </div>
        @endif
      </div>
    </div>

  </div>

  {{-- About Section --}}
  <div class="panel" style="margin-top:0;">
    <div class="panel-header">
      <div class="panel-title">
        <i class="fa-solid fa-address-card"></i> About / Bio Section
      </div>
    </div>
    <div class="form-card">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">About Eyebrow (Label Kecil)</label>
          <input type="text" name="about_eyebrow" class="form-input"
            value="{{ old('about_eyebrow', $about->about_eyebrow) }}"
            placeholder="Who I Am">
          <div class="form-hint">Label kecil di atas judul About.</div>
        </div>
        <div class="form-group">
          <label class="form-label">About Title</label>
          <input type="text" name="about_title" class="form-input"
            value="{{ old('about_title', $about->about_title) }}"
            placeholder="Seni Mengubah Logika menjadi Visual.">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Deskripsi Lengkap About</label>
          <textarea name="about_description" class="form-textarea" style="min-height:200px;"
            placeholder="Ceritakan perjalanan, pengalaman, dan passion Anda...">{{ old('about_description', $about->about_description) }}</textarea>
          <div class="form-hint">Gunakan baris baru untuk paragraf baru.</div>
        </div>

        <div class="form-group">
          <label class="form-label">Foto Profil</label>
          <input type="file" name="profile_image" class="form-input" accept="image/*" onchange="previewImage(event)">
          <div class="form-hint">Disarankan rasio 3:4 (potret). Maksimal 2MB.</div>

          <div style="margin-top:1rem;">
            <label class="form-label">Preview Saat Ini:</label>
            @if($about->profile_image)
              <img id="image-preview-el"
                src="{{ $about->profile_image == 'profile.png' ? asset('img/profile.png') : asset('uploads/' . $about->profile_image) }}"
                class="img-preview show"
                style="max-width:180px;max-height:220px;">
            @else
              <div id="no-image-placeholder" class="project-thumb-placeholder"
                style="width:180px;height:220px;font-size:3rem;border-radius:12px;border:2px dashed var(--border);">📷</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="form-footer">
      <span style="font-size:0.8rem;color:var(--text-dim);">
        <i class="fa-solid fa-circle-info"></i> Semua perubahan langsung terlihat di halaman portfolio publik.
      </span>
      <button type="submit" class="btn-admin btn-admin-primary" style="padding:0.7rem 2rem;">
        <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
      </button>
    </div>
  </div>
</form>

@push('scripts')
<script>
function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function() {
    const output = document.getElementById('image-preview-el');
    const placeholder = document.getElementById('no-image-placeholder');
    if (output) { output.src = reader.result; output.classList.add('show'); }
    if (placeholder) placeholder.style.display = 'none';
  };
  reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
@endsection
