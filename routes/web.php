<?php

use App\Http\Controllers\RouterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(RouterController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard');
})->middleware('auth');


require __DIR__.'/auth.php';
