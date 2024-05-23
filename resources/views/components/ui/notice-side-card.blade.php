@php use Carbon\Carbon; @endphp
@props(['title' => '', 'created_at' => '2024-05-23 01:01:22'])

<div class="w-full flex flex-row gap-3 items-center">
    <x-ui.squared-icon>
        <x-iconsax-lin-notification class="w-[20px] h-[20px] text-yellow-1"/>
    </x-ui.squared-icon>
    <div class="flex flex-col items-start justify-center gap-2">
        <h1 class="font-poppins w-[120px] xl:w-[160px] font-semibold text-[10px] text-text-1 text-left truncate">{{ $title }}</h1>
        <div class="w-full flex flex-row justify-start gap-[10px] items-center">
            <p class="font-poppins font-light text-text-2 text-[10px]"> {{ Carbon::parse($created_at)->format('h:iA') }}</p>
            <p class="font-poppins font-light text-yellow-1 text-[10px]">
                ({{ Carbon::parse($created_at)->format('d/m/y') }})</p>
        </div>
    </div>
</div>
