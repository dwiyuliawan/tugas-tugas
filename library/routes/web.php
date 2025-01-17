<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// Route::get('/catalogs/create', [App\Http\Controllers\CatalogController::class, 'create']);
// Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
// Route::get('/catalogs/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
// Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
// Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);
Route::get('/api/publishers', [App\Http\Controllers\PublisherController::class, 'api']);
Route::get('/api/authors', [App\Http\Controllers\AuthorController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/books', [App\Http\Controllers\BookController::class, 'api']);

Route::resource('/transactions', App\Http\Controllers\TransactionController::class);
Route::resource('/publishers', App\Http\Controllers\PublisherController::class);
Route::resource('/catalogs', App\Http\Controllers\CatalogController::class);
Route::resource('/authors', App\Http\Controllers\AuthorController::class);
Route::resource('/members', App\Http\Controllers\MemberController::class);
Route::resource('/books', App\Http\Controllers\BookController::class);

Route::get('/transactions/{transaction}/show', [App\Http\Controllers\TransactionController::class, 'show']);

Route::get('/test_spatie', [App\Http\Controllers\Controller::class, 'test_spatie']);
