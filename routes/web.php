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
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link)) {
        return '<h2 style="font-family:sans-serif;padding:2rem;color:#f59e0b;">⚠️ Link sudah ada! Hapus folder "public/storage" dulu di File Manager jika foto tetap tidak muncul.</h2>';
    }

    try {
        if (symlink($target, $link)) {
            return '<h2 style="font-family:sans-serif;padding:2rem;color:#10b981;">✅ Storage link berhasil dibuat menggunakan symlink()!</h2>';
        } else {
            return '<h2 style="font-family:sans-serif;padding:2rem;color:#ef4444;">❌ Gagal membuat symlink.</h2>';
        }
    } catch (\Throwable $e) {
        return '<h2 style="font-family:sans-serif;padding:2rem;color:#ef4444;">❌ Error: ' . $e->getMessage() . '</h2>';
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

Route::get('/debug-storage-imam', function () {
    $publicStorage = public_path('storage');
    $storageAppPublic = storage_path('app/public');
    
    echo "<h3>--- Path Info ---</h3>";
    echo "Public Storage Path: " . $publicStorage . "<br>";
    echo "Storage App Public Path: " . $storageAppPublic . "<br>";
    
    echo "<h3>--- Checking Public Storage ---</h3>";
    if (file_exists($publicStorage)) {
        echo "✅ public/storage exists.<br>";
        if (is_link($publicStorage)) {
            echo "🔗 It is a SYMLINK.<br>";
            echo "🎯 Pointing to: " . readlink($publicStorage) . "<br>";
        } else {
            echo "📁 It is a DIRECTORY (NOT a link). <span style='color:red;'>Ini MASALAH! Harus dihapus dulu lewat File Manager lalu jalankan storage-link-imam kembali.</span><br>";
        }
    } else {
        echo "❌ public/storage DOES NOT EXIST.<br>";
    }
    
    echo "<h3>--- Checking Storage App Public ---</h3>";
    if (file_exists($storageAppPublic)) {
        echo "✅ storage/app/public exists.<br>";
        $subfolders = ['projects', 'certificates', 'activities', 'profile'];
        foreach ($subfolders as $sub) {
            $subPath = $storageAppPublic . '/' . $sub;
            if (file_exists($subPath)) {
                $files = array_diff(scandir($subPath), array('.', '..'));
                echo "📁 $sub: " . count($files) . " files found.<br>";
            } else {
                echo "❌ Folder $sub NOT FOUND in storage/app/public.<br>";
            }
        }
    } else {
        echo "❌ storage/app/public DOES NOT EXIST.<br>";
    }
    
    echo "<h3>--- Env Info ---</h3>";
    echo "APP_URL: " . config('app.url') . "<br>";
    echo "Asset URL for sample: " . asset('storage/test.jpg') . "<br>";
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
