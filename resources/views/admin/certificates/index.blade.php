@extends('layouts.admin')

@section('title', 'Daftar Sertifikat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold m-0">Manajemen Sertifikat</h2>
        <p class="text-muted m-0">Bukti keahlian dan pencapaian profesional Anda.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="btn-custom py-2 px-4 shadow-sm text-decoration-none">
        <i class="bi bi-plus-lg me-1"></i> Tambah Sertifikat
    </a>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead class="text-muted text-uppercase" style="font-size: 0.8rem; border-bottom: 1px solid var(--border-color);">
                <tr>
                    <th class="ps-3 py-3">Sertifikat</th>
                    <th class="py-3">Penerbit</th>
                    <th class="py-3">Tanggal Terbit</th>
                    <th class="text-end pe-3 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $certificate)
                <tr>
                    <td class="ps-3 py-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-check text-primary h4 mb-0"></i>
                            <span class="fw-semibold">{{ $certificate->title }}</span>
                        </div>
                    </td>
                    <td class="py-4 text-muted">
                        {{ $certificate->issued_by ?? '-' }}
                    </td>
                    <td class="py-4 text-muted">
                        {{ $certificate->issue_date ? \Carbon\Carbon::parse($certificate->issue_date)->format('d M Y') : '-' }}
                    </td>
                    <td class="text-end pe-3 py-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="btn btn-sm btn-outline-primary border-0">
                                <i class="bi bi-pencil-square" style="font-size: 1.1rem;"></i>
                            </a>
                            <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">
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
                        <i class="bi bi-patch-exclamation d-block h1 mb-3 opacity-25"></i>
                        Belum ada sertifikat yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
