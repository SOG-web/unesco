<?php

namespace App\Livewire;

use Livewire\Component;

class AssessmentList extends Component
{
    public string $selectedTab = 'all-tab';

    public function render()
    {

        // for all assessments that belong to the authenticated user that all assessment_student total_mark is not null, change the graded_status to graded
        auth()->user()->assessments()->whereHas('students', function ($query) {
            $query->whereNotNull('total_mark');
        })->update(['graded_status' => 'graded']);

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
