@extends('layouts.admin')

@section('title', 'Edit Project')

@section('actions')
  <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-admin-ghost">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-pen-to-square"></i>
      Edit: {{ Str::limit($project->title, 40) }}
    </div>
    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
          onsubmit="return confirm('Hapus project \'{{ addslashes($project->title) }}\' secara permanen?')">
      @csrf @method('DELETE')
      <button type="submit" class="btn-admin btn-admin-danger">
        <i class="fa-solid fa-trash"></i> Hapus
      </button>
    </form>
  </div>
  <div class="form-card">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="title">
            Judul Project <span class="required">*</span>
          </label>
          <input type="text" id="title" name="title" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
            value="{{ old('title', $project->title) }}" required>
          @error('title')
            <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="link">Link Demo / GitHub</label>
          <input type="url" id="link" name="link" class="form-input"
            placeholder="https://github.com/..."
            value="{{ old('link', $project->link) }}">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">
          Deskripsi Project <span class="required">*</span>
        </label>
        <textarea id="description" name="description"
          class="form-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}"
          required>{{ old('description', $project->description) }}</textarea>
        @error('description')
          <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Gambar Project</label>
        @if($project->image)
          <div style="margin-bottom:0.75rem;">
            <img src="{{ asset('storage/'.$project->image) }}"
              style="max-height:150px;border-radius:10px;border:1px solid var(--border);" alt="Current Image">
            <div class="form-hint" style="margin-top:0.4rem;">Gambar saat ini. Upload baru untuk mengganti.</div>
          </div>
        @endif
        <input type="file" id="image" name="image" class="form-input" accept="image/*" onchange="previewImage(this)">
        <div class="form-hint"><i class="fa-regular fa-image"></i> Opsional — kosongkan jika tidak ingin mengganti gambar.</div>
        <img id="img-preview" class="img-preview" alt="Preview">
        @error('image')
          <div class="invalid-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <div class="form-check-row">
          <input type="checkbox" id="is_featured" name="is_featured" value="1"
            {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
          <label for="is_featured">
            <i class="fa-solid fa-star" style="color:var(--accent-amber);"></i>
            Jadikan sebagai <strong>Featured Project</strong>
          </label>
        </div>
      </div>

      <div class="form-footer" style="margin: 0 -1.75rem -1.75rem; border-radius: 0 0 var(--radius) var(--radius);">
        <span style="font-size:0.8rem;color:var(--text-dim);">
          Terakhir diupdate: {{ $project->updated_at->format('d M Y, H:i') }}
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
