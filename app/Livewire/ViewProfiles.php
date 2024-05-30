<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfiles extends Component
{
    public string $type;

    public string $title;

    public string $userId;

    public User $user;

    public $courses;

    public $assessmentCount;

    public $completedAssessments;

    public function mount($type, $studentId, $title)
    {
        $this->type = $type;
        $this->title = $title;
        $this->userId = $studentId;
    }

    public function render()
    {
        $this->user = User::find($this->userId);
        // find the courses the user is enrolled in from the courses pivot table
        $admin = User::find(auth()->id());
        $studentCourses = $admin->getStudentCourses($this->userId);
        $this->courses = $studentCourses && $studentCourses->isNotEmpty() ? $studentCourses->pluck('slug')->toArray() : [];

        $assessments = $this->user->assessments;
        $this->assessmentCount = $assessments->count();

        $this->completedAssessments = $assessments->filter(function ($assessment) {
            return $assessment->status === 'completed';
        })->count();
        return view('livewire.view-profiles', [
            'user' => User::find($this->userId),
            'courses' => $this->courses,
            'assessmentCount' => $this->assessmentCount,
            'completedAssessments' => $this->completedAssessments,
        ]);
    }
}
