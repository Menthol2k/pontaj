<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Activities\Edit;
use App\Http\Controllers\Activities\Show;
use App\Http\Controllers\Activities\Index;
use App\Http\Controllers\Activities\Store;
use App\Http\Controllers\Activities\Create;
use App\Http\Controllers\Activities\Export;
use App\Http\Controllers\Activities\Update;

Route::middleware(['auth'])->group(function () {
    Route::prefix('activities')
        ->as('activities.')
        ->namespace('')
        ->group(function () {
            Route::get('', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::post('store', Store::class)->name('store');
            Route::get('export/{week}/{year}', Export::class)->name('export');
            Route::get('export/{week}/{year}/pdf', [Export::class, 'pdf'])->name('export.pdf');
            Route::get('{date}/verify', function ($date) {
                $activity = Activity::where('date', $date)->first();
                if ($activity) {
                    return response()->json(['message' => 'Deja exista un pontaj pentru aceasta data'], 200);
                } else {
                    return response()->json(['message' => 'Totul este in regula'], 200);
                }
            });
            Route::get('{activity}/show', Show::class)->name('show');
            Route::get('{activity}/edit', Edit::class)->name('edit');
            Route::patch('{activity}/update', Update::class)->name('update');
        });
});
