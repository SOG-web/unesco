<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Validate;

class SelectTeacher extends Component
{
    public $teachers;

    #[Validate('required')]
    public  $courseId;

    #[Validate('required|array|min:1')]
    public $selectedTeacher = '';

    public function mount()
    {
        $this->teachers = User::where('role', 'teacher')->get();
    }
    public function render()
    {
        return view('livewire.select-teacher');
    }
}
