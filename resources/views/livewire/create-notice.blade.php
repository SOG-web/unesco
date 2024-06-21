<?php

use App\Models\Notice;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    public $users;

    #[Validate('required|string')]
    public String $title;
    #[Validate('required|string')]
    public String $selectedUser;
    #[Validate('required|string')]
    public String $message;

    public function mount()
    {
        $u = User::latest()->get();
        $this->users = $u->map(function ($s) {
            return [
                'id' => $s->id,
                'name' => $s->first_name.' '.$s->last_name,
                'label' => $s->first_name.' '.$s->last_name,
            ];
        });

    }

    public function save()
    {
        $this->validate();

        Notice::create([
            'title' => $this->title,
            'content' => $this->message,
            'status' => 'unread',
            'user_id' => $this->selectedUser,
            'type' => 'notice'
        ]);

        // get selected user profile
        $user = User::find($this->selectedUser);

        // save activity
        auth()->user()->activities()->create([
            'title' => 'New Notice created',
            'content' => 'sent new notice to '.$user->first_name.' '.$user->last_name,
            'status' => 'unread',
            'type' => 'notice',
        ]);

        $this->reset();

        return redirect()->route('notices');
    }

}; ?>

<div class="w-full max-w-[518px]">
    <x-form wire:submit="save" class="w-full gap-[32px] mb-[20px]">
        <x-input label="Notice Title" wire:model="title" placeholder="Enter Notice Title" required/>
        <x-select placeholder="Select a User" required label="Select User" :options="$users"
                  wire:model="selectedUser"/>
        <x-textarea
            label="Enter Message"
            required
            wire:model="message"
            placeholder="Type or paste message here....."
            hint="Max 1000 chars"
            rows="7"
        />
        <x-button
            class="mt-[16px] select-none rounded-lg bg-primary w-full max-w-[151px] py-3.5 px-7 text-center align-middle font-poppins text-sm font-bold uppercase text-white shadow-md leading-snug shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            label="Send Notice" type="submit" spinner="save"/>
    </x-form>
</div>
