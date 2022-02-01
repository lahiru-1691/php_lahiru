<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesPersonController;

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

Route::get('/', [SalesPersonController::class, 'index'])->name('list');

Route::get('/add', [SalesPersonController::class, 'create'])->name('add');

Route::post('/add', [SalesPersonController::class, 'store'])->name('save');

Route::get('/edit/{id}', [SalesPersonController::class, 'edit'])->name('edit');

Route::post('/edit/{id}', [SalesPersonController::class, 'update'])->name('update');


