<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class CoursesController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;


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
            $student = User::where('id', auth()->id())->with(['courses.progress'])->first();
            $courses = $student->courses()->get();

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
                    'progress' => 20.00,
                    'started' => true,
                ]);
            }

            return view('courses.show', [
                'course' => $course,
                'progress' => $progress,
                'teacher' => $teacher
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

    public function store()
    {
//        if (!auth()->user()->isTeacher()) {
//            abort(401);
//        }

        dd(request()->all());

        $validate = request()->validate([
            'title' => ['required', 'string', 'max:255', 'unique:courses'],
            'duration' => ['required', 'string'],
            'thumbnail' => ['nullable', 'file', 'image'],
            'date' => ['nullable', 'date'],
            'time' => ['nullable', 'string'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'link' => ['nullable', 'string'],
            'upload' => ['nullable', 'file'],
        ]);

        // Handle the thumbnail upload
        if (request()->hasFile('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            $thumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('thumbnails'), $thumbnailName);
        }

        if (request()->hasFile('upload')) {
            $upload = request()->file('upload');
            $uploadName = time().'.'.$upload->getClientOriginalExtension();
            $upload->move(public_path('uploads'), $uploadName);
        }

        // Create the course
        Course::create([
            'teacher_id' => auth()->id(),
            'title' => $validate['title'],
            'duration' => $validate['duration'],
            'thumbnail' => $thumbnailName ?? null,
            'date' => $validate['date'],
            'time' => $validate['time'],
            'type' => $validate['type'],
            'description' => $validate['description'],
            'video_url' => $validate['video_url'],
            'audio_url' => $validate['audio_url'],
            'link' => $uploadName ?? null,
            'slug' => Str::slug($validate['title']),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }
}
