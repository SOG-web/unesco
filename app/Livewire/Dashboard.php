<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        $user = User::find(auth()->id());

        if ($userRole === 'admin') {
            $teachers = User::where('role', 'teacher')->latest()->take(3)->get();
            $students = User::where('role', 'students')->latest()->take(3)->get();
            $courses = Course::latest()->take(3)->get();
            return view('livewire.dashboard', [
                'teachers' => $teachers,
                'students' => $students,
                'courses' => $courses
            ]);
        }

        if ($userRole === 'teacher') {
            $students = $user->students()->latest()->take(3)->get();
            $courses = Course::latest()->where('teacher_id', auth()->id())->take(3)->get();
            $assessments = $user->courses()->with('assessments')->latest()->take(3)->get();
            return view('livewire.dashboard', [
                'students' => $students,
                'courses' => $courses, 'assessment' => $assessments, 'teachers' => []
            ]);
        }

        if ($userRole === 'students') {
            $student = User::where('id', auth()->id())->with(['courses.progress'])->first();
            $courses = $student->courses()->take(3)->get();
            $assessments = $student->courses()->with('assessments')->latest()->take(3)->get();
            $grades = $student->assessments()->get()->map(function ($assessment) {
                return $assessment->pivot->total_mark;
            });
            return view(
                'livewire.dashboard',
                [
                    'courses' => $courses,
                    'assessment' => $assessments, 'grades' => $grades
                ]
            );
        }
    }
}
