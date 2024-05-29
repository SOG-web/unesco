<?php

namespace App\Livewire;

use Livewire\Component;

class Students extends Component
{

    public bool $createStudent = false;

    public function render()
    {

        $students = auth()->user()->students()->get();

        return view('livewire.students', [
            'students' => $students
        ]);
    }
}
