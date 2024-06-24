@php use Carbon\Carbon; @endphp
@props(['title' => '', 'created_at' => '2024-05-23 01:01:22', 'type' => 'course'])

<div class="w-full flex flex-row gap-3 items-center">
    <x-ui.squared-icon :bg="$type === 'course' ? 'bg-[#F3E4FF]' :'bg-[#D4FFDA]'">
        @if($type === 'course')
            <svg class="w-[20px] h-[20px] text-[#8F00FF]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
            </svg>
        @else
            <x-letsicon-sort-up-alt class="w-[20px] h-[20px] text-[#008E13] font-bold"/>
        @endif
    </x-ui.squared-icon>
    <div class="flex flex-col items-start justify-center gap-2">
        <h1 class="font-poppins w-full md:w-[120px] xl:w-[160px] font-semibold text-[10px] text-text-1 text-left truncate text-wrap">{{ $title }}</h1>
        <div class="w-full flex flex-row justify-start gap-[10px] items-center">
            <p class="font-poppins font-light text-text-2 text-[10px]"> {{ Carbon::parse($created_at)->format('d M, h:iA') }}</p>
        </div>
    </div>
</div>
