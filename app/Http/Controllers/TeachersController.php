<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeachersController extends Controller
{
    public function index()
    {
        return view('admin.teachers.index');
    }

    public function store()
    {
        $verified = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'profile_pic' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // upload profile pic

        $teacher = User::create([
            'first_name' => $verified->first_name,
            'last_name' => $verified->last_name,
            'title' => $verified->title,
            'email' => $verified->email,
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);

        $teacher->assignRole('teacher');

        return redirect()->route('teachers.index');
    }

    public function create()
    {
        return view('admin.teachers.create');
    }
}
