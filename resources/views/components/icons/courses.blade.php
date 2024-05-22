@props(['active' => false])

@if($active)
    <x-heroicon-s-chart-bar-square class="w-[26px] h-[26px] text-white"/>
@else
    <x-heroicon-o-chart-bar-square class="text-gray-4 w-[24px] h-[24px]"/>
@endif
