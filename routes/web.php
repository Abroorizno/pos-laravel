<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionContoller;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('belajar', [BelajarController::class, 'index']);
// Route::get('tambah', [BelajarController::class, 'tambah']);
// Route::get('kurang', [BelajarController::class, 'kurang']);
// Route::get('bagi', [BelajarController::class, 'bagi']);
// Route::get('kali', [BelajarController::class, 'kali']);

// Route::post('action-tambah', [BelajarController::class, 'actionTambah']);

// Route::get('latihan', [LatihanController::class, 'index']);

//LOGIN
// Route::get('login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::get('logout', [LoginController::class, 'logout']);

//DASHBOARD
Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('pos', TransactionContoller::class);

    Route::get('print/{id}', [TransactionContoller::class, 'print'])->name('print');
    Route::get('get-products/{id}', [TransactionContoller::class, 'getProduct']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
