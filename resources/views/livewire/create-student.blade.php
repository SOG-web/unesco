<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $first_name;
    public $last_name;
    public $email;

    public function save()
    {
        if (!auth()->user()->isAdmin()) {
            abort(401);
        }

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        $stu = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => 'password',
            'title' => null,
            'role' => 'students',
        ]);

        // save activity
        auth()->user()->activities()->create([
            'title' => 'Student created',
            'content' => 'Student created '.$stu->first_name,
            'status' => 'unread',
            'type' => 'other',
        ]);

        $this->reset();

        // page reload to show the new student
        return redirect()->route('students');
    }
}; ?>

<div class="w-full">
    <x-form wire:submit="save">
        <div class="mt-4">
            <x-input label="First Name" wire:model="first_name" required/>
        </div>
        <div class="mt-4">
            <x-input label="Last Name" wire:model="last_name" required/>
        </div>
        <div class="mt-4">
            <x-input label="Email" wire:model="email" type="email" required/>
        </div>

        <div class="w-[151px] m-auto mt-4">
            <x-button label="Add Student" type="submit" class="mt-4 bg-primary text-white w-full" spinner="save"/>
        </div>
    </x-form>
</div>
