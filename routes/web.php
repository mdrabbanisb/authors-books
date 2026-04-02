<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FrontController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/books', [FrontController::class, 'books'])->name('books.list');
Route::get('/book/{book}', [FrontController::class, 'show'])->name('book.show');
Route::get('/authors', [FrontController::class, 'authors'])->name('authors.list');
Route::get('/author/{author}', [FrontController::class, 'show'])->name('authors.show');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'layouts.dashboard')->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);

});