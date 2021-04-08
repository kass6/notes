<?php

use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;

Route::get('/share', [ShareController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('share');

Route::post('/share', [ShareController::class, 'share'])
    ->middleware(['auth', 'verified'])
    ->name('share-process');
