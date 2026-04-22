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
