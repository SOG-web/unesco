<?php

namespace App\Livewire;

use Livewire\Component;

class AssessmentList extends Component
{
    public string $selectedTab = 'all-tab';

    public function render()
    {
        $allAssessments = auth()->user()->assessments()->with('students.pivot')->get();
        $gradedAssessments = auth()->user()->assessments()->where('graded_status',
            'graded')->with('students.pivot')->get();
        $ungradedAssessments = auth()->user()->assessments()->where('graded_status',
            'ungraded')->with('students.pivot')->get();
        return view('livewire.assessment-list', [
            'allAssessments' => $allAssessments,
            'gradedAssessments' => $gradedAssessments,
            'ungradedAssessments' => $ungradedAssessments,
        ]);
    }
}
