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

Route::group(['middleware' => 'guest'], function(){
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('login',[AuthController::class,'authLogin']);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('/',[DashboardController::class,'index']);
    
    Route::resource('suplier',SuplierController::class);
    Route::put('suplier/{id}/hapus',[SuplierController::class,'delete']);

    Route::resource('barang',ProductController::class);
    Route::put('barang/{id}/hapus',[ProductController::class,'delete']);

    Route::resource('barang-masuk',ProductInController::class);
    Route::resource('barang-keluar',ProductOutController::class);

    Route::resource('kasir',CashierController::class);
    Route::get('kasir/hapus-keranjang/{id}',[CashierController::class, 'delete_cart']);
    Route::post('kasir/pembayaran',[CashierController::class, 'payment_process']);
    Route::post('kasir/simpan-pembayaran',[CashierController::class, 'store_payment']);

    Route::resource('transaksi',TransactionController::class);
    Route::get('/transaksi/printDetail/{id}',[TransactionController::class, 'print']);
    Route::post('transaksi/report',[TransactionController::class, 'report']);

    Route::resource('user',UserController::class);
    Route::put('user/{id}/hapus',[UserController::class,'delete']);

    Route::resource('role',RoleController::class);
    Route::put('role/{id}/hapus',[RoleController::class,'delete']);

    Route::get('pengaturan-akun/{id}',[SettingController::class,'form_setting_account']);
    Route::post('pengaturan-akun',[SettingController::class,'setting_account']);
    Route::get('pengaturan-password/{id}',[SettingController::class,'form_setting_password']);
    Route::post('pengaturan-password',[SettingController::class,'setting_password']);
});


