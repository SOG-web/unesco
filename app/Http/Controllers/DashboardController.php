<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
