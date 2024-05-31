<?php

use Livewire\Volt\Component;

new class extends Component {
    public $toggle = false;
    public $title = 'YOR 111 - Panegyrics Learning trhkjhghgjglgj efhwrg';
    public $date = '04 Jan, 09:20AM';
    public $status = 'active';
    public $grading = 1;

    public function mount()
    {
        if ($this->status === 'active') {
            $this->toggle = true;
        } else {
            $this->toggle = false;
        }
    }

}; ?>

<div class="max-w-[384px] pl-4 pr-4 justify-between w-full items-center flex flex-row h-[75px] bg-white rounded-lg">
    <div class="flex flex-row items-center justify-start gap-[21px]">
        <x-ui.squared-icon bg="bg-[#F3E4FF]">
            <svg class="w-[20px] h-[20px] text-[#8F00FF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
            </svg>
        </x-ui.squared-icon>
        <div class="flex flex-col gap-1">
            <p class="font-semibold text-[12px] text-[#272835] leading-[18px] max-w-[178px] truncate">
                {{ $title }}
            </p>
            <div class="flex flex-row gap-3 items-center justify-start">
                <p class="font-light text-[10px] leading-[15px] text-[#9E9E9E]">
                    {{ $date }}
                </p>
                @if($grading > 0)
                    <div class="flex items-center justify-center rounded-full h-4 w-4 bg-red-500">
                        <p class="text-white text-[10px] font-semibold">{{ $grading }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div>
        @if($status === 'inactive')
            <div
                class="w-[56px] h-[18px] px-1 flex items-center justify-center rounded-[4px] bg-[#FF0000]"
            >
                <p class="text-[8px] leading-[12px] font-medium text-[#FFFFFF]">
                    INACTIVE
                </p>

            </div>
        @else
            <div
                class="w-[56px] h-[18px] px-1 flex items-center justify-center rounded-[4px] bg-[#13C525]"
            >
                <p class="text-[8px] leading-[12px] font-medium text-[#FFFFFF]">
                    ACTIVE
                </p>
            </div>
        @endif
        {{--        <x-toggle wire:model="toggle"--}}
        {{--                  class="{{ $type === 'active' ? 'toggle-success' : 'toggle-error' }} h-[15px] w-[20px]"/>--}}

    </div>
</div>
