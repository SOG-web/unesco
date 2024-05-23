<?php

namespace App\Http\Controllers;

class AssessmentsController extends Controller
{
    public function index()
    {
        return view('assessments.index');
    }

    public function create()
    {
        return view('assessments.create');
    }

    public function store()
    {

    }

    public function show($id)
    {
        return view('assessments.show');
    }
}
