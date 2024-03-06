<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GestionSallesController;
use App\Http\Controllers\StudentController;

Route::get('/', [GestionSallesController::class, 'index']);
Route::match(['get', 'post'], '/apirequest', [ApiController::class, 'index']);

Route::get('/gestion-salles', [GestionSallesController::class, 'index'])->name('gestion-salles.index');

Route::middleware('auth')->group(function () {

    Route::prefix('gestion-salles')->name('gestion-salles.')->group(function () {
        Route::get('/create', [GestionSallesController::class, 'create'])->name('create');
        Route::post('/', [GestionSallesController::class, 'store'])->name('store');
        Route::get('/{salle}/edit', [GestionSallesController::class, 'edit'])->name('edit');
        Route::put('/{salle}', [GestionSallesController::class, 'update'])->name('update');
        Route::delete('/{salle}', [GestionSallesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
