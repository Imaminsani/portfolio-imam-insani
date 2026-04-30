@extends('layouts.admin')

@section('title', 'Daftar Aktivitas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold m-0">Manajemen Aktivitas</h2>
        <p class="text-muted m-0">Catatan kegiatan, pengalaman, atau event yang Anda ikuti.</p>
    </div>
    <a href="{{ route('admin.activities.create') }}" class="btn-custom py-2 px-4 shadow-sm text-decoration-none">
        <i class="bi bi-plus-lg me-1"></i> Tambah Aktivitas
    </a>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead class="text-muted text-uppercase" style="font-size: 0.8rem; border-bottom: 1px solid var(--border-color);">
                <tr>
                    <th class="ps-3 py-3">Aktivitas</th>
                    <th class="py-3">Deskripsi</th>
                    <th class="py-3">Tanggal</th>
                    <th class="text-end pe-3 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr>
                    <td class="ps-3 py-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-calendar-check text-warning h4 mb-0"></i>
                            <span class="fw-semibold">{{ $activity->title }}</span>
                        </div>
                    </td>
                    <td class="py-4">
                        <span class="text-muted text-truncate d-inline-block" style="max-width: 300px;">{{ $activity->description }}</span>
                    </td>
                    <td class="py-4 text-muted">
                        {{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d M Y') : '-' }}
                    </td>
                    <td class="text-end pe-3 py-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-sm btn-outline-primary border-0">
                                <i class="bi bi-pencil-square" style="font-size: 1.1rem;"></i>
                            </a>
                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')">
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
                        <i class="bi bi-calendar-x d-block h1 mb-3 opacity-25"></i>
                        Belum ada aktivitas yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
