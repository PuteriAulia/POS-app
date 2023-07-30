<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\ProductIn;
use App\Models\Suplier;
use App\Models\Transaction;
use App\Models\User;
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

Route::get('login',[AuthController::class,'login'])->name('login')->middleware('guest');
Route::post('login',[AuthController::class,'authLogin']);
Route::get('logout',[AuthController::class,'logout'])->middleware('auth');

Route::get('/',[DashboardController::class,'index'])->middleware('auth');

Route::resource('suplier',SuplierController::class)->middleware('auth');
Route::put('suplier/{id}/hapus',[SuplierController::class,'delete'])->middleware('auth');

Route::resource('barang',ProductController::class)->middleware('auth');
Route::put('barang/{id}/hapus',[ProductController::class,'delete'])->middleware('auth');

Route::resource('barang-masuk',ProductInController::class)->middleware('auth');
Route::resource('barang-keluar',ProductOutController::class)->middleware('auth');

Route::resource('kasir',CashierController::class)->middleware('auth');
Route::get('kasir/hapus-keranjang/{id}',[CashierController::class, 'delete_cart'])->middleware('auth');
Route::post('kasir/pembayaran',[CashierController::class, 'payment_process'])->middleware('auth');
Route::post('kasir/simpan-pembayaran',[CashierController::class, 'store_payment'])->middleware('auth');

Route::resource('transaksi',TransactionController::class)->middleware('auth');
Route::get('/transaksi/printDetail/{id}',[TransactionController::class, 'print'])->middleware('auth');

Route::resource('user',UserController::class)->middleware('auth');
Route::put('user/{id}/hapus',[UserController::class,'delete'])->middleware('auth');

Route::resource('role',RoleController::class)->middleware('auth');
Route::put('role/{id}/hapus',[RoleController::class,'delete'])->middleware('auth');

Route::get('pengaturan-akun/{id}',[SettingController::class,'form_setting_account'])->middleware('auth');
Route::post('pengaturan-akun',[SettingController::class,'setting_account'])->middleware('auth');
Route::get('pengaturan-password/{id}',[SettingController::class,'form_setting_password'])->middleware('auth');
Route::post('pengaturan-password',[SettingController::class,'setting_password'])->middleware('auth');