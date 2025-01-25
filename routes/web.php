<?php

use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\CRUD\AuthorController;
use App\Http\Controllers\CRUD\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
Route::resource('CRUD', BookController::class);
});

//Route Auth
Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');

