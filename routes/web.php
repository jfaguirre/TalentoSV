<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('inicio');
    });


    Route::middleware(['auth', 'verified'])->group(function () {

        // Dashboard
        Route::view('/dashboard', 'dashboard')->name('dashboard');

        // CRUD Perfil de usuario

    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';
