<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
Route::get('kurang', [BelajarController::class, 'kurang']);
Route::get('bagi', [BelajarController::class, 'bagi']);
Route::get('kali', [BelajarController::class, 'kali']);

Route::post('action-tambah', [BelajarController::class, 'actionTambah']);

Route::get('latihan', [LatihanController::class, 'index']);

//LOGIN
// Route::get('login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);

//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
