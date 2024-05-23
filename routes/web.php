<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index');
    });

    Route::controller(StudentsController::class)->group(function () {
        Route::middleware('can:admin-access')->group(function () {
            Route::get('students/create', 'create');
        });

    })->middleware(['can:admin-access', 'can:teacher-access']);

    Route::controller(CoursesController::class)->group(function () {
        Route::middleware(['can:admin-access', 'can:teacher-access'])->group(function () {
            Route::get('courses/create', 'create');
        });

        Route::middleware('can:admin-access')->group(function () {
            Route::post('courses/addStudents', 'addStudents');
        });

    });

    Route::controller(NoticesController::class)->group(function () {
        Route::middleware(['can:admin-access', 'can:teacher-access'])->group(function () {
            Route::get('notices/create', 'create');
        });

    });

    Route::controller(TeachersController::class)->group(function () {
    })->middleware('can:admin-access');

});


require __DIR__.'/auth.php';
