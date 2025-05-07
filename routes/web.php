<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/book/{id}', [Controller::class, 'show'])->name('book.show');
Route::get('/books', [Controller::class, 'books'])->name('books');
Route::get('/authors', [Controller::class, 'authors'])->name('authors');

Route::post('/chatbot/query', [ChatbotController::class, 'query']);

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware(['auth']);
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['auth']);
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth']);

// Authors routes
Route::middleware(['auth'])->group(function () {
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
});

// Books routes
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

// Authors Books routes
Route::middleware(['auth'])->group(function () {
    // Main authors-books routes
    
    // Books Authors nested routes
    Route::prefix('books')->name('books.')->group(function () {
        // List all books with their authors
        
        // Book-specific author routes
        Route::prefix('{book}')->group(function () {
            // Route::get('/authors/{author}', [AuthorBookController::class, 'show'])->name('authors.show');
            // Route::get('/authors/{author}/edit', [AuthorBookController::class, 'edit'])->name('authors.edit');
            // Route::put('/authors/{author}', [AuthorBookController::class, 'update'])->name('authors.update');
            // Route::delete('/authors/{author}', [AuthorBookController::class, 'destroy'])->name('authors.destroy');
        });
    });
});



