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
                'courses' => $courses,
                'assessment' => [],
                'grades' => []
            ]);
        }

        if ($userRole === 'teacher') {
            $courses = $user->courses()->with(['students', 'assessments'])->latest()->take(3)->get();
            $students = collect();
            $assessments = collect();
            foreach ($courses as $course) {
                $students = $students->merge($course->students);
            }
            foreach ($courses as $course) {
                $assessments = $assessments->merge($course->assessments);
            }
            $students = $students->unique('id');
            $assessments = $assessments->unique('id');
            return view('livewire.dashboard', [
                'students' => $students->take(3),
                'courses' => $courses, 'assessment' => $assessments->take(3), 'teachers' => [], 'grades' => []
            ]);
        }

        if ($userRole === 'students') {
            $userId = auth()->id();
            // $student = User::where('id', auth()->id())->with(['courses.progress'])->first();
            $courses = $user->courses()
                ->with([
                    'assessments', 'progress' => function ($query) use ($userId) {
                        $query->where('student_id', $userId);
                    }
                ])
                ->latest()
                ->take(3)
                ->get();
            // $assessments = $student->courses()->with('assessments')->latest()->take(3)->get();
//            $grades = $student->assessments()->get()->map(function ($assessment) {
//                return $assessment->pivot->total_mark;
//            });
            return view(
                'livewire.dashboard',
                [
                    'courses' => $courses, 'students' => [],
                    'assessment' => [], 'grades' => [], 'teachers' => []
                ]
            );
        }
    }
}
