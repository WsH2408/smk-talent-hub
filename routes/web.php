<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (SPESIFIK)
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
// Custom Profile Routes
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit.custom');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update.custom');

/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATED ROUTES (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // PROJECTS - Spesifik harus sebelum generic
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project:slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project:slug}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project:slug}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // PROFILE - Custom routes (HARUS SEBELUM route bawaan Breeze)
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit.custom');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update.custom');

    // Profile bawaan Breeze (biarkan paling bawah)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects
    Route::get('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('projects');
    Route::post('/projects/{project}/approve', [App\Http\Controllers\Admin\ProjectController::class, 'approve'])->name('projects.approve');
    Route::post('/projects/{project}/reject', [App\Http\Controllers\Admin\ProjectController::class, 'reject'])->name('projects.reject');
    Route::delete('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('projects.destroy');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Recruiter Routes
// Recruiter Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/recruiter/dashboard', [App\Http\Controllers\Recruiter\DashboardController::class, 'index'])->name('recruiter.dashboard');
});
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
/*
|--------------------------------------------------------------------------
| 4. PUBLIC ROUTES (GENERIC - PALING BAWAH!)
|--------------------------------------------------------------------------
| Route dengan parameter {user} atau {project} harus ditaruh paling bawah
| agar tidak menabrak route spesifik di atas.
*/
// Route generic HARUS di bawah
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/download-cv', [ProfileController::class, 'downloadCV'])->name('profile.download-cv');

// INI PALING PENTING: Harus di paling bawah
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

require __DIR__.'/auth.php';
