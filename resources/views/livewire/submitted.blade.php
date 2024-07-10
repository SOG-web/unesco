<?php

use Livewire\Volt\Component;

new class extends Component {
    public $type;
    public $mark = 0;

    public function mount($type, $mark)
    {
        $this->type = $type;
        $this->mark = $mark;
    }

    public function goto()
    {
        return redirect()->route('dashboard');
    }
}; ?>

<div class="items-center w-full flex flex-col gap-[76px] pt-[30px] pl-[63px] pr-[63px] max-w-[692px] h-[799px]">
    <p
        class="font-semibold text-[#121212] text-[24px] leading-[38px] tracking-tight-[0.3px]"
    >
        Test Submitted!
    </p>
    @if($type === 'theory')
        <x-heroicon-o-check-circle class="max-w-[194px] w-full h-[194px] text-primary"/>

        <p
            class="font-normal max-w-[500px] text-center text-[18px] text-[#272835] leading-[27px]"
        >
            Your score will be displayed on your dashboard when available.
        </p>

    @else
        <div class="flex items-center flex-col gap-[20px]">
            <p class="font-normal text-[18px] text-[#272835] leading-[27px]">
                You scored:
            </p>
            <x-progress-radial value="{{ $mark }}" class="text-success" style="--size:10rem; --thickness: 5px"/>
        </div>
    @endif

    <div class="w-[100%] justify-center flex items-center">
        <x-button
            class="w-[151px] h-[41px] text-[#FFFFFF] flex font-bold text-[12px] leading-[20px] tracking-tight-[-0-2px] items-center justify-center rounded-xl bg-[#002979]"
            wire:click="goto"
            spinner="goto"
        >
            Go to dashboard
        </x-button>
    </div>
</div>
