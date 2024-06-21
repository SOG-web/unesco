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

        $this->loadData();
    }

    private function loadData()
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
    }

    public function userfn()
    {
        return User::find($this->userId);
    }

    public function getAssessmentCount()
    {
        return $this->assessmentCount;
    }

    public function getCompletedAssessments()
    {
        return $this->completedAssessments;
    }

    public function getCourse()
    {
        return $this->courses;
    }

    public function render()
    {
        $this->loadData();
        return view('livewire.view-profiles', [
            'user' => $this->userfn(),
            'courses' => $this->getCourse(),
            'assessmentCount' => $this->getAssessmentCount(),
            'completedAssessments' => $this->getCompletedAssessments(),
        ]);
    }
}
