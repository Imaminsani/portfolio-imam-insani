@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Dashboard Overview</h2>
    <p class="text-muted">Selamat datang kembali di panel kontrol portofolio Anda.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">Total Proyek</div>
            <div class="h1 fw-bold mb-1 text-primary">{{ \App\Models\Project::count() }}</div>
            <a href="{{ route('admin.projects.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card-custom">
            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">Sertifikat</div>
            <div class="h1 fw-bold mb-1 text-success">{{ \App\Models\Certificate::count() }}</div>
            <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card-custom">
            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.05em;">Aktivitas</div>
            <div class="h1 fw-bold mb-1 text-warning">{{ \App\Models\Activity::count() }}</div>
            <a href="{{ route('admin.activities.index') }}" class="text-muted text-decoration-none" style="font-size: 0.9rem;">
                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="mt-5">
    <div class="card-custom border-primary" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(9, 9, 11, 0) 100%);">
        <div class="row items-center">
            <div class="col-md-8">
                <h4 class="fw-bold mb-2">Siap untuk Menambah Konten Baru?</h4>
                <p class="text-muted mb-0">Klik tombol di samping untuk mengupdate profil atau menambahkan proyek terbaru Anda agar pengunjung bisa melihat karya terbaik Anda.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.profile.index') }}" class="btn-custom py-2 px-4 shadow-sm">Update Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
