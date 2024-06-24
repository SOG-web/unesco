<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentStudent;

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

    public function grade($id)
    {
        $assessment = AssessmentStudent::where('id', $id)->firstOrFail();
        $student = $assessment->user()->get();

        return view('assessments.grade', ['assessment' => $assessment, 'student' => $student]);
    }
}
