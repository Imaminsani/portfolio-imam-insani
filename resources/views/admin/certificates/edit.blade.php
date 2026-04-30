@extends('layouts.admin')

@section('title', 'Edit Sertifikat')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h2 class="fw-bold mt-2">Edit Sertifikat: {{ $certificate->title }}</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">JUDUL SERTIFIKAT</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $certificate->title) }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="issued_by" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">PENERBIT / ORGANISASI</label>
                        <input type="text" name="issued_by" id="issued_by" class="form-control" value="{{ old('issued_by', $certificate->issued_by) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="issue_date" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">TANGGAL TERBIT</label>
                        <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ old('issue_date', $certificate->issue_date) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">GAMBAR/FILE SERTIFIKAT</label>
                    @if($certificate->image)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/' . $certificate->image) }}" alt="Current Certificate" style="height: 100px; border-radius: 8px;" class="shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
