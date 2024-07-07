<?php

namespace App\Livewire;

use Livewire\Component;

class StudentAssessmentList extends Component
{
    public function render()
    {
        $userId = auth()->id();
        $user = auth()->user();

        $courses = $user->courses()
            ->with([
                'assessments' => function ($query) use ($userId) {
                    $query->with([
                        'students' => function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        }
                    ]);
                }
            ])
            ->latest()
            ->get();

        $assessments = $courses->flatMap(function ($course) {
            return $course->assessments->map(function ($assessment) use ($course) {
                $assessment->completed = $assessment->students->isNotEmpty() && $assessment->students->first()->pivot->status !== 'pending';
                $assessment->course_name = $course->title; // Add the course name to the assessment
                return $assessment;
            });
        });
        return view('livewire.student-assessment-list', [
            'assessments' => $assessments,
        ]);
    }
}
