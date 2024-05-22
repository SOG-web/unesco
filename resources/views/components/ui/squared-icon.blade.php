@props(['bg' => 'bg-yellow-fade'])

<div class="{{  $bg }} w-[36px] h-[36px] flex items-center justify-center rounded-lg">
    {{ $slot }}
</div>
