@extends('layouts.admin')

@section('title', 'Daftar Proyek')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold m-0">Manajemen Proyek</h2>
        <p class="text-muted m-0">Kumpulan hasil karya dan proyek yang Anda kerjakan.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn-custom py-2 px-4 shadow-sm text-decoration-none">
        <i class="bi bi-plus-lg me-1"></i> Tambah Proyek
    </a>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead class="text-muted text-uppercase" style="font-size: 0.8rem; border-bottom: 1px solid var(--border-color);">
                <tr>
                    <th class="ps-3 py-3">Proyek</th>
                    <th class="py-3">Deskripsi</th>
                    <th class="py-3">Link</th>
                    <th class="text-end pe-3 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td class="ps-3 py-4">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 60px; height: 45px; overflow: hidden; border-radius: 8px;">
                                @if($project->image)
                                    <img src="{{ asset('uploads/' . $project->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image" style="font-size: 1.2rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="fw-semibold">{{ $project->title }}</span>
                        </div>
                    </td>
                    <td class="py-4">
                        <span class="text-muted text-truncate d-inline-block" style="max-width: 300px;">{{ $project->description }}</span>
                    </td>
                    <td class="py-4">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-primary text-decoration-none" style="font-size: 0.9rem;">
                                <i class="bi bi-link-45deg me-1"></i>Kunjungi
                            </a>
                        @else
                            <span class="text-muted">No Link</span>
                        @endif
                    </td>
                    <td class="text-end pe-3 py-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary border-0">
                                <i class="bi bi-pencil-square" style="font-size: 1.1rem;"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                    <i class="bi bi-trash3" style="font-size: 1.1rem;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox d-block h1 mb-3 opacity-25"></i>
                        Belum ada proyek yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
