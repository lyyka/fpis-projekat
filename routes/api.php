<?php

use App\Http\Controllers\WinesController;
use App\Http\Controllers\WineSortController;
use App\Http\Controllers\WineStyleController;

Route::get('/wines', WinesController::class)->name('wines.index');
Route::get('/wine-styles', WineStyleController::class)->name('wine-styles.index');
Route::get('/wine-sorts', WineSortController::class)->name('wine-sorts.index');
