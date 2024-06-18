<?php

use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SessionController::class, 'create']);

Route::middleware('guest')->group(function () {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [SessionController::class, 'destroy']);
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('students', [StudentsController::class, 'index'])->name('students')
        ->can('teacher-or-admin-access');

    Route::get('courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('courses/create', [CoursesController::class, 'create'])->name('courses.create')->can('teacher-access');
    Route::post('courses/store', [CoursesController::class, 'store'])->name('courses.store')->can('teacher-access');
    Route::get('courses/{id}', [CoursesController::class, 'show'])->name('courses.show');


    Route::get('notices', [NoticesController::class, 'index'])->name('notices');


    Route::get('teachers', [TeachersController::class, 'index'])->name('teachers')->can('admin-access');

    Route::controller(AssessmentsController::class)->group(function () {
        Route::get('assessments', 'index')->name('assessments');
        Route::get('assessments/create', 'create')->can('teacher-access')->name('assessments.create');
        Route::get('assessments/start/{id}', 'start')->name('assessments.start');
        Route::get('assessments/{id}', 'show')->name('assessments.show');
    })->middleware(['can:teacher-access', 'can:students-access']);

    Route::get('grades', [GradesController::class, 'index'])->name('grades')->can('students-access');

});

