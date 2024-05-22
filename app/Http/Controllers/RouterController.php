<?php

namespace App\Http\Controllers;

class RouterController extends Controller
{
    public function dashboard()
    {
        $userRole = auth()->user()->role;
        if ($userRole === 'admin') {
            return view('admin.dashboard');
        } elseif ($userRole === 'teacher') {
            return view('teacher.dashboard');
        } elseif ($userRole === 'student') {
            return view('student.dashboard');
        }

        return redirect()->route('login');
    }
}
