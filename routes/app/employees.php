<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employees\Edit;
use App\Http\Controllers\Employees\Index;
use App\Http\Controllers\Employees\Store;
use App\Http\Controllers\Employees\Create;
use App\Http\Controllers\Employees\Update;

Route::middleware(['auth'])->group(function () {
    Route::prefix('employees')
        ->as('employees.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('{employee}/edit', Edit::class)->name('edit');
            Route::put('{employee}/update', Update::class)->name('update');
        });
});
