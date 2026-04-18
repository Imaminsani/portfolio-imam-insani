@extends('layouts.admin')

@section('title', 'Dashboard')

@section('actions')
  <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary">
    <i class="fa-solid fa-plus"></i> Tambah Project
  </a>
@endsection

@section('content')

{{-- Stats Grid --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(99,102,241,0.12);color:#818cf8;">
      <i class="fa-solid fa-layer-group"></i>
    </div>
    <div>
      <div class="stat-card-num">{{ App\Models\Project::count() }}</div>
      <div class="stat-card-label">Total Project</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(245,158,11,0.12);color:#fcd34d;">
      <i class="fa-solid fa-star"></i>
    </div>
    <div>
      <div class="stat-card-num">{{ App\Models\Project::where('is_featured', true)->count() }}</div>
      <div class="stat-card-label">Featured Project</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(16,185,129,0.12);color:#34d399;">
      <i class="fa-solid fa-award"></i>
    </div>
    <div>
      <div class="stat-card-num">{{ App\Models\Certificate::count() }}</div>
      <div class="stat-card-label">Sertifikat</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:rgba(6,182,212,0.12);color:#22d3ee;">
      <i class="fa-solid fa-calendar-star"></i>
    </div>
    <div>
      <div class="stat-card-num">{{ App\Models\Activity::count() }}</div>
      <div class="stat-card-label">Kegiatan</div>
    </div>
  </div>
</div>

{{-- Recent Projects Table --}}
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-clock-rotate-left"></i>
      Project Terbaru
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-admin-ghost" style="font-size:0.8rem;">
      Lihat Semua <i class="fa-solid fa-arrow-right"></i>
    </a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Project</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th style="text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse(App\Models\Project::latest()->take(5)->get() as $project)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:0.75rem;">
                @if($project->image)
                  <img src="{{ asset('storage/'.$project->image) }}" class="project-thumb" alt="{{ $project->title }}">
                @else
                  <div class="project-thumb-placeholder">🖥️</div>
                @endif
                <span style="font-weight:600;color:var(--text);">{{ $project->title }}</span>
              </div>
            </td>
            <td>
              @if($project->is_featured)
                <span class="table-badge table-badge-featured"><i class="fa-solid fa-star" style="font-size:0.65rem;"></i> Featured</span>
              @else
                <span style="color:var(--text-dim);font-size:0.8rem;">Standard</span>
              @endif
            </td>
            <td style="font-size:0.8rem;color:var(--text-dim);">{{ $project->created_at->format('d M Y') }}</td>
            <td>
              <div class="td-actions">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn-admin btn-admin-ghost">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">
              <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                <p>Belum ada project. <a href="{{ route('admin.projects.create') }}" style="color:var(--accent)">Tambah sekarang →</a></p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Quick Actions --}}
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-top: 0.5rem;">
  <a href="{{ route('admin.projects.create') }}" class="stat-card" style="text-decoration:none; cursor:pointer; flex-direction:column; gap:0.75rem; align-items:flex-start;">
    <div class="stat-card-icon" style="background:rgba(99,102,241,0.12);color:#818cf8;">
      <i class="fa-solid fa-laptop-code"></i>
    </div>
    <div>
      <div style="font-weight:700;font-size:0.9rem;color:var(--text);">Tambah Project</div>
      <div class="stat-card-label">Upload project baru</div>
    </div>
  </a>
  <a href="{{ route('admin.certificates.create') }}" class="stat-card" style="text-decoration:none; cursor:pointer; flex-direction:column; gap:0.75rem; align-items:flex-start;">
    <div class="stat-card-icon" style="background:rgba(16,185,129,0.12);color:#34d399;">
      <i class="fa-solid fa-award"></i>
    </div>
    <div>
      <div style="font-weight:700;font-size:0.9rem;color:var(--text);">Tambah Sertifikat</div>
      <div class="stat-card-label">Upload sertifikasi baru</div>
    </div>
  </a>
  <a href="{{ route('admin.activities.create') }}" class="stat-card" style="text-decoration:none; cursor:pointer; flex-direction:column; gap:0.75rem; align-items:flex-start;">
    <div class="stat-card-icon" style="background:rgba(6,182,212,0.12);color:#22d3ee;">
      <i class="fa-solid fa-calendar-plus"></i>
    </div>
    <div>
      <div style="font-weight:700;font-size:0.9rem;color:var(--text);">Tambah Kegiatan</div>
      <div class="stat-card-label">Tambahkan event / aktivitas</div>
    </div>
  </a>
  <a href="{{ route('admin.about.edit') }}" class="stat-card" style="text-decoration:none; cursor:pointer; flex-direction:column; gap:0.75rem; align-items:flex-start;">
    <div class="stat-card-icon" style="background:rgba(168,85,247,0.12);color:#c084fc;">
      <i class="fa-solid fa-address-card"></i>
    </div>
    <div>
      <div style="font-weight:700;font-size:0.9rem;color:var(--text);">Edit Profil</div>
      <div class="stat-card-label">Update bio & social links</div>
    </div>
  </a>
</div>

@endsection
