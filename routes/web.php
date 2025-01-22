<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;

// ** Route de la page d'accueil **
Route::get('/', [HomeController::class, 'index'])->name('home');

// ** Routes d'authentification **
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

// ** Zone d'administration (authentification requise) **
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes pour gérer les liens courts
    Route::prefix('short-links')->name('short-links.')->group(function () {
        Route::post('/', [ShortLinkController::class, 'store'])->name('store');
        Route::delete('{id}', [ShortLinkController::class, 'destroy'])->name('destroy');
        Route::put('{id}', [ShortLinkController::class, 'update'])->name('update');
    });
});

// ** Redirection d'URL **
Route::get('/{shortUrl}', [ShortLinkController::class, 'redirect'])->name('short-links.redirect');
