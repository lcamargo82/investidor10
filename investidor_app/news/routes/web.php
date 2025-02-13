<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticia/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/noticias', [NewsController::class, 'search'])->name('news.search');

Route::prefix('admin')->group(function() {
    Route::get('/', [NewsController::class, 'listNews'])->name('news.listNews');
    Route::get('/news', [NewsController::class, 'searchListNews'])->name('listNews.search');
    Route::get('/news/{id}', [NewsController::class, 'showNews'])->name('admin.news.show');

    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/categoria', [CategoryController::class, 'search'])->name('admin.category.search');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

});
