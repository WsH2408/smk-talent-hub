<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [PageController::class, 'index'])->name('home');

// Public Pages
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Authenticated Routes (Butuh Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
});

// Letakkan di luar middleware auth agar Rekruter/Guest bisa download
Route::get('/profile/{user}/download-cv', [ProfileController::class, 'downloadCV'])->name('profile.download-cv');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Route untuk Users (stub - nanti dikembangkan)
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
});

require __DIR__ . '/auth.php';