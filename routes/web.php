<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mitra\ListingController;
use App\Http\Controllers\Mitra\MitraRegistrationController;
use App\Http\Controllers\PetaSurplusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SisaCheckerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/gerakan', function () {
    return view('gerakan');
})->name('gerakan');

Route::get('/cerita/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware('guest')->group(function () {
    Route::get('/mitra/register', [MitraRegistrationController::class, 'create'])->name('mitra.register');
    Route::post('/mitra/register', [MitraRegistrationController::class, 'store'])->name('mitra.register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/rescues', [DashboardController::class, 'store'])->name('rescues.store');

    Route::get('/sisa-checker', [SisaCheckerController::class, 'create'])->name('sisa-checker.create');
    Route::post('/sisa-checker/identify', [SisaCheckerController::class, 'identify'])->name('sisa-checker.identify');
    Route::get('/sisa-checker/confirm', [SisaCheckerController::class, 'confirm'])->name('sisa-checker.confirm');
    Route::post('/sisa-checker/recipe', [SisaCheckerController::class, 'recipe'])->name('sisa-checker.recipe');
    Route::get('/sisa-checker/result', [SisaCheckerController::class, 'result'])->name('sisa-checker.result');

    Route::get('/peta-surplus', [PetaSurplusController::class, 'index'])->name('peta-surplus.index');
    Route::post('/peta-surplus/listings/{listing}/claim', [ClaimController::class, 'store'])->name('listings.claim');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/{user}', [AdminDashboardController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'mitra'])->prefix('mitra')->name('mitra.')->group(function () {
    Route::get('/', [ListingController::class, 'index'])->name('listings.index');
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
    Route::patch('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
});

require __DIR__.'/auth.php';
