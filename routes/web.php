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
    Route::get('/list', [App\Http\Controllers\SocietyController::class, 'index'])->name('admin.society.list');

    Route::get('/enable/{id}', [App\Http\Controllers\SocietyController::class, 'enable'])->name('admin.society.enable');
    Route::get('/disable/{id}', [App\Http\Controllers\SocietyController::class, 'disable'])->name('admin.society.disable');

    Route::get(
        '/datatable',
        [App\Http\Controllers\SocietyController::class, 'datatable']
    )->name('society.datatables');

    Route::get(
        '/delete/{id}',
        [App\Http\Controllers\SocietyController::class, 'destroy']
    )->name('society.delete');
});


// Route Group For Block Module.
Route::prefix('block')->group(function () {
    // Block Module
    Route::get('/create', [App\Http\Controllers\BlockController::class, 'create'])->name('admin.block.create');
    Route::post('/store', [App\Http\Controllers\BlockController::class, 'store'])->name('admin.block.store');
    Route::get('/{block}/edit', [App\Http\Controllers\BlockController::class, 'edit'])->name('admin.block.edit');
    Route::put('/update/{block}', [App\Http\Controllers\BlockController::class, 'update'])->name('admin.block.update');
    Route::get('/list', [App\Http\Controllers\BlockController::class, 'index'])->name('admin.block.list');

    Route::get('/enable/{id}', [App\Http\Controllers\BlockController::class, 'enable'])->name('admin.block.enable');
    Route::get('/disable/{id}', [App\Http\Controllers\BlockController::class, 'disable'])->name('admin.block.disable');

    Route::get(
        '/datatable',
        [App\Http\Controllers\BlockController::class, 'datatable']
    )->name('block.datatables');

    Route::get(
        '/delete/{id}',
        [App\Http\Controllers\BlockController::class, 'destroy']
    )->name('block.delete');
});


// Route Group For Plot Module.
Route::prefix('plot')->group(function () {
    // Plot Module
    Route::get('/create', [App\Http\Controllers\PlotController::class, 'create'])->name('admin.plot.create');
    Route::post('/store', [App\Http\Controllers\PlotController::class, 'store'])->name('admin.plot.store');
    Route::get('/{plot}/edit', [App\Http\Controllers\PlotController::class, 'edit'])->name('admin.plot.edit');
    Route::put('/update/{plot}', [App\Http\Controllers\PlotController::class, 'update'])->name('admin.plot.update');
    Route::get('/list', [App\Http\Controllers\PlotController::class, 'index'])->name('admin.plot.list');

    Route::get('/enable/{id}', [App\Http\Controllers\PlotController::class, 'enable'])->name('admin.plot.enable');
    Route::get('/disable/{id}', [App\Http\Controllers\PlotController::class, 'disable'])->name('admin.plot.disable');

    Route::get(
        '/datatable',
        [App\Http\Controllers\PlotController::class, 'datatable']
    )->name('plot.datatables');

    Route::get(
        '/delete/{id}',
        [App\Http\Controllers\PlotController::class, 'destroy']
    )->name('plot.delete');
});
