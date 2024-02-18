<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\WinesController;
use App\Http\Controllers\WineSortController;
use App\Http\Controllers\WineStyleController;

Route::get('/wines', [WinesController::class, 'index'])->name('wines.index');
Route::get('/wine-styles', [WineStyleController::class, 'index'])->name('wine-styles.index');
Route::get('/wine-sorts', [WineSortController::class, 'index'])->name('wine-sorts.index');

Route::put('/order/{order?}', [OrderController::class, 'update'])->name('order.update');
Route::put('/order/remove/{order}', [OrderController::class, 'removeUpdate'])->name('order.remove-update');
