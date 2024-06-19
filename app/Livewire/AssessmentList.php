<?php

namespace App\Livewire;

use Livewire\Component;

class AssessmentList extends Component
{
    public string $selectedTab = 'all-tab';

    public function render()
    {
        $allAssessments = auth()->user()->assessments()->with('students')->get();
        $gradedAssessments = auth()->user()->assessments()->where('graded_status',
            'graded')->with('students')->get();
        $ungradedAssessments = auth()->user()->assessments()->where('graded_status',
            'ungraded')->with('students')->get();
        return view('livewire.assessment-list', [
            'allAssessments' => $allAssessments,
            'gradedAssessments' => $gradedAssessments,
            'ungradedAssessments' => $ungradedAssessments,
        ]);
    }
}
