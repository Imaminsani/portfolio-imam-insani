@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="stats-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
    {{-- Update Profile Info --}}
    <div class="panel">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--border);">
            <h3 style="font-size: 1.1rem; font-weight: 700;"><i class="fa-solid fa-user-pen" style="color: var(--accent); margin-right: 0.5rem;"></i> Informasi Profil</h3>
            <p style="font-size: 0.85rem; color: var(--text3); margin-top: 0.25rem;">Perbarui informasi profil dan alamat email akun Anda.</p>
        </div>
        <div class="form-card">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Update Password --}}
    <div class="panel">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--border);">
            <h3 style="font-size: 1.1rem; font-weight: 700;"><i class="fa-solid fa-key" style="color: var(--accent); margin-right: 0.5rem;"></i> Perbarui Password</h3>
            <p style="font-size: 0.85rem; color: var(--text3); margin-top: 0.25rem;">Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.</p>
        </div>
        <div class="form-card">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>

<div class="panel" style="margin-top: 2rem; border-color: rgba(239, 68, 68, 0.2);">
    <div style="padding: 1.5rem; border-bottom: 1px solid rgba(239, 68, 68, 0.1); background: rgba(239, 68, 68, 0.02);">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #f87171;"><i class="fa-solid fa-triangle-exclamation" style="margin-right: 0.5rem;"></i> Zona Bahaya</h3>
        <p style="font-size: 0.85rem; color: var(--text3); margin-top: 0.25rem;">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
    </div>
    <div class="form-card">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
