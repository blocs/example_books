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

Route::get('/books', '\App\Http\Controllers\BookController@index')->name('book.index');
Route::get('/books/register', '\App\Http\Controllers\BookController@register')->name('book.register');
Route::post('/books', '\App\Http\Controllers\BookController@store')->name('book.store');
Route::get('/books/{id}', '\App\Http\Controllers\BookController@edit')->name('book.edit');
Route::post('/books/{id}', '\App\Http\Controllers\BookController@update')->name('book.update');
Route::post('/books/{id}/destroy', '\App\Http\Controllers\BookController@destroy')->name('book.destroy');

// 本に関するCRUD（blocs利用）.
Route::get('/books-with-blocs', '\App\Http\Controllers\BookController@indexWithBlocs');
