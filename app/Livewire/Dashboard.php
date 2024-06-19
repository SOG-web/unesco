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
            $assessments = auth()->user()->assessments()->with('students.pivot')->get();
            foreach ($courses as $course) {
                $students = $students->merge($course->students);
            }
            $students = $students->unique('id');
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
            $assessments = $courses->map(function ($course) {
                return $course->assessments->flatten();
            })->flatten()->take(3);


            // Get the grades of the student
            $grades = $user->assessmentes()
                ->with('course') // Include the course details
                ->wherePivot('status', '<>', 'pending') // Exclude incomplete assessments
                ->wherePivot('total_mark', '<>', null) // Exclude assessments without a total mark
                ->get()->toArray();

            return view(
                'livewire.dashboard',
                [
                    'courses' => $courses, 'students' => [],
                    'assessments' => $assessments, 'grades' => $grades, 'teachers' => []
                ]
            );
        }
    }
}
