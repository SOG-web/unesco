<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        $user = User::find(auth()->id());

        $notices = $user->unreadNotices();

        $activities = $user->unreadActivities();

        if ($userRole === 'admin') {
            return view('admin.dashboard.index', ['notices' => $notices, 'activities' => $activities]);
        } elseif ($userRole === 'teacher') {
            return view('teacher.dashboard', ['notices' => $notices, 'activities' => $activities]);
        } elseif ($userRole === 'student') {
            return view('student.dashboard', ['notices' => $notices, 'activities' => $activities]);
        }

        return redirect()->route('login');
    }
}
