<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Teachers extends Component
{

    public bool $createTeacher = false;

    public bool $viewTeacher = false;

    public User $user;

    public function closeModal($type)
    {
        if ($type == 'showTeacher') {
            $this->viewTeacher = false;
        }
    }

    public function render()
    {
        $user = auth()->user();

        $teachers = $user->teachers()->get();

        return view('livewire.teachers', [
            'teachers' => $teachers,
        ]);
    }
}
