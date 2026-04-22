<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC PORTFOLIO ───────────────────────────────────
Route::get('/', function () {
    $about         = \App\Models\About::first() ?? new \App\Models\About();
    $projects      = \App\Models\Project::latest()->get();
    $certificates  = \App\Models\Certificate::latest()->get();
    $activities    = \App\Models\Activity::latest()->get();
    return view('index', compact('about', 'projects', 'certificates', 'activities'));
});

// ─── MIGRATION HELPERS (Hapus setelah dipakai di hosting) ───
Route::get('/migrate-db-imam', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return '<h2 style="font-family:sans-serif;padding:2rem;color:#10b981;">✅ Migrasi database berhasil!</h2>';
});

Route::get('/storage-link-imam', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return '<h2 style="font-family:sans-serif;padding:2rem;color:#10b981;">✅ Storage link berhasil dibuat!</h2>';
    } catch (\Exception $e) {
        return '<h2 style="font-family:sans-serif;padding:2rem;color:#10b981;">✅ Storage link sudah ada.</h2>';
    }
});

Route::get('/fix-storage-imam', function () {
    $paths = [
        storage_path('app/public'),
        storage_path('framework/cache'),
        storage_path('framework/sessions'),
        storage_path('framework/views'),
        storage_path('logs'),
    ];

    foreach ($paths as $path) {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
    }

    return '<h2 style="font-family:sans-serif;padding:2rem;color:#10b981;">✅ Struktur folder storage berhasil diperbaiki!</h2>';
});

// ─── ADMIN PANEL ────────────────────────────────────────
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('projects',     \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('certificates', \App\Http\Controllers\Admin\CertificateController::class);
    Route::resource('activities',   \App\Http\Controllers\Admin\ActivityController::class);
    
    // About / Bio Management
    Route::get('/about', [\App\Http\Controllers\Admin\AboutController::class, 'edit'])->name('about.edit');
    Route::patch('/about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');
});

// Redirect /dashboard → /admin/dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ─── PROFILE ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
