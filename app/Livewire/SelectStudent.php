<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SelectStudent extends Component
{

    public $students;

    #[Validate('required')]
    public  $courseId;

    #[Validate('required|array|min:1')]
    public $selectedStudents = [];

    public $filteredStudents = [];

    public $search = '';

    protected $loading = false;


    public function filterStudents()
    {
        return $this->students->when($this->search, function ($student) {
            return $student->filter(fn ($student) => str_contains(
                strtolower($student->first_name),
                strtolower($this->search)
            ) ||
                str_contains(strtolower($student->last_name), strtolower($this->search)) ||
                str_contains(strtolower($student->email), strtolower($this->search)));
        });
    }


    public function addOrRemoveStudent($studentId)
    {
        if (in_array($studentId, $this->selectedStudents)) {
            $this->removeStudent($studentId);
        } else {
            $this->selectStudent($studentId);
        }
    }

    protected function selectStudent($studentId)
    {
        $this->selectedStudents[] = $studentId;
    }

    protected function removeStudent($studentId)
    {
        $this->selectedStudents = array_diff($this->selectedStudents, [$studentId]);
    }

    public function save()
    {
        if ($this->loading) {
            return null;
        }
        $this->loading = true;
        if (!auth()->user()->isAdmin()) {
            abort(401);
        }

        $this->validate();

        try {
            $course = Course::findOrFail($this->courseId);

            foreach ($this->selectedStudents as $studentId) {
                $student = User::findOrFail($studentId);
                $course->students()->attach($student->id);
                // save notification
                $student->setNotification("You have been assigned to the course {$course->title}", 'course', 'New Course Assignment');
                auth()->user()->setNotification("You have assigned {$student->first_name} to the course {$course->title}", 'course', 'Course Assigned');
            }

            session()->flash('success', 'Students assigned successfully');
            return redirect()->route('courses.show', $course->id);
        } catch (Exception $e) {
            $this->loading = false;
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
    }

    public function mount($students, $courseId, $alreadyAssignedStudents)
    {
        // dd($students); // This will output the students passed from the controller (CoursesController@show method)
        $this->courseId = $courseId;
        $alreadyAssignedStudents = $alreadyAssignedStudents->pluck('id')->toArray();
        //        $this->selectedStudents = $alreadyAssignedStudents;
        // remove already assigned students from the list of students
        $this->students = $this->students->filter(function ($student) use ($alreadyAssignedStudents) {
            return !in_array($student->id, $alreadyAssignedStudents);
        });
    }

    public function render()
    {
        return view('livewire.select-student', ['loading' => $this->loading, 'students' => $this->filterStudents()]);
    }
}
