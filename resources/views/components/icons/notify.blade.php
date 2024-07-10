@props(['active' => false])

@if($active)
    <x-heroicon-s-chat-bubble-oval-left-ellipsis class="text-white w-[24px] h-[24px]"/>
@else
    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-[22px] h-[22px] text-gray-4 "/>
@endif
