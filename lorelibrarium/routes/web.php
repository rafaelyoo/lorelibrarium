<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/books', BookController::class);
Route::get('/system/report', [ReportController::class, 'generate'])->name('books.relatorio');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
