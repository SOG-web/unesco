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
    Route::get('students/{id}', [StudentsController::class, 'show'])->name('students.show')
        ->can('teacher-or-admin-access');

    Route::get('courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('courses/create', [CoursesController::class, 'create'])->name('courses.create')->can('teacher-access');
    Route::post('courses/store', [CoursesController::class, 'store'])->name('courses.store')->can('teacher-access');
    Route::get('courses/{id}', [CoursesController::class, 'show'])->name('courses.show');


    Route::get('teachers', [TeachersController::class, 'index'])->name('teachers')->can('admin-access');
    Route::get('teachers/{id}', [TeachersController::class, 'show'])->name('teachers.show')->can('admin-access');

    Route::get('grades', [GradesController::class, 'index'])->name('grades')->can('students-access');

    Route::get('assessments', [AssessmentsController::class, 'index'])->name('assessments');
    Route::get('assessments/create',
        [AssessmentsController::class, 'create'])->can('teacher-access')->name('assessments.create');
    Route::get('assessment/grade/{id}',
        [AssessmentsController::class, 'grade'])->can('teacher-access')->name('assessment.grade');
    Route::get('assessments/start/{id}',
        [AssessmentsController::class, 'start'])->can('students-access')->name('assessments.start');
    Route::get('assessments/{id}',
        [AssessmentsController::class, 'show'])->can('teacher-access')->name('assessments.show');

    Route::get('notices', [NoticesController::class, 'index'])->name('notices');

});

