<?php

namespace App\Livewire;

use Livewire\Component;

class Grades extends Component
{
    public function render()
    {
        $userId = auth()->id();
        $grades = auth()->user()->courses()
            ->with([
                'assessments', 'assessment_student', 'progress' => function ($query) use ($userId) {
                    $query->where('student_id', $userId);
                }
            ])
            ->latest()
            ->get();
        return view('livewire.grades', [
            'grades' => $grades
        ]);
    }
}
