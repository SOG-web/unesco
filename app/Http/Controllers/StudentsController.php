<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;

class StudentsController extends Controller
{
    public function index()
    {

        return view('students.index');
    }

    public function store()
    {
        if (!auth()->user()->isAdmin()) {
            abort(401);
        }

        try {
            $verified = request()->validate([
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $student = User::create([
                'first_name' => $verified->first_name,
                'last_name' => $verified->last_name,
                'title' => null,
                'email' => $verified->email,
                'password' => 'password',
                'role' => 'students'
            ]);

            $student->assignRole('students');
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email is already in use.'
            ]);
        }

        return redirect('/students')->with('status', 'Student created successfully.');
    }

    public function create()
    {
        return view('students.create');
    }

    public function show($id)
    {
        $student = User::findOrFail($id);

        if ($student->role !== 'students') {
            abort(404);
        }

        return view('students.show', [
            'student' => $student
        ]);
    }
}
