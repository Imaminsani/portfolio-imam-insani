@extends('layouts.admin')

@section('title', 'Edit Aktivitas')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.activities.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h2 class="fw-bold mt-2">Edit Aktivitas: {{ $activity->title }}</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">NAMA AKTIVITAS</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $activity->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $activity->description) }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">TANGGAL PELAKSANAAN</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $activity->date) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label text-muted fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">GAMBAR DOKUMENTASI (OPSIONAL)</label>
                        @if($activity->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/' . $activity->image) }}" alt="Current image" style="height: 100px; border-radius: 8px;" class="shadow-sm">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
