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

// ADMIN
// Route::post('register_admin', [AdminController::class, 'register'])->middleware('auth:admin-api');
Route::post('register_admin', [AdminController::class, 'register']);
Route::post('login_admin', [AdminController::class, 'login']);

// USER
Route::post('register_user', [UserController::class, 'register']);
Route::post('login_user', [UserController::class, 'login']);

Route::post('logout', [AdminController::class, 'logout']); // LOGOUT
// Route::get('tes', [UserController::class, 'profile'])->middleware('auth:admin-api,user-api'); // PROFILE 

// Route::middleware('auth:admin-api,user-api')->get('/profile', function (Request $request) {
//     $user = $request->user();
//     return response()->json([
//         'user' => $user,
//         'message' => 'Berhasil mendapatkan data pengguna',
//         'status' => 1,
//     ]);
// });

Route::get('profile', [UserController::class, 'profile'])->middleware('auth:admin-api,user-api');

Route::get('dashboard', [UserController::class, 'dashboard'])->middleware('auth:admin-api,user-api');
Route::post('profileCompletion', [UserController::class, 'profileCompletion'])->middleware('auth:user-api');

// CART
Route::resource('cart', CartController::class)->middleware('auth:admin-api,user-api');

// PACKAGE
Route::post('package/{tipe}', [PackagesController::class, 'getPackageByType'])->middleware('auth:admin-api,user-api');
Route::get('price/{tipe}', [PackagesController::class, 'getPriceRange']);
Route::get('weight', [PackagesController::class, 'getWeightRange']);
Route::resource('package', PackagesController::class)->middleware('auth:admin-api,user-api');

// PEMBAYARAN
Route::get('getPembayaranUser', [PembayaranController::class, 'getPembayaranUser'])->middleware('auth:user-api');
Route::post('uploadBuktiTransfer', [PembayaranController::class, 'uploadBuktiTransfer'])->middleware('auth:admin-api,user-api');
Route::put('approve_pembayaran/{id}', [PembayaranController::class, 'approve'])->middleware('auth:admin-api,user-api');
Route::put('reject_pembayaran/{id}', [PembayaranController::class, 'reject'])->middleware('auth:admin-api,user-api');
Route::resource('pembayaran', PembayaranController::class)->middleware('auth:admin-api,user-api');

// REPORT
Route::get('getReportDetail/{id_pembayaran}', [ReportController::class, 'getReportDetail'])->middleware('auth:admin-api,user-api');
Route::get('myReport', [ReportController::class, 'myReport'])->middleware('auth:user-api');
Route::get('myReport/{id_pembayaran}', [ReportController::class, 'myReportDetail'])->middleware('auth:user-api');
Route::get('getReportHewan/{id_pembayaran}', [ReportController::class, 'getReportHewan'])->middleware('auth:user-api');
Route::get('getReportPenyembelihan/{id_pembayaran}', [ReportController::class, 'getReportPenyembelihan'])->middleware('auth:user-api');
Route::get('getReportPembagian/{id_pembayaran}', [ReportController::class, 'getReportPembagian'])->middleware('auth:user-api');
Route::get('getReportPengiriman/{id_pembayaran}', [ReportController::class, 'getReportPengiriman'])->middleware('auth:user-api');
Route::get('getReportSampai/{id_pembayaran}', [ReportController::class, 'getReportSampai'])->middleware('auth:user-api');
// Route::put('sendReport/{id}', [ReportController::class, 'myReportDetail'])->middleware('auth:admin-api,user-api');
Route::resource('report', ReportController::class);

// PENGIRIMAN
Route::get('getPengirimanUser/{id_pembayaran}', [PengirimanController::class, 'getPengirimanUser']);
Route::resource('pengiriman', PengirimanController::class);