<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoolerController;

Route::get('/', [CoolerController::class, 'index'])->name('home');

// Cooler routes
Route::get('/coolers', [CoolerController::class, 'index'])->name('coolers.index');
Route::get('/coolers/import', [CoolerController::class, 'showImportForm'])->name('coolers.import-form');
Route::post('/coolers/import', [CoolerController::class, 'import'])->name('coolers.import');
Route::get('/coolers/{cooler}', [CoolerController::class, 'show'])->name('coolers.show');
Route::get('/coolers/{cooler}/edit', [CoolerController::class, 'edit'])->name('coolers.edit');
Route::put('/coolers/{cooler}', [CoolerController::class, 'update'])->name('coolers.update');
