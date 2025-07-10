<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Activities\Index;
use App\Http\Controllers\Activities\Create;
use App\Http\Controllers\Activities\Store;
use App\Http\Controllers\Activities\Export;
use App\Models\Activity;

Route::middleware(['auth'])->group(function () {
    Route::prefix('activities')
        ->as('activities.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('export/{week}/{year}', Export::class)->name('export');
            Route::get('{date}/verify', function ($date) {
                $activity = Activity::where('date', $date)->first();
                if($activity) {
                    return response()->json(['message' => 'Deja exista un pontaj pentru aceasta data'], 200);
                } else {
                    return response()->json(['message' => 'Totul este in regula'], 200);
                }
            });
        });
});
