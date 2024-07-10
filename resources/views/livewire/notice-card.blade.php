<?php

use App\Models\Notice;
use Livewire\Volt\Component;

new class extends Component {
    public Notice $notice;

    public function mount($notice)
    {
        $this->notice = $notice;
    }
}; ?>

<div class="w-full flex flex-row gap-3 items-start">
    <div class="bg-yellow-fade w-[42px] lg:w-[65px] h-[42px] lg:h-[65px] flex items-center justify-center rounded-lg">
        <x-heroicon-o-bell class="w-[23px] h-[23px] text-yellow-1"/>
    </div>
    <div class="flex flex-col flex-1 items-start justify-start gap-2">
        <h1 class="w-full max-w-[250px] md:max-w-[400px] xl:max-w-[500px] font-semibold text-[12px] leading-[18px] lg:text-[16px] lg:leading-[24px] {{ $notice->status === 'unread' ? 'text-[#FF0000]' : 'text-text-1' }} text-left truncate">
            {{ $notice->title }}</h1>
        <div class="w-full flex flex-row justify-start gap-[10px] items-center">
            <p class="font-light text-text-2 text-[10px]"> {{ $notice->created_at->format('h:iA') }}
            </p>
            <p class="font-light text-yellow-1 text-[10px]">
                ({{ $notice->created_at->format('d/m/y') }})</p>
        </div>
        <p class="w-full text-[#121212] font-normal text-[12px] lg:text-[13px] text-wrap leading-[20px] lg:leading-[21px] tracking-[0.3px] opacity-70">{{ $notice->content }}</p>
    </div>
</div>
