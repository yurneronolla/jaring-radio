<?php
// routes/web.php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RadioController;
use App\Http\Controllers\OrganisasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Radio Routes
    Route::resource('radio', RadioController::class);
    Route::get('radio/provinsi/{id}', [RadioController::class, 'provinsi'])->name('radio.provinsi');
    Route::get('radio-export', [RadioController::class, 'export'])->name('radio.export');
    
    // Organisasi Routes
    Route::resource('organisasi', OrganisasiController::class);
    Route::get('organisasi-export', [OrganisasiController::class, 'export'])->name('organisasi.export');
});