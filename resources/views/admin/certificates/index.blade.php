@extends('layouts.admin')

@section('title', 'Kelola Sertifikat')

@section('actions')
  <a href="{{ route('admin.certificates.create') }}" class="btn-admin btn-admin-primary">
    <i class="fa-solid fa-plus"></i> Tambah Sertifikat
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-award"></i>
      Daftar Sertifikat
    </div>
    <span style="font-size:0.8rem;color:var(--text-dim);">{{ $certificates->count() }} sertifikat</span>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Sertifikat</th>
          <th>Penerbit</th>
          <th>Tahun</th>
          <th style="text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($certificates as $cert)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:0.75rem;">
                @if($cert->image)
                  <img src="{{ asset('storage/'.$cert->image) }}" class="project-thumb" alt="{{ $cert->title }}">
                @else
                  <div class="project-thumb-placeholder">🎓</div>
                @endif
                <span style="font-weight:600;color:var(--text);">{{ $cert->title }}</span>
              </div>
            </td>
            <td style="color:var(--text-muted);">{{ $cert->issuer }}</td>
            <td>
              <span class="table-badge" style="background:rgba(99,102,241,0.1);color:var(--accent-hover);border:1px solid rgba(99,102,241,0.2);">
                {{ $cert->year }}
              </span>
            </td>
            <td>
              <div class="td-actions">
                @if($cert->link)
                  <a href="{{ $cert->link }}" target="_blank" class="btn-admin btn-admin-ghost" title="Verify Credential">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                @endif
                <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn-admin btn-admin-ghost">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST"
                      onsubmit="return confirm('Hapus sertifikat \'{{ addslashes($cert->title) }}\'?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-admin btn-admin-danger" title="Hapus">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">
              <div class="empty-state">
                <i class="fa-solid fa-certificate"></i>
                <p>Belum ada sertifikat. <a href="{{ route('admin.certificates.create') }}" style="color:var(--accent)">Tambah sekarang →</a></p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
