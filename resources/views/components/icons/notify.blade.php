@props(['active' => false])

@if($active)
    <x-bi-chat-dots-fill class="text-white w-[24px] h-[24px]"/>
@else
    <x-bi-chat-dots class="w-[22px] h-[22px] text-gray-4 "/>
@endif
