<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistribusiBantuanController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\KebutuhanController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengungsiController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('auth', [AuthController::class, 'auth'])->name('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth.check'], function () {

    // Home route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Dashboard route
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Log Activity route
    Route::get('log-activity', [LogActivityController::class, 'index'])->name('log-activity.index');

    //Distribusi Bantuan routes
    Route::resource('distribusi-bantuan', DistribusiBantuanController::class);
    Route::post('distribusi-bantuan/bantuan', [DistribusiBantuanController::class, 'bantuan'])->name('distribusi-bantuan.bantuan');

    //Bantuan routes
    Route::resource('bantuan', BantuanController::class);

    //Kebutuhan routes
    Route::resource('kebutuhan', KebutuhanController::class);

    //Donatur routes
    Route::resource('donatur', DonaturController::class);

    //Pengungsi routes
    Route::resource('pengungsi', PengungsiController::class);

    //Penduduk routes
    Route::resource('penduduk', PendudukController::class);

    //Kelompok routes
    Route::resource('kelompok', KelompokController::class);

    //Barang routes
    Route::resource('barang', BarangController::class);

    //Jenis Barang routes
    Route::resource('jenis-barang', JenisBarangController::class);

    //Posko routes
    Route::resource('posko', PoskoController::class);

    //User Management routes
    Route::resource('user-management', UserManagementController::class);
});
