<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        $user = User::find(auth()->id());

        if ($userRole === 'admin') {
            $teachers = User::where('role', 'teacher')->latest()->take(3)->get();
            $students = User::where('role', 'students')->latest()->take(3)->get();
            $courses = Course::latest()->take(3)->get();
            return view('dashboard.index', [
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses
            ]);
        } elseif ($userRole === 'teacher') {
            $students = $user->students()->latest()->take(3)->get();
            $courses = Course::latest()->where('teacher_id', auth()->id())->take(3)->get();
            $assessments = $user->courses()->with('assessments')->latest()->take(3)->get();
            return view('dashboard.index', [
                 'students' => $students,
                'courses' => $courses, 'assessment' => $assessments
            ]);
        } elseif ($userRole === 'students') {
            $student = User::where('id', auth()->id())->with(['courses.progress'])->first();
            $courses = $student->courses()->take(3)->get();
            $assessments = $student->courses()->with('assessments')->latest()->take(3)->get();
            $grades = $student->assessments()->get()->map(function ($assessment) {
                return $assessment->pivot->total_mark;
            });
            return view('dashboard.index',
                [
                     'courses' => $courses,
                    'assessment' => $assessments, 'grades' => $grades
                ]);
        }

        return redirect()->route('login');
    }
}
