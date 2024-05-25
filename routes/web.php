<?php

use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradesController;
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

        Route::get('students', 'index');

        Route::middleware('can:admin-access')->group(function () {
            Route::get('students/create', 'create');
            Route::post('students/store', 'store');
        });

        Route::get('students/{id}', 'show');

    })->middleware(['can:admin-access', 'can:teacher-access']);

    Route::controller(CoursesController::class)->group(function () {

        Route::get('courses', 'index');

        Route::middleware('can:admin-access')->group(function () {
            Route::get('courses/create', 'create');
            Route::post('courses/store', 'store');
        });

        Route::middleware('can:admin-access')->group(function () {
            Route::post('courses/addStudents', 'assignStudents');
        });

        Route::get('courses/{id}', 'show');

    });

    Route::controller(NoticesController::class)->group(function () {

        Route::get('notices', 'index');

        Route::middleware(['can:admin-access', 'can:teacher-access'])->group(function () {
            Route::get('notices/create', 'create');
            Route::post('notices/store', 'store');
        });

    });

    Route::controller(TeachersController::class)->group(function () {
        Route::get('teachers', 'index');
        Route::get('teachers/create', 'create');
        Route::post('teachers/store', 'store');
        Route::get('teachers/{id}', 'show');
    })->middleware('can:admin-access');

    Route::controller(AssessmentsController::class)->group(function () {
        Route::get('assessments', 'index');
        Route::get('assessments/create', 'create')->can('teacher-access');
        Route::post('assessments/store', 'store')->can('teacher-access');
        Route::get('assessments/{id}', 'show');
    })->middleware(['can:teacher-access', 'can:students-access']);

    Route::controller(GradesController::class)->group(function () {
        Route::get('grades', 'index');
    })->middleware('can:students-access');

});


require __DIR__.'/auth.php';
