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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


// Route Group For Society Module.
Route::prefix('society')->group(function () {
    // Society Module
    Route::get('/create', [App\Http\Controllers\SocietyController::class, 'create'])->name('admin.society.create');
    Route::post('/store', [App\Http\Controllers\SocietyController::class, 'store'])->name('admin.society.store');
    Route::get('/{society}/edit', [App\Http\Controllers\SocietyController::class, 'edit'])->name('admin.society.edit');
    Route::put('/update/{society}', [App\Http\Controllers\SocietyController::class, 'update'])->name('admin.society.update');
    Route::get('/list', [App\Http\Controllers\SocietyController::class, 'lists'])->name('admin.society.list')->withoutMiddleware([isAdmin::class]);

    Route::get('/enable/{id}', [App\Http\Controllers\SocietyController::class, 'enable'])->name('admin.society.enable');
    Route::get('/disable/{id}', [App\Http\Controllers\SocietyController::class, 'disable'])->name('admin.society.disable');

    Route::get(
        '/datatable',
        [App\Http\Controllers\SocietyController::class, 'datatable']
    )->name('society.datatables')->withoutMiddleware([isAdmin::class]);

    Route::get(
        '/delete/{id}',
        [App\Http\Controllers\SocietyController::class, 'destroy']
    )->name('society.delete');
});