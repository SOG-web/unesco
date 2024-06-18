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

    public function start($id)
    {

        $assessment = Assessment::where('id', $id)->firstOrFail();

        return view('assessments.start', ['assessment' => $assessment]);
    }

    public function show($id)
    {
        if (auth()->user()->role === 'teacher') {
            $assessment = Assessment::where('id', $id)->with('students')->firstOrFail();

            return view('assessments.show', ['assessment' => $assessment]);
        }

        $assessment = Assessment::where('id', $id)->firstOrFail();

        return view('assessments.show', ['assessment' => $assessment]);

    }
}
