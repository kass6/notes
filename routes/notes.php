<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NoteController::class, 'index'])->name('home');

Route::get('/my-notes', [NoteController::class, 'myIndex'])
    ->middleware(['auth', 'verified'])
    ->name('my-notes');

Route::get('/shared-notes', [NoteController::class, 'sharedIndex'])
    ->middleware(['auth', 'verified'])
    ->name('shared-notes');

Route::get('/note/create', [NoteController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('note-create');

Route::post('/note/create', [NoteController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('note-store');

Route::get('/note/edit/{note}', [NoteController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('note-edit');

Route::post('/note/edit/{note}', [NoteController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('note-update');

Route::get('/note/{note}', [NoteController::class, 'show'])
    ->name('note');
