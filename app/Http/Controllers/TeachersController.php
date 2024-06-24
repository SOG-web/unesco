<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = auth()->user()->teachers()->get();
        return view('teachers.index', ['teachers' => $teachers]);
    }

    public function store()
    {
        $verified = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $teacher = User::create([
            'first_name' => $verified->first_name,
            'last_name' => $verified->last_name,
            'title' => $verified->title,
            'email' => $verified->email,
            'password' => 'password',
            'role' => 'teacher'
        ]);

        $teacher->assignRole('teacher');

        return redirect('/teachers')->with('status', 'Teacher created successfully.');
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function show(string $id)
    {
        $teacher = User::findOrFail($id);
        if ($teacher->role !== 'teacher') {
            abort(404, 'Teacher not found.');
        }
        return view('teachers.show', [
            'teacher' => $teacher,
        ]);
    }
}
