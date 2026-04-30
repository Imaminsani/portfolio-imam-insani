@extends('layouts.admin')

@section('title', 'Tambah Aktivitas Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.activities.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h2 class="fw-bold mt-2">Tambah Aktivitas Baru</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">NAMA AKTIVITAS</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Hackathon Nasional 2024" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="description" id="description" rows="4" class="form-control" placeholder="Jelaskan peran Anda, pengalaman yang didapat, dll...">{{ old('description') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">TANGGAL PELAKSANAAN</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">GAMBAR DOKUMENTASI (OPSIONAL)</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Aktivitas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
