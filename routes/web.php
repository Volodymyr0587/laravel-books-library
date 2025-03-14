<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);

    Route::get('/covers', function () {
        $books = auth()->user()->books()
            ->select('id', 'cover', 'title')
            ->whereNotNull('cover')
            ->without('authors', 'genres')
            ->paginate(12);
        return view('books.covers', compact('books'));
    })->name('books.covers');
});

require __DIR__.'/auth.php';
