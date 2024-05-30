<?php

use App\Models\User;
use Livewire\Volt\Component;

new class extends Component {
    public $first_name;
    public $last_name;
    public $email;
    public $title;

    public $titleOptions = [
        ['name' => 'Mr', 'label' => 'Mr', 'id' => 'Mr'],
        ['name' => 'Mrs', 'label' => 'Mrs', 'id' => 'Mrs'],
        ['name' => 'Miss', 'label' => 'Miss', 'id' => 'Miss'],
        ['name' => 'Dr', 'label' => 'Dr', 'id' => 'Dr'],
        ['name' => 'Prof', 'label' => 'Prof', 'id' => 'Prof'],
    ];

    public function save()
    {
        if (!auth()->user()->isAdmin()) {
            abort(401);
        }

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
        ]);

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => 'password',
            'title' => null,
            'role' => 'teacher',
        ]);

        $this->reset();

        // page reload to show the new student
        return redirect()->route('teachers');
    }
}; ?>

<div class="w-full">
    <x-form wire:submit="save">
        <div class="mt-4">
            <x-select required label="Title" icon-right="o-user" :options="$titleOptions" wire:model="title"/>
        </div>
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
            <x-button label="Add Teacher" type="submit" class="mt-4 bg-primary text-white w-full" spinner="save"/>
        </div>
    </x-form>
</div>
