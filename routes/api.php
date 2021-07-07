<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// AUTH
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('logout', [AdminController::class, 'logout']); // LOGOUT
// Route::get('tes', [UserController::class, 'profile'])->middleware(['api.admin', 'api.user']); // PROFILE 

// Route::middleware(['api.admin', 'api.user'])->get('/profile', function (Request $request) {
//     $user = $request->user();
//     return response()->json([
//         'user' => $user,
//         'message' => 'Berhasil mendapatkan data pengguna',
//         'status' => 1,
//     ]);
// });

// Route::get('profile', [UserController::class, 'profile'])->middleware(['api.admin', 'api.user']);

// USER
Route::get('getAllUser', [UserController::class, 'getAllUser']);
Route::get('dashboard', [UserController::class, 'dashboard'])->middleware(['api.admin', 'api.user']);
Route::get('profile', [UserController::class, 'profile'])->middleware(['api.admin', 'api.user']);
Route::post('profileCompletion', [UserController::class, 'profileCompletion'])->middleware(['api.user']);
Route::delete('deleteUser/{id}', [UserController::class, 'deleteUser'])->middleware(['api.admin', 'api.user']);

// DASHBOARD
Route::get('dashboard', [DashboardController::class, 'dashboard']);
Route::get('totalUser', [DashboardController::class, 'getTotalUsers']);
Route::get('totalPesanan', [DashboardController::class, 'getTotalPesanan']);
Route::get('kurbanBerlangsung', [DashboardController::class, 'getKurbanBerlangsung']);
Route::get('kurbanTerselesaikan', [DashboardController::class, 'getWaitingTransaction']);
Route::get('waitingTransaction', [DashboardController::class, 'getWaitingTransaction']);
Route::get('successTransaction', [DashboardController::class, 'getSuccessTransaction']);

// CART
Route::resource('cart', CartController::class)->middleware(['api.admin', 'api.user']);

// PACKAGE
Route::post('package/{tipe}', [PackagesController::class, 'getPackageByType'])->middleware('api.user');
Route::get('price/{tipe}', [PackagesController::class, 'getPriceRange']);
Route::get('weight', [PackagesController::class, 'getWeightRange']);
Route::resource('package', PackagesController::class)->middleware(['api.admin','api.user']);

// PEMBAYARAN
Route::get('getPembayaranUser', [PembayaranController::class, 'getPembayaranUser'])->middleware('api.user');
Route::post('uploadBuktiTransfer', [PembayaranController::class, 'uploadBuktiTransfer'])->middleware(['api.admin', 'api.user']);
Route::put('approve_pembayaran/{id}', [PembayaranController::class, 'approve'])->middleware(['api.admin', 'api.user']);
Route::put('reject_pembayaran/{id}', [PembayaranController::class, 'reject'])->middleware(['api.admin', 'api.user']);
Route::resource('pembayaran', PembayaranController::class)->middleware(['api.admin', 'api.user']);

// REPORT
Route::get('getReportDetail/{id_pembayaran}', [ReportController::class, 'getReportDetail'])->middleware(['api.admin', 'api.user']);
Route::get('myReport', [ReportController::class, 'myReport'])->middleware(['api.user']);
Route::get('myReport/{id_pembayaran}', [ReportController::class, 'myReportDetail'])->middleware(['api.user']);
Route::get('getReportHewan/{id_pembayaran}', [ReportController::class, 'getReportHewan'])->middleware(['api.user']);
Route::get('getReportPenyembelihan/{id_pembayaran}', [ReportController::class, 'getReportPenyembelihan'])->middleware(['api.user']);
Route::get('getReportPembagian/{id_pembayaran}', [ReportController::class, 'getReportPembagian'])->middleware(['api.user']);
Route::get('getReportPengiriman/{id_pembayaran}', [ReportController::class, 'getReportPengiriman'])->middleware(['api.user']);
Route::get('getReportSampai/{id_pembayaran}', [ReportController::class, 'getReportSampai'])->middleware(['api.user']);
Route::post('updateReport/{id}', [ReportController::class, 'updateReport'])->middleware(['api.user']);
// Route::put('sendReport/{id}', [ReportController::class, 'myReportDetail'])->middleware(['api.admin', 'api.user']);
Route::resource('report', ReportController::class);

// PENGIRIMAN
Route::get('getPengirimanUser/{id_pembayaran}', [PengirimanController::class, 'getPengirimanUser'])->middleware(['api.admin', 'api.user']);
Route::resource('pengiriman', PengirimanController::class)->middleware(['api.admin', 'api.user']);

// SERTIFIKAT
Route::post('uploadSertifikat', [SertifikatController::class, 'uploadSertifikat'])->middleware(['api.admin', 'api.user']);
Route::resource('sertifikat', SertifikatController::class)->middleware(['api.admin', 'api.user']);