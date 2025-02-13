<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rotas de usuário
Route::resource('users', UserController::class)->except(['show']);
// Rotas de livros
Route::resource('books', BookController::class)->except(['show']);
// Rotas de empréstimos
Route::resource('book_loans', BookLoanController::class)->except(['show', 'destroy']);