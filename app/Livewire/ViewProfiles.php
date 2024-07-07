<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewProfiles extends Component
{
    public string $type;

    public string $title;

    public $userId;

    public User $user;

    public $courses;

    public $students;

    public $assessmentCount;

    public $completedAssessments;

    public $backUrl = 'students';

    public function mount($type, $student, $title, $backUrl = 'students')
    {
        $this->type = $type;
        $this->backUrl = $backUrl;
        $this->title = $title;
        $this->user = $student;
        $this->userId = $student->id;
        $this->loadData();
    }

    private function loadData()
    {
        if ($this->user->role !== 'admin') {
            // find the courses the user is enrolled in from the courses pivot table
            $admin = User::find(auth()->id());
            $studentCourses = $admin->getStudentCourses($this->userId);
            $this->courses = $studentCourses && $studentCourses->isNotEmpty() ? $studentCourses->pluck('slug')->toArray() : [];
        } else {
            $this->courses = $this->user->courses->pluck('slug')->toArray();
            $this->students = $this->user->students->count();
        }

        $assessments = $this->user->assessments;
        $this->assessmentCount = $assessments->count();

        $this->completedAssessments = $assessments->filter(function ($assessment) {
            return $assessment->status === 'completed';
        })->count();
    }

    public function render()
    {
        $this->loadData();
        return view('livewire.view-profiles', [
            'user' => $this->user,
            'courses' => $this->courses,
            'assessmentCount' => $this->assessmentCount,
            'completedAssessments' => $this->completedAssessments,
        ]);
    }
}
