@extends('layouts.admin')

@section('title', 'Kelola Project')

@section('actions')
  <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary">
    <i class="fa-solid fa-plus"></i> Tambah Project
  </a>
@endsection

@section('content')
<div class="panel">
  <div class="panel-header">
    <div class="panel-title">
      <i class="fa-solid fa-laptop-code"></i>
      Daftar Project
    </div>
    <span style="font-size:0.8rem;color:var(--text-dim);">{{ $projects->count() }} project</span>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Project</th>
          <th>Deskripsi</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th style="text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
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
            <td style="max-width:220px;">
              {{ Str::limit($project->description, 65) }}
            </td>
            <td>
              @if($project->is_featured)
                <span class="table-badge table-badge-featured">
                  <i class="fa-solid fa-star" style="font-size:0.65rem;"></i> Featured
                </span>
              @else
                <span style="color:var(--text-dim);font-size:0.8rem;">Standard</span>
              @endif
            </td>
            <td style="font-size:0.8rem;color:var(--text-dim);white-space:nowrap;">
              {{ $project->created_at->format('d M Y') }}
            </td>
            <td>
              <div class="td-actions">
                @if($project->link)
                  <a href="{{ $project->link }}" target="_blank" class="btn-admin btn-admin-ghost" title="Lihat Live">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                @endif
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn-admin btn-admin-ghost">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                      onsubmit="return confirm('Hapus project \'{{ addslashes($project->title) }}\'?')">
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
                <i class="fa-solid fa-box-open"></i>
                <p>Belum ada project. <a href="{{ route('admin.projects.create') }}" style="color:var(--accent)">Tambah project pertama →</a></p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
