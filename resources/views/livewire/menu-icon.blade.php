<?php

use Livewire\Volt\Component;

new class extends Component {

    public int $noticeCount;

    public $notices;

    public bool $show = false;

    public function mount($noticeCount, $notices)
    {
        $this->noticeCount = $noticeCount;
        $this->notices = $notices;
    }
}; ?>

<div class="relative inline-flex" wire:click="$toggle('show')">
    <svg class="w-7 h-7 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
         fill="currentColor" viewBox="0 0 17 14">
        <path
            d="M16 2H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 0 1 0 2Z"/>
    </svg>
    <span
        class="absolute min-w-[12px] min-h-[12px] rounded-full py-1.5 px-2 text-xs font-medium content-[''] leading-none grid place-items-center top-[4%] left-[2%] -translate-x-2/4 -translate-y-2/4 bg-red-500 text-white">
        {{ $noticeCount }}
    </span>
    <x-drawer wire:model="show" class="w-10/12 lg:w-1/3 !p-[0px]" right>
        <x-layouts.mobile-sidebar :notice-count="$noticeCount" :notices="$notices"/>
    </x-drawer>
</div>
