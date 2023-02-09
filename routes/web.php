<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\BookController;
use Blocs\Middleware\StaticGenerator;

Route::prefix('books')
	->name('book.')
	->group(function () {
		Route::get('/', [BookController::class, 'index'])->middleware(StaticGenerator::class)->name('index');
		Route::get('/create', [BookController::class, 'create'])->name('create');
		Route::post('/', [BookController::class, 'store'])->name('store');
		Route::get('/{id}/edit', [BookController::class, 'edit'])->where('id', '[0-9]+')->name('edit');
		Route::post('/{id}', [BookController::class, 'update'])->where('id', '[0-9]+')->name('update');
		Route::post('/{id}/destroy', [BookController::class, 'destroy'])->where('id', '[0-9]+')->name('destroy');
	}
);
