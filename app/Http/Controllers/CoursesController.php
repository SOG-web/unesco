<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;


class CoursesController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        $user = User::find(auth()->id());


        if ($userRole === 'admin') {
            $courses = Course::latest()->get();

            return view('courses.index', [
                'courses' => $courses,
            ]);
        }

        if ($userRole === 'teacher') {
            $courses = Course::latest()->where('teacher_id', auth()->id())->get();

            return view('courses.index', [
                'courses' => $courses
            ]);
        }

        if ($userRole === 'students') {
            $userId = auth()->id();
            $courses = $user->courses()
                ->with([
                    'assessments', 'progress' => function ($query) use ($userId) {
                        $query->where('student_id', $userId);
                    }
                ])
                ->latest()
                ->take(3)
                ->get();

            return view('courses.index', [
                'courses' => $courses
            ]);
        }

    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        // get the course teacher profile
        $teacher = $course->teacher()->first();

        // get the course students
        $students = $course->students()->get();

        $allStudents = User::where('role', 'students')->get();

        if (auth()->user()->isStudent()) {
            $student = auth()->user();
            $progress = $student->progress()->where('course_id', $course->id)->first();

            // If the students is opening the course for the first time
            if (!$progress) {
                $progress = $student->progress()->create([
                    'course_id' => $course->id,
                    'progress' => 50.00,
                    'started' => true,
                ]);
            }

            return view('courses.show', [
                'course' => $course,
                'progress' => $progress,
                'teacher' => $teacher,
                'students' => []
            ]);
        }

        return view('courses.show', [
            'course' => $course,
            'teacher' => $teacher,
            'students' => $students,
            'allStudents' => $allStudents
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

}
