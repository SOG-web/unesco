<?php

namespace App\Http\Controllers;

class GradesController extends Controller
{
    public function index()
    {
        return view('grades.index');
    }
}
