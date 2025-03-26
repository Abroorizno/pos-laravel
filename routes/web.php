<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
Route::get('kurang', [BelajarController::class, 'kurang']);
Route::get('bagi', [BelajarController::class, 'bagi']);
Route::get('kali', [BelajarController::class, 'kali']);

Route::get('latihan', [LatihanController::class, 'index']);

Route::get('login', [LoginController::class, 'login']);

Route::post('action-tambah', [BelajarController::class, 'actionTambah']);

Route::post('action-login', [LoginController::class, 'actionLogin']);
