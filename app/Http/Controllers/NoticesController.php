<?php

namespace App\Http\Controllers;

class NoticesController extends Controller
{
    public function index()
    {

        return view('notices.index');
    }

    public function create()
    {
        if (!auth()->user()->isTeacher() || !auth()->user()->isAdmin()) {
            abort(401);
        }

        return view('notices.create');
    }
}
