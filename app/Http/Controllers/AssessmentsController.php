<?php

namespace App\Http\Controllers;

use App\Models\Assessment;

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
        $assessment = Assessment::where('id', $id)->with('students')->firstOrFail();

        return view('assessments.show', ['assessment' => $assessment]);
    }
}
