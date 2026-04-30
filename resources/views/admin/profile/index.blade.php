@extends('layouts.admin')

@section('title', 'Kelola Profil')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Pengaturan Profil</h2>
    <p class="text-muted">Kelola identitas diri yang akan tampil di halaman utama portofolio.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                        <label class="form-label d-block">Foto Profil</label>
                        @if($user->profile_photo)
                            <img src="{{ asset('uploads/' . $user->profile_photo) }}" alt="Profile Photo" class="rounded-pill mb-3 shadow" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--accent-color);">
                        @else
                            <div class="rounded-pill mb-3 d-flex align-items-center justify-content-center bg-dark" style="width: 120px; height: 120px; border: 3px dashed var(--border-color);">
                                <i class="bi bi-person text-muted h1 mb-0"></i>
                            </div>
                        @endif
                        <input type="file" name="profile_photo" class="form-control form-control-sm">
                        <small class="text-muted mt-2 d-block">Maks 2MB (JPG/PNG)</small>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}" placeholder="Contoh: Muhammad Imam Insani">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Utama (Tidak dapat diubah)</label>
                            <input type="email" class="form-control bg-dark opacity-50" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="about_me" class="form-label">Tentang Saya (About Me)</label>
                    <textarea name="about_me" id="about_me" rows="5" class="form-control" placeholder="Tuliskan deskripsi singkat mengenai diri Anda dan keahlian Anda...">{{ old('about_me', $user->about_me) }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn-custom py-2 px-5">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card-custom border-warning">
            <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2 text-warning"></i>Tips Profil</h5>
            <ul class="text-muted mb-0 ps-3" style="font-size: 0.9rem;">
                <li class="mb-2">Gunakan foto profil profesional dengan latar belakang yang bersih.</li>
                <li class="mb-2">Tuliskan "About Me" yang singkat, padat, dan menarik bagi perekrut kerja/klien.</li>
                <li>Nama lengkap yang Anda isi di sini akan muncul sebagai judul utama di halaman depan.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
