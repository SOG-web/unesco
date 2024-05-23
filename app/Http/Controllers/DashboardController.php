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

        $notices = $user->unreadNotices()->latest()->take(3)->get();

        $activities = $user->unreadActivities()->latest()->take(3)->get();

        if ($userRole === 'admin') {
            $teachers = User::where('role', 'teacher')->latest()->take(3)->get();
            $students = User::where('role', 'student')->latest()->take(3)->get();
            $courses = Course::latest()->take(3)->get();
            return view('dashboard.index', [
                'notices' => $notices,
                'activities' => $activities,
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses
            ]);
        } elseif ($userRole === 'teacher') {
            $students = $user->students()->latest()->take(3)->get();
            $courses = Course::latest()->where('teacher_id', auth()->id())->take(3)->get();
            $assessments = $user->courses()->with('assessments')->latest()->take(3)->get();
            return view('dashboard.index', [
                'notices' => $notices, 'activities' => $activities, 'students' => $students,
                'courses' => $courses, 'assessment' => $assessments
            ]);
        } elseif ($userRole === 'student') {
            $student = User::where('id', auth()->id())->with(['courses.progress'])->first();
            $courses = $student->courses()->take(3)->get();
            $assessments = $student->courses()->with('assessments')->latest()->take(3)->get();
            $grades = $student->assessments()->get()->map(function ($assessment) {
                return $assessment->pivot->total_mark;
            });
            return view('dashboard.index',
                [
                    'notices' => $notices, 'activities' => $activities, 'courses' => $courses,
                    'assessment' => $assessments, 'grades' => $grades
                ]);
        }

        return redirect()->route('login');
    }
}
