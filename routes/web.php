<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;




// Route untuk menampilkan daftar buku
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Route untuk menampilkan form tambah buku
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

// Route untuk menyimpan buku baru
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// Route untuk menampilkan form edit buku
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');

// Route untuk mengupdate buku
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');

// Route untuk menghapus buku
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');


Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);

Route::view('/', 'home');

Route::view('dashboard', 'user.dashboard')
    ->middleware(['auth', 'verified' ,'normal'])
    ->name('dashboard');

Route::view('admin', 'admin.dashboard')
    ->middleware(['auth','verified', 'admin'])
    ->name('admin');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
