@extends('layouts.admin')

@section('title', 'Kegiatan & Event')

@section('actions')
  <a href="{{ route('admin.activities.create') }}" class="btn-admin btn-admin-primary">
    <i class="fa-solid fa-plus"></i> Tambah Kegiatan
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-calendar-star"></i>
      Daftar Kegiatan & Event
    </div>
    <span style="font-size:0.8rem;color:var(--text-dim);">{{ $activities->count() }} kegiatan</span>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Kegiatan</th>
          <th>Jenis</th>
          <th>Lokasi</th>
          <th>Tahun</th>
          <th style="text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($activities as $activity)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:0.75rem;">
                @if($activity->image)
                  <img src="{{ asset('uploads/'.$activity->image) }}" class="project-thumb" alt="{{ $activity->title }}">
                @else
                  <div class="project-thumb-placeholder">📅</div>
                @endif
                <span style="font-weight:600;color:var(--text);">{{ $activity->title }}</span>
              </div>
            </td>
            <td>
              <span class="table-badge" style="background:rgba(6,182,212,0.1);color:#22d3ee;border:1px solid rgba(6,182,212,0.2);">
                {{ $activity->type }}
              </span>
            </td>
            <td style="font-size:0.83rem;color:var(--text-muted);">{{ $activity->location ?? '—' }}</td>
            <td>
              <span class="table-badge" style="background:rgba(99,102,241,0.1);color:var(--accent-hover);border:1px solid rgba(99,102,241,0.2);">
                {{ $activity->year }}
              </span>
            </td>
            <td>
              <div class="td-actions">
                <a href="{{ route('admin.activities.edit', $activity) }}" class="btn-admin btn-admin-ghost">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST"
                      onsubmit="return confirm('Hapus kegiatan \'{{ addslashes($activity->title) }}\'?')">
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
            <td colspan="5">
              <div class="empty-state">
                <i class="fa-solid fa-calendar-days"></i>
                <p>Belum ada kegiatan. <a href="{{ route('admin.activities.create') }}" style="color:var(--accent)">Tambah sekarang →</a></p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
