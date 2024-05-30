<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Students extends Component
{

    public bool $createStudent = false;

    public bool $viewStudent = false;

    public User $user;

    public function closeModal($type)
    {
        if ($type == 'showStudent') {
            $this->viewStudent = false;
        }
    }

    public function render()
    {

        $user = auth()->user();

        $students = $user->students()->get();

        return view('livewire.students', [
            'students' => $students,
        ]);
    }
}
