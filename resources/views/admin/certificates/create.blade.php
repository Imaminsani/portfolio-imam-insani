@extends('layouts.admin')

@section('title', 'Tambah Sertifikat Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h2 class="fw-bold mt-2">Tambah Sertifikat Baru</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">JUDUL SERTIFIKAT</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Cisco Certified Network Associate" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="issued_by" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">PENERBIT / ORGANISASI</label>
                        <input type="text" name="issued_by" id="issued_by" class="form-control" value="{{ old('issued_by') }}" placeholder="Contoh: Cisco, Udemy, Google">
                    </div>
                    <div class="col-md-6">
                        <label for="issue_date" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">TANGGAL TERBIT</label>
                        <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ old('issue_date') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">GAMBAR/FILE SERTIFIKAT</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="text-muted">Maks 2MB (JPG/PNG).</small>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Sertifikat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
