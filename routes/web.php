<?php

use App\Http\Controllers\CRUD\AuthorController;
use App\Http\Controllers\CRUD\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/CRUD',[BookController::class,'index'])->name('CRUD');
Route::post('/CRUD',[BookController::class,'store'])->name('CRUD.post');
Route::put('/CRUD/{id}',[BookController::class,'update'])->name('CRUD.update');
Route::delete('/CRUD/{id}',[BookController::class,'destroy'])->name('CRUD.destroy');

