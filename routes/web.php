<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::resource('/links', LinkController::class);

    Route::get('/settings', [\App\Http\Controllers\UserController::class, 'edit'])->name('settings.edit');

    Route::put('/settings', [\App\Http\Controllers\UserController::class, 'update'])->name('settings.update');

});

Route::post('/visits/{link}', [\App\Http\Controllers\VisitController::class, 'store'])->name('visits');

Route::get('/{user:username}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');