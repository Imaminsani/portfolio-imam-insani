@extends('layouts.admin')

@section('title', 'Tambah Proyek Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.projects.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h2 class="fw-bold mt-2">Tambah Proyek Baru</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">JUDUL PROYEK</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Website E-Commerce Laravel" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="description" id="description" rows="4" class="form-control" placeholder="Jelaskan secara singkat tentang proyek ini, teknologi yang digunakan, dll...">{{ old('description') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="link" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">LINK PROYEK (OPSIONAL)</label>
                        <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="https://domain.com">
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">GAMBAR PREVIEW</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="text-muted">Rekomendasi: 16:9 ratio, maks 2MB.</small>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Proyek</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
