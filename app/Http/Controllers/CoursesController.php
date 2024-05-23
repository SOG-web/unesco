<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;

class CoursesController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        if ($userRole === 'admin') {
            $courses = Course::latest()->get();

            return view('courses.index', [
                'courses' => $courses
            ]);
        }

        if ($userRole === 'teacher') {
            $courses = Course::latest()->where('teacher_id', auth()->id())->get();

            return view('courses.index', [
                'courses' => $courses
            ]);
        }

        if ($userRole === 'student') {
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

        if (auth()->user()->isStudent()) {
            $student = auth()->user();
            $progress = $student->progress()->where('course_id', $course->id)->first();

            // If the student is opening the course for the first time
            if (!$progress) {
                $progress = $student->progress()->create([
                    'course_id' => $course->id,
                    'progress' => 20.00,
                    'started' => true,
                ]);
            }

            return view('courses.show', [
                'course' => $course,
                'progress' => $progress
            ]);
        }

        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function store()
    {
        if (!auth()->user()->isTeacher()) {
            abort(401);
        }

        $validate = request()->validate([
            'title' => ['required', 'string', 'max:255', 'unique:courses'],
            'duration' => ['required', 'string'],
            'thumbnail' => ['required', 'file', 'image'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'video_url' => ['nullable', 'string'],
            'audio_url' => ['nullable', 'string'],
            'link' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'unique:courses'],
        ]);

        // Handle the thumbnail upload
        if (request()->hasFile('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            $thumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('thumbnails'), $thumbnailName);
        }

        // Create the course
        Course::create([
            'teacher_id' => auth()->id(),
            'title' => $validate['title'],
            'duration' => $validate['duration'],
            'thumbnail' => $thumbnailName ?? null,
            'start_date' => $validate['start_date'],
            'end_date' => $validate['end_date'],
            'type' => $validate['type'],
            'description' => $validate['description'],
            'video_url' => $validate['video_url'],
            'audio_url' => $validate['audio_url'],
            'link' => $validate['link'],
            'slug' => $validate['slug'],
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function assignStudents()
    {
        if (!auth()->user()->isAdmin()) {
            abort(401);
        }

        try {
            $validate = request()->validate([
                'course_id' => 'required',
                'student_ids' => ['required', 'array']
            ]);

            $courseId = $validate->course_id;
            $studentIds = $validate->student_ids;

            // Retrieve the course
            $course = Course::find($courseId);

            if (!$course) {
                abort(404, 'Course not found');
            }

            // Retrieve the students
            $students = User::whereIn('id', $studentIds)->get();

            if ($students->isEmpty()) {
                abort(404, 'Students not found');
            }

            // Attach the students to the course
            foreach ($students as $student) {
                $course->students()->attach($student->id);
            }

            return redirect('/courses/'.$courseId)->with('status', 'Students added successfully');
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'Inavlid input data'
            ]);
        }
    }
}
